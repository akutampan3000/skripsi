<?php 

namespace App\Controllers;

use App\Models\SparepartModel;

class AdminSparepartController extends BaseController
{
    protected $sparepartModel;

    public function __construct()
    {
        $this->sparepartModel = new SparepartModel();
        // Memuat helper form untuk validasi
        helper('form');
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
        // Aturan validasi baru sesuai skema DB
        $rules = [
            'id' => 'required|is_unique[spareparts.id]',
            'name' => 'required|max_length[100]',
            'description' => 'required',
            'problem_type' => 'required|in_list[electrical,engine]',
            'category' => 'required|max_length[50]',
            'performance_level' => 'required|in_list[standard,oem,racing]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Data baru untuk disimpan
        $this->sparepartModel->save([
            'id' => $this->request->getPost('id'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'problem_type' => $this->request->getPost('problem_type'),
            'category' => $this->request->getPost('category'),
            'performance_level' => $this->request->getPost('performance_level'),
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
        // Aturan validasi baru (tanpa 'id' karena tidak diubah)
        $rules = [
            'name' => 'required|max_length[100]',
            'description' => 'required',
            'problem_type' => 'required|in_list[electrical,engine]',
            'category' => 'required|max_length[50]',
            'performance_level' => 'required|in_list[standard,oem,racing]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Data baru untuk di-update
        $this->sparepartModel->update($id, [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'problem_type' => $this->request->getPost('problem_type'),
            'category' => $this->request->getPost('category'),
            'performance_level' => $this->request->getPost('performance_level'),
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
