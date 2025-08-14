<?php namespace App\Controllers;

use App\Models\QuestionModel;
use App\Models\SparepartModel;
use App\Models\UserModel;
use App\Libraries\DiagnosisLib;

class AdminController extends BaseController
{
    protected $questionModel;
    protected $sparepartModel;
    protected $userModel;
    protected $diagnosisLib;

    public function __construct()
    {
        $this->questionModel = new QuestionModel();
        $this->sparepartModel = new SparepartModel();
        $this->userModel = new UserModel();
        $this->diagnosisLib = new DiagnosisLib();
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard Admin',
            'total_gejala' => $this->questionModel->countAll(),
            'total_sparepart' => $this->sparepartModel->countAll(),
            'total_users' => $this->userModel->countAll(),
            'recent_activities' => $this->getAllDiagnosticHistory(5)
        ];
        
        return view('admin/dashboard', $data);
    }

    public function riwayatDiagnosa()
    {
        $data = [
            'title' => 'Riwayat Diagnosa',
            'diagnosticHistory' => $this->getAllDiagnosticHistory()
        ];
        
        return view('admin/riwayat_diagnosa', $data);
    }
    
    /**
     * Mengambil semua riwayat diagnosa dari semua user
     */
    private function getAllDiagnosticHistory($limit = 20)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('diagnostic_history');
        $builder->select('diagnostic_history.*, spareparts.name as sparepart_name, spareparts.problem_type, users.username')
            ->join('spareparts', 'spareparts.id = diagnostic_history.result_sparepart_id')
            ->join('users', 'users.id = diagnostic_history.user_id')
            ->orderBy('diagnosed_at', 'DESC')
            ->limit($limit);
            
        return $builder->get()->getResultArray();
    }
}