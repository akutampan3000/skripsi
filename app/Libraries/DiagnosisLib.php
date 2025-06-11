<?php namespace App\Libraries;

class DiagnosisLib
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

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

    public function getFirstQuestion($problemType)
    {
        $builder = $this->db->table('questions');
        return $builder->select('id')
            ->where('problem_type', $problemType)
            ->where('is_initial', 1)
            ->get()
            ->getRow('id');
    }

    public function getQuestion($problemType, $questionId)
{
    $builder = $this->db->table('questions');
    $result = $builder->where('problem_type', $problemType)
                    ->where('id', $questionId)
                    ->get()
                    ->getRowArray();

    // Validasi struktur data
    if($result && isset($result['question_text'])) {
        return [
            'id' => $result['id'],
            'question_text' => $result['question_text'],
            'next_if_yes' => $result['next_if_yes'],
            'next_if_no' => $result['next_if_no']
        ];
    }
    
    return null;
}

    public function getNextStep($problemType, $currentQuestionId, $answer)
    {
        // Forward Chaining: Get next question
        $question = $this->getQuestion($problemType, $currentQuestionId);
        $nextStep = $answer === 'yes' ? $question['next_if_yes'] : $question['next_if_no'];
        
        // Simpan riwayat untuk Content-Based Filtering
        $this->saveDiagnosticHistory([
            'question_id' => $currentQuestionId,
            'answer' => $answer,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
        
        return $nextStep;
    }

    public function getRecommendation($finalConclusion, $brand)
{
    $sparepart = $this->getSparepartById($finalConclusion);
    
    if(!$sparepart) {
        return null;
    }
    
    // Format data brands
    $brands = json_decode($sparepart['brands'], true);
    
    return [
        'part' => [
            'name' => $sparepart['name'],
            'description' => $sparepart['description']
        ],
        'brand_options' => $brands[$brand] ?? [],
        'compatibility_score' => json_decode($sparepart['compatibility_score'], true)[$brand] ?? 0
    ];
}

    private function saveDiagnosticHistory($log)
    {
        $history = session()->get('diagnosa_history') ?? [];
        $history[] = $log;
        session()->set('diagnosa_history', $history);
    }

    private function getDiagnosticHistory()
    {
        return session()->get('diagnosa_history') ?? [];
    }

    private function calculateCbfScore($sparepart, $history)
    {
        $score = 0;
        $symptoms = json_decode($sparepart['related_symptoms'], true);
        
        foreach($history as $entry) {
            if(in_array($entry['question_id'].':'.$entry['answer'], $symptoms)) {
                $score += 10; // Bobot gejala terpenuhi
            }
        }
        
        // Tambahkan skar berdasarkan preferensi merek
        $score += $sparepart['compatibility_score'][session()->get('diagnosa_brand')] ?? 0;
        
        return $score;
    }

    public function getSparepartById($id)
    {
        $builder = $this->db->table('spareparts');
        return $builder->where('id', $id)
            ->get()
            ->getRowArray();
    }

    public function getBrandName($brandId)
    {
        $brands = $this->getMotorcycleBrands();
        return $brands[$brandId] ?? 'Unknown Brand';
    }
}