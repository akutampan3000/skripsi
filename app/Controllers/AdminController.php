<?php namespace App\Controllers;

use App\Models\QuestionModel;
use App\Models\SparepartModel;
use App\Models\UserModel;

class AdminController extends BaseController
{
    protected $questionModel;
    protected $sparepartModel;
    protected $userModel;

    public function __construct()
    {
        $this->questionModel = new QuestionModel();
        $this->sparepartModel = new SparepartModel();
        $this->userModel = new UserModel();
    }

    public function dashboard()
    {
        $data = [
            'total_gejala' => $this->questionModel->countAll(),
            'total_sparepart' => $this->sparepartModel->getTotalSparepart(),
            'total_users' => $this->userModel->getTotalUsers()
        ];

        return view('admin/dashboard', $data);
    }
}