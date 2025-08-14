<?php namespace App\Controllers;

use App\Models\QuestionModel;
use App\Models\SparepartModel;
use App\Models\UserModel;
use App\Libraries\DiagnosisLib;
use CodeIgniter\HTTP\ResponseInterface;

class ReportController extends BaseController
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

    public function index()
    {
        $data = [
            'title' => 'Laporan Sistem',
            'totalDiagnosis' => $this->getTotalDiagnosis(),
            'diagnosisByMonth' => $this->getDiagnosisByMonth(),
            'popularSpareparts' => $this->getPopularSpareparts(),
            'problemTypeStats' => $this->getProblemTypeStats(),
            'userActivityStats' => $this->getUserActivityStats()
        ];
        
        return view('admin/report', $data);
    }

    private function getTotalDiagnosis()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('diagnostic_history');
        return $builder->countAllResults();
    }

    private function getDiagnosisByMonth()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('diagnostic_history');
        $builder->select('MONTH(diagnosed_at) as month, YEAR(diagnosed_at) as year, COUNT(*) as total')
            ->where('diagnosed_at >=', date('Y-01-01'))
            ->groupBy('YEAR(diagnosed_at), MONTH(diagnosed_at)')
            ->orderBy('year DESC, month DESC');
            
        return $builder->get()->getResultArray();
    }

    private function getPopularSpareparts()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('diagnostic_history');
        $builder->select('spareparts.name, spareparts.category, COUNT(*) as usage_count')
            ->join('spareparts', 'spareparts.id = diagnostic_history.result_sparepart_id')
            ->groupBy('diagnostic_history.result_sparepart_id')
            ->orderBy('usage_count', 'DESC')
            ->limit(10);
            
        return $builder->get()->getResultArray();
    }

    private function getProblemTypeStats()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('diagnostic_history');
        $builder->select('spareparts.problem_type, COUNT(*) as count')
            ->join('spareparts', 'spareparts.id = diagnostic_history.result_sparepart_id')
            ->groupBy('spareparts.problem_type')
            ->orderBy('count', 'DESC');
            
        return $builder->get()->getResultArray();
    }

    private function getUserActivityStats()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('diagnostic_history');
        $builder->select('users.username, COUNT(*) as diagnosis_count')
            ->join('users', 'users.id = diagnostic_history.user_id')
            ->groupBy('diagnostic_history.user_id')
            ->orderBy('diagnosis_count', 'DESC')
            ->limit(10);
            
        return $builder->get()->getResultArray();
    }

    public function exportPDF()
    {
        $data = [
            'totalDiagnosis' => $this->getTotalDiagnosis(),
            'diagnosisByMonth' => $this->getDiagnosisByMonth(),
            'popularSpareparts' => $this->getPopularSpareparts(),
            'problemTypeStats' => $this->getProblemTypeStats(),
            'userActivityStats' => $this->getUserActivityStats()
        ];

        // Generate HTML content for PDF
        $html = view('admin/report_pdf', $data);
        
        // Set headers for PDF download
        $filename = 'laporan_sistem_' . date('Y-m-d_H-i-s') . '.pdf';
        
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($html);
    }

    public function exportExcel()
    {
        $data = [
            'totalDiagnosis' => $this->getTotalDiagnosis(),
            'diagnosisByMonth' => $this->getDiagnosisByMonth(),
            'popularSpareparts' => $this->getPopularSpareparts(),
            'problemTypeStats' => $this->getProblemTypeStats(),
            'userActivityStats' => $this->getUserActivityStats()
        ];

        // Generate CSV content (Excel compatible)
        $csv = $this->generateCSV($data);
        
        $filename = 'laporan_sistem_' . date('Y-m-d_H-i-s') . '.csv';
        
        return $this->response
            ->setHeader('Content-Type', 'text/csv')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($csv);
    }

    private function generateCSV($data)
    {
        $output = "Laporan Sistem Sparepart\n\n";
        
        // Total Diagnosis
        $output .= "Total Diagnosis: " . $data['totalDiagnosis'] . "\n\n";
        
        // Popular Spareparts
        $output .= "Sparepart Populer:\n";
        $output .= "Nama,Kategori,Jumlah Penggunaan\n";
        foreach ($data['popularSpareparts'] as $sparepart) {
            $output .= "{$sparepart['name']},{$sparepart['category']},{$sparepart['usage_count']}\n";
        }
        
        $output .= "\n";
        
        // Problem Type Stats
        $output .= "Statistik Jenis Masalah:\n";
        $output .= "Jenis Masalah,Jumlah\n";
        foreach ($data['problemTypeStats'] as $problem) {
            $output .= "{$problem['problem_type']},{$problem['count']}\n";
        }
        
        $output .= "\n";
        
        // User Activity
        $output .= "Aktivitas Pengguna:\n";
        $output .= "Username,Jumlah Diagnosis\n";
        foreach ($data['userActivityStats'] as $user) {
            $output .= "{$user['username']},{$user['diagnosis_count']}\n";
        }
        
        return $output;
    }
}