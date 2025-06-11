<?php namespace App\Controllers;

use App\Models\QuestionModel;

class AdminQuestionController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new QuestionModel();
    }

    public function index()
    {
        $data['questions'] = $this->model->findAll();
        return view('admin/gejala/index', $data);
    }

    public function create()
    {
        return view('admin/gejala/form');
    }

    public function store()
    {
        $data = [
            'id' => $this->request->getPost('id'),
            'question_text' => $this->request->getPost('question_text'),
            'problem_type' => $this->request->getPost('problem_type'),
            'next_if_yes' => $this->request->getPost('next_if_yes'),
            'next_if_no' => $this->request->getPost('next_if_no'),
            'is_initial' => $this->request->getPost('is_initial') ?? 0
        ];

        $this->model->insert($data);
        return redirect()->to('/admin/gejala');
    }

    public function edit($id)
    {
        $data['question'] = $this->model->find($id);
        return view('admin/gejala/form', $data);
    }

    public function update($id)
    {
        $data = [
            'question_text' => $this->request->getPost('question_text'),
            'problem_type' => $this->request->getPost('problem_type'),
            'next_if_yes' => $this->request->getPost('next_if_yes'),
            'next_if_no' => $this->request->getPost('next_if_no'),
            'is_initial' => $this->request->getPost('is_initial') ?? 0
        ];

        $this->model->update($id, $data);
        return redirect()->to('/admin/gejala');
        return redirect()->to('/admin/gejala')->with('success', 'Pertanyaan berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/admin/gejala');
    }
}