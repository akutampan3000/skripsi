<?php

namespace App\Libraries;

// Import model yang akan kita gunakan
use App\Models\SparepartModel;

class DiagnosisLib
{
    protected $db;
    protected $sparepartModel; // Properti untuk menampung SparepartModel

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        // Buat instance dari SparepartModel untuk digunakan di seluruh library
        $this->sparepartModel = new SparepartModel(); 
    }

    //================================================
    // Metode untuk data dasar
    //================================================

    public function getMotorcycleBrands()
    {
        return [
            'honda' => 'Honda',
            'yamaha' => 'Yamaha',
            'suzuki' => 'Suzuki',
            'kawasaki' => 'Kawasaki'
        ];
    }

    public function getProblemTypes()
    {
        return [
            'electrical' => 'Kelistrikan',
            'engine' => 'Mesin'
        ];
    }
    
    public function getBrandName($brandId)
    {
        return $this->getMotorcycleBrands()[$brandId] ?? 'Unknown Brand';
    }

    //================================================
    // Metode untuk alur diagnosa (Forward Chaining)
    //================================================

    public function getFirstQuestion($problemType)
    {
        $builder = $this->db->table('questions');
        $row = $builder->select('id')->where('problem_type', $problemType)->where('is_initial', 1)->get()->getRow();
        return $row ? $row->id : null;
    }
    
    public function getQuestion($problemType, $questionId)
    {
        return $this->db->table('questions')
            ->where('problem_type', $problemType)
            ->where('id', $questionId)
            ->get()->getRowArray();
    }
    
    public function getNextStep($problemType, $currentQuestionId, $answer)
    {
        $question = $this->getQuestion($problemType, $currentQuestionId);
        return $question ? (($answer === 'yes') ? $question['next_if_yes'] : $question['next_if_no']) : null;
    }

    //================================================
    // Metode untuk Sparepart, Riwayat, dan Statistik
    //================================================

    public function getSparepartById($id)
    {
        return $this->sparepartModel->find($id);
    }

    /**
     * Mengambil semua spare part, dengan fungsionalitas pencarian.
     */
    public function getAllSpareparts($searchQuery = null)
    {
        // Jika ada query pencarian, filter hasilnya
        if ($searchQuery) {
            return $this->sparepartModel
                ->like('name', $searchQuery)
                ->orLike('description', $searchQuery)
                ->findAll();
        }
        
        // Jika tidak ada, kembalikan semua
        return $this->sparepartModel->findAll();
    }

    public function saveDiagnosticHistory($userId, $sparepartId)
    {
        $this->db->table('diagnostic_history')->insert([
            'user_id' => $userId,
            'result_sparepart_id' => $sparepartId
        ]);
    }

    public function getHistoryForUser($userId, $limit = null)
    {
        $builder = $this->db->table('diagnostic_history');
        $builder->select('diagnostic_history.*, spareparts.name as sparepart_name, spareparts.problem_type')
            ->join('spareparts', 'spareparts.id = diagnostic_history.result_sparepart_id')
            ->where('diagnostic_history.user_id', $userId)
            ->orderBy('diagnosed_at', 'DESC');
        
        if ($limit) {
            $builder->limit($limit);
        }
            
        return $builder->get()->getResultArray();
    }
    
    public function getDashboardStats($userId)
    {
        $totalDiagnoses = $this->db->table('diagnostic_history')->where('user_id', $userId)->countAllResults(false);

        $mostFrequentQuery = $this->db->table('diagnostic_history')
            ->select('spareparts.problem_type, COUNT(diagnostic_history.history_id) as count')
            ->join('spareparts', 'spareparts.id = diagnostic_history.result_sparepart_id')
            ->where('diagnostic_history.user_id', $userId)
            ->groupBy('spareparts.problem_type')
            ->orderBy('count', 'DESC')
            ->limit(1)
            ->get()->getRow();

        $mostFrequent = $mostFrequentQuery ? ucfirst($mostFrequentQuery->problem_type) : 'N/A';
        
        return [
            'total' => $totalDiagnoses,
            'most_frequent' => $mostFrequent
        ];
    }
    
    public function getRecommendation($finalConclusion, $brand)
    {
        $sparepart = $this->getSparepartById($finalConclusion);
        if (!$sparepart) return null;
        
        return [
            'part' => [
                'name' => $sparepart['name'],
                'description' => $sparepart['description'],
            ],
            'brand_options' => [] 
        ];
    }
    
    /**
     * FUNGSI INTI UNTUK CONTENT-BASED FILTERING (CBF)
     */
    public function getSimilarParts($sparepartId)
    {
        $mainPart = $this->getSparepartById($sparepartId);
        if (!$mainPart) return [];
        
        $mainCategory = $mainPart['category'];
        $mainPerformance = $mainPart['performance_level'];

        $allOtherParts = $this->sparepartModel->where('id !=', $sparepartId)->findAll();
        
        $recommendations = [];
        foreach ($allOtherParts as $otherPart) {
            $score = 0;
            if ($otherPart['category'] === $mainCategory) $score += 2;
            if ($otherPart['performance_level'] === $mainPerformance) $score += 1;
            
            if ($score > 0) {
                $recommendations[] = ['part' => $otherPart, 'score' => $score];
            }
        }
        
        usort($recommendations, fn($a, $b) => $b['score'] <=> $a['score']);
        
        return array_slice($recommendations, 0, 3);
    }
}
