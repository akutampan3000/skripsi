<?php namespace App\Controllers;

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

    // Proses pemilihan brand
    public function processBrand()
    {
        $brand = $this->request->getPost('brand');
        session()->set('diagnosa_brand', $brand);
        return redirect()->to('/diagnosa/problem-type');
    }

    // Tampilkan halaman pemilihan brand
    public function brand()
    {
        $data = [
            'brands' => $this->diagnosisLib->getMotorcycleBrands(),
        ];
        return view('diagnosa/brand', $data);
    }

    // Tampilkan halaman pemilihan tipe masalah
    public function problemType()
    {
        if(!session()->get('diagnosa_brand')) {
            return redirect()->to('/diagnosa/brand');
        }
        
        $data = [
            'problemTypes' => $this->diagnosisLib->getProblemTypes(),
        ];
        return view('diagnosa/problem_type', $data);
    }

    // Proses tipe masalah
    public function processProblemType()
    {
        $problemType = $this->request->getPost('problem_type');
        session()->set('diagnosa_problem_type', $problemType);

        $firstQuestion = $this->diagnosisLib->getFirstQuestion($problemType);
        session()->set('current_question', $firstQuestion);

        return redirect()->to('/diagnosa/question');
    }

    // Tampilkan pertanyaan
    public function question()
{
    // Validasi session
    $requiredSessions = ['diagnosa_brand', 'diagnosa_problem_type', 'current_question'];
    foreach($requiredSessions as $session) {
        if(!session()->get($session)) {
            return redirect()->to('/diagnosa/reset');
        }
    }

    // Ambil data pertanyaan
    $question = $this->diagnosisLib->getQuestion(
        session()->get('diagnosa_problem_type'),
        session()->get('current_question')
    );

    // Handle jika pertanyaan tidak ditemukan
    if(!$question || !isset($question['question_text'])) {
        session()->setFlashdata('error', 'Pertanyaan tidak ditemukan');
        return redirect()->to('/diagnosa/reset');
    }

    // Format data untuk view
    $data = [
        'question' => [
            'id' => $question['id'],
            'text' => $question['question_text'], // Pastikan key sesuai database
            'problem_type' => session()->get('diagnosa_problem_type')
        ]
    ];

    return view('diagnosa/question', $data);
}

    // Proses jawaban
    public function processAnswer()
    {
        $answer = $this->request->getPost('answer');
        $nextStep = $this->diagnosisLib->getNextStep(
            session()->get('diagnosa_problem_type'),
            session()->get('current_question'),
            $answer
        );

        if(strpos($nextStep, 'rec_') === 0) {
            session()->set('recommendation', $nextStep);
            return redirect()->to('/diagnosa/result');
        }

        session()->set('current_question', $nextStep);
        return redirect()->to('/diagnosa/question');
    }

    // Tampilkan hasil
    public function result()
    {
        // Validasi session
        if(!session()->get('recommendation') || !session()->get('diagnosa_brand')) {
            return redirect()->to('/diagnosa/reset');
        }
    
        $recommendation = $this->diagnosisLib->getRecommendation(
            session()->get('recommendation'),
            session()->get('diagnosa_brand')
        );
        
        // Debugging: Tambahkan log jika diperlukan
        // log_message('info', print_r($recommendation, true));
        
        $data = [
            'recommendation' => $recommendation['part'] ?? null,
            'brand' => $this->diagnosisLib->getBrandName(session()->get('diagnosa_brand')),
            'brand_options' => $recommendation['brand_options'] ?? []
        ];
        
        return view('diagnosa/result', $data);
    }

    // Reset session
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