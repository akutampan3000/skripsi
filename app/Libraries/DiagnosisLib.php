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
     * Menggunakan multiple features untuk rekomendasi yang lebih akurat:
     * - Category matching (bobot: 4) - Prioritas tertinggi
     * - Related symptoms similarity (bobot: 3.5) - Sangat penting untuk akurasi
     * - Performance level matching (bobot: 2.5)
     * - Brand compatibility (bobot: 2)
     * - Compatibility score (bobot: 1.5)
     * - Price range similarity (bobot: 1) - Faktor baru
     */
    public function getSimilarParts($sparepartId)
    {
        $mainPart = $this->getSparepartById($sparepartId);
        if (!$mainPart) return [];
        
        $mainCategory = $mainPart['category'];
        $mainPerformance = $mainPart['performance_level'];
        $mainProblemType = $mainPart['problem_type'];
        $mainBrands = explode(',', $mainPart['brands'] ?? '');
        $mainSymptoms = explode(',', $mainPart['related_symptoms'] ?? '');
        $mainCompatibilityScore = floatval($mainPart['compatibility_score'] ?? 1.0);

        // Filter hanya sparepart dengan problem_type yang sama
        $allOtherParts = $this->sparepartModel
            ->where('id !=', $sparepartId)
            ->where('problem_type', $mainProblemType)
            ->findAll();
        
        $recommendations = [];
        foreach ($allOtherParts as $otherPart) {
            $score = 0;
            $brandSimilarity = 0;
            $symptomSimilarity = 0;
            
            // 1. Category matching (bobot tertinggi: 4)
            if ($otherPart['category'] === $mainCategory) {
                $score += 4;
            } else {
                // Partial score untuk kategori terkait
                $relatedCategories = [
                    'Pengapian' => ['ECU', 'Sensor'],
                    'Filter' => ['Sistem Bahan Bakar', 'Pelumas'],
                    'Transmisi' => ['CVT', 'Komponen Mesin'],
                    'Switch' => ['Relay', 'Komponen Kelistrikan']
                ];
                foreach ($relatedCategories as $mainCat => $related) {
                    if ($mainCategory === $mainCat && in_array($otherPart['category'], $related)) {
                        $score += 1.5;
                        break;
                    }
                }
            }
            
            // 2. Related symptoms similarity (bobot: 3.5) - Prioritas tinggi
            $otherSymptoms = explode(',', $otherPart['related_symptoms'] ?? '');
            $symptomIntersection = array_intersect($mainSymptoms, $otherSymptoms);
            if (!empty($symptomIntersection)) {
                $symptomSimilarity = count($symptomIntersection) / max(count($mainSymptoms), count($otherSymptoms));
                $score += $symptomSimilarity * 3.5;
            }
            
            // 3. Performance level matching (bobot: 2.5)
            if ($otherPart['performance_level'] === $mainPerformance) {
                $score += 2.5;
            } else {
                // Partial score untuk level yang kompatibel
                $levelCompatibility = [
                    'standard' => ['oem'],
                    'oem' => ['standard', 'racing'],
                    'racing' => ['oem']
                ];
                if (isset($levelCompatibility[$mainPerformance]) && 
                    in_array($otherPart['performance_level'], $levelCompatibility[$mainPerformance])) {
                    $score += 1;
                }
            }
            
            // 4. Brand compatibility (bobot: 2)
            $otherBrands = explode(',', $otherPart['brands'] ?? '');
            $brandIntersection = array_intersect($mainBrands, $otherBrands);
            if (!empty($brandIntersection)) {
                $brandSimilarity = count($brandIntersection) / max(count($mainBrands), count($otherBrands));
                $score += $brandSimilarity * 2;
            }
            
            // 5. Compatibility score factor (bobot: 1.5)
            $otherCompatibilityScore = floatval($otherPart['compatibility_score'] ?? 1.0);
            $compatibilityFactor = ($mainCompatibilityScore + $otherCompatibilityScore) / 2;
            $score += $compatibilityFactor * 1.5;
            
            // 6. Bonus untuk sparepart dengan gejala yang sangat mirip
            if ($symptomSimilarity > 0.7) {
                $score += 1; // Bonus untuk kesamaan gejala tinggi
            }
            
            // Hanya masukkan jika ada kesamaan minimal (threshold ditingkatkan)
            if ($score >= 2.0) { // Threshold minimal untuk kualitas rekomendasi
                $recommendations[] = [
                    'part' => $otherPart, 
                    'score' => round($score, 2),
                    'similarity_details' => [
                        'category_match' => ($otherPart['category'] === $mainCategory),
                        'performance_match' => ($otherPart['performance_level'] === $mainPerformance),
                        'brand_similarity' => round($brandSimilarity, 2),
                        'symptom_similarity' => round($symptomSimilarity, 2),
                        'compatibility_score' => $otherCompatibilityScore,
                        'recommendation_reason' => $this->getRecommendationReason($score, $otherPart['category'], $mainCategory, $symptomSimilarity)
                    ]
                ];
            }
        }
        
        // Urutkan berdasarkan score tertinggi
        usort($recommendations, fn($a, $b) => $b['score'] <=> $a['score']);
        
        // Kembalikan top 3 rekomendasi untuk pilihan yang lebih banyak
        return array_slice($recommendations, 0, 3);
    }
    
    /**
     * Memberikan alasan mengapa sparepart direkomendasikan
     */
    private function getRecommendationReason($score, $otherCategory, $mainCategory, $symptomSimilarity)
    {
        if ($score >= 6) {
            return 'Sangat cocok - kategori dan gejala sangat mirip';
        } elseif ($score >= 4.5) {
            return 'Cocok - kategori sama dengan gejala serupa';
        } elseif ($otherCategory === $mainCategory) {
            return 'Kategori sama - alternatif yang baik';
        } elseif ($symptomSimilarity > 0.5) {
            return 'Gejala serupa - mungkin terkait masalah';
        } else {
            return 'Alternatif - pertimbangkan untuk diagnosis lanjutan';
        }
    }
}
