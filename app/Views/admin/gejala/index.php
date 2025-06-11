<?php // File: gejala/index.php ?>
<?= $this->extend('admin/layout/header') ?>

<?= $this->section('content') ?>
<!-- Top Navbar -->
<nav class="top-navbar">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?? 'Kelola Gejala' ?></h1>
    <a href="<?= site_url('admin/gejala/tambah') ?>" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm me-2"></i>Tambah Gejala
    </a>
</nav>

<!-- Flash Messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<!-- Data Table Card -->
<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold"><i class="fas fa-clipboard-list me-2"></i>Daftar Gejala Diagnosa</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pertanyaan</th>
                        <th>Tipe Masalah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($questions as $q): ?>
                    <tr>
                        <td><strong><?= esc($q['id']) ?></strong></td>
                        <td><?= esc($q['question_text']) ?></td>
                        <td><span class="badge bg-secondary"><?= ucfirst(esc($q['problem_type'])) ?></span></td>
                        <td>
                            <a href="<?= site_url('admin/gejala/edit/'.$q['id']) ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?= site_url('admin/gejala/hapus/'.$q['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin menghapus gejala ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
