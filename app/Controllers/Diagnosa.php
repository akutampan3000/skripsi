<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\DiagnosisLib;

class Diagnosa extends BaseController
{
    protected $diagnosisLib;

    public function __construct()
    {
        $this->diagnosisLib = new DiagnosisLib();
        helper(['session', 'form']);
    }

    public function index()
    {
        return redirect()->to('/diagnosa/brand');
    }

    public function processBrand()
    {
        $brand = $this->request->getPost('brand');
        session()->set('diagnosa_brand', $brand);
        return redirect()->to('/diagnosa/problem-type');
    }

    public function brand()
    {
        $data = [
            'brands' => $this->diagnosisLib->getMotorcycleBrands(),
        ];
        return view('diagnosa/brand', $data);
    }

    public function problemType()
    {
        if (!session()->get('diagnosa_brand')) {
            return redirect()->to('/diagnosa/brand');
        }

        $data = [
            'problemTypes' => $this->diagnosisLib->getProblemTypes(),
        ];
        return view('diagnosa/problem_type', $data);
    }

    public function processProblemType()
    {
        $problemType = $this->request->getPost('problem_type');
        session()->set('diagnosa_problem_type', $problemType);
        $firstQuestion = $this->diagnosisLib->getFirstQuestion($problemType);
        session()->set('current_question', $firstQuestion);
        return redirect()->to('/diagnosa/question');
    }

    public function question()
    {
        $requiredSessions = ['diagnosa_brand', 'diagnosa_problem_type', 'current_question'];
        foreach ($requiredSessions as $session) {
            if (!session()->get($session)) {
                return redirect()->to('/diagnosa/reset');
            }
        }
        $question = $this->diagnosisLib->getQuestion(
            session()->get('diagnosa_problem_type'),
            session()->get('current_question')
        );
        if (!$question || !isset($question['question_text'])) {
            session()->setFlashdata('error', 'Pertanyaan tidak ditemukan.');
            return redirect()->to('/diagnosa/reset');
        }
        $data = [
            'question' => [
                'id' => $question['id'],
                'text' => $question['question_text'],
                'problem_type' => session()->get('diagnosa_problem_type')
            ]
        ];
        return view('diagnosa/question', $data);
    }



    // CONTROLLER DENGAN DEBUGGING. PERHATIKAN METHOD DI BAWAH INI.
  
    public function processAnswer()
    {
        $answer = $this->request->getPost('answer');
        $currentQuestionId = session()->get('current_question');
        $problemType = session()->get('diagnosa_problem_type');
    
        //die("DEBUG 1: Jawaban = " . $answer . " | ID Pertanyaan Saat Ini = " . $currentQuestionId);
        $nextStep = $this->diagnosisLib->getNextStep(
            $problemType,
            $currentQuestionId,
            $answer
        );

        //die("DEBUG 2: Hasil dari getNextStep() adalah: " . var_export($nextStep, true));

        if (empty($nextStep)) {
            session()->setFlashdata('error', 'DEBUG: Alur diagnosa tidak ditemukan (nextStep kosong). Pastikan kolom next_if_yes/no di DB sudah diisi untuk pertanyaan ID: ' . esc($currentQuestionId));
            return redirect()->to('/diagnosa/reset');
        }

        // Jika langkah selanjutnya adalah rekomendasi (diawali 'rec_' atau 'sp_')
        if (strpos($nextStep, 'rec_') === 0 || strpos($nextStep, 'sp_') === 0) {
            session()->set('recommendation', $nextStep);
            return redirect()->to('/diagnosa/result');
        }

        // Jika masih pertanyaan, update session dan kembali ke halaman pertanyaan
        session()->set('current_question', $nextStep);
        return redirect()->to('/diagnosa/question');
    }
     public function result()
    {
        if (!session()->get('recommendation') || !session()->get('diagnosa_brand')) {
            return redirect()->to('/diagnosa/reset');
        }

        $sparepartId = session()->get('recommendation');
        $brand = session()->get('diagnosa_brand');
        $userId = session()->get('user_id') ?? 1; // Ganti dengan user ID yang sebenarnya, 1 hanya placeholder
        if ($userId) {
            $this->diagnosisLib->saveDiagnosticHistory($userId, $sparepartId);
        }

        // Dapatkan rekomendasi utama (Forward Chaining)
        $recommendation = $this->diagnosisLib->getRecommendation($sparepartId, $brand);

        // --- INTEGRASI BAGIAN 2 (Content-Based Filtering) ---
        $similarParts = $this->diagnosisLib->getSimilarParts($sparepartId);

        $data = [
            'recommendation' => $recommendation['part'] ?? null,
            'brand' => $this->diagnosisLib->getBrandName($brand),
            'brand_options' => $recommendation['brand_options'] ?? [],
            'similar_parts' => $similarParts // Kirim data CBF ke view
        ];
        
        return view('diagnosa/result', $data);
    }
    public function daftarSparepart()
    {
        // Ambil query pencarian dari URL (?q=...)
        $searchQuery = $this->request->getGet('q');
        
        $data = [
            // Kirim query ke library untuk mendapatkan data yang difilter
            'spareparts' => $this->diagnosisLib->getAllSpareparts($searchQuery),
            // Kirim query kembali ke view agar bisa ditampilkan di kotak pencarian
            'searchQuery' => $searchQuery
        ];
        return view('diagnosa/daftar_sparepart', $data);
    }
    
    public function history()
    {
        $userId = session()->get('user_id') ?? 1; // Ganti dengan user ID yang sebenarnya
        $data = [
            'history' => $this->diagnosisLib->getHistoryForUser($userId)
        ];
        return view('diagnosa/history', $data);
    }


    public function reset()
    {
        session()->remove([
            'diagnosa_brand',
            'diagnosa_problem_type',
            'current_question',
            'recommendation'
        ]);
        return redirect()->to('/diagnosa/brand');
    }
}