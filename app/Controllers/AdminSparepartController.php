<?php namespace App\Controllers;

use App\Models\SparepartModel;

class AdminSparepartController extends BaseController
{
    protected $sparepartModel;

    public function __construct()
    {
        $this->sparepartModel = new SparepartModel();
    }

    /**
     * Menampilkan daftar sparepart
     */
    public function index()
    {
        $data = [
            'title' => 'Kelola Sparepart',
            'spareparts' => $this->sparepartModel->findAll(),
        ];

        return view('admin/sparepart/index', $data);
    }

    /**
     * Menampilkan form tambah sparepart
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Sparepart',
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/sparepart/form', $data);
    }

    /**
     * Menyimpan data sparepart baru
     */
    public function store()
    {
        // Validasi input
        $rules = [
            'id' => 'required|is_unique[spareparts.id]',
            'name' => 'required',
            'description' => 'required',
            'problem_type' => 'required|in_list[electrical,engine]',
            'brands' => 'required',
            'related_symptoms' => 'required',
            'compatibility_score' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan data
        $this->sparepartModel->save([
            'id' => $this->request->getPost('id'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'problem_type' => $this->request->getPost('problem_type'),
            'brands' => json_encode($this->request->getPost('brands')),
            'related_symptoms' => json_encode($this->request->getPost('related_symptoms')),
            'compatibility_score' => json_encode($this->request->getPost('compatibility_score')),
        ]);

        return redirect()->to('/admin/sparepart')->with('success', 'Sparepart berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit sparepart
     */
    public function edit($id)
    {
        $sparepart = $this->sparepartModel->find($id);

        if (!$sparepart) {
            return redirect()->to('/admin/sparepart')->with('error', 'Sparepart tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Sparepart',
            'sparepart' => $sparepart,
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/sparepart/form', $data);
    }

    /**
     * Mengupdate data sparepart
     */
    public function update($id)
    {
        // Validasi input
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'problem_type' => 'required|in_list[electrical,engine]',
            'brands' => 'required',
            'related_symptoms' => 'required',
            'compatibility_score' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update data
        $this->sparepartModel->save([
            'id' => $id,
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'problem_type' => $this->request->getPost('problem_type'),
            'brands' => json_encode($this->request->getPost('brands')),
            'related_symptoms' => json_encode($this->request->getPost('related_symptoms')),
            'compatibility_score' => json_encode($this->request->getPost('compatibility_score')),
        ]);

        return redirect()->to('/admin/sparepart')->with('success', 'Sparepart berhasil diperbarui.');
    }

    /**
     * Menghapus data sparepart
     */
    public function delete($id)
    {
        $sparepart = $this->sparepartModel->find($id);

        if (!$sparepart) {
            return redirect()->to('/admin/sparepart')->with('error', 'Sparepart tidak ditemukan.');
        }

        $this->sparepartModel->delete($id);
        return redirect()->to('/admin/sparepart')->with('success', 'Sparepart berhasil dihapus.');
    }
}