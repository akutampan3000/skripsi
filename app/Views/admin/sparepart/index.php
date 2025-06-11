<?php // File: sparepart/index.php (Konsep serupa, sesuaikan dengan variabel $spareparts) ?>
<?= $this->extend('admin/layout/header') ?>

<?= $this->section('content') ?>
<nav class="top-navbar">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?? 'Kelola Sparepart' ?></h1>
    <a href="<?= site_url('admin/sparepart/tambah') ?>" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm me-2"></i>Tambah Sparepart
    </a>
</nav>

<!-- Flash Messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="card">
     <div class="card-header">
        <h6 class="m-0 font-weight-bold"><i class="fas fa-cogs me-2"></i>Daftar Sparepart</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Tipe Masalah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($spareparts as $sparepart): ?>
                    <tr>
                        <td><strong><?= esc($sparepart['id']) ?></strong></td>
                        <td><?= esc($sparepart['name']) ?></td>
                        <td><span class="badge bg-secondary"><?= ucfirst(esc($sparepart['problem_type'])) ?></span></td>
                        <td>
                            <a href="<?= site_url('admin/sparepart/edit/'.$sparepart['id']) ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?= site_url('admin/sparepart/hapus/'.$sparepart['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin menghapus?')">
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
