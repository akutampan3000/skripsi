<?php // File: sparepart/index.php (Konsep serupa, sesuaikan dengan variabel $spareparts) ?>
<?= $this->extend('admin/layout/header') ?>

<?= $this->section('content') ?>
<nav class="top-navbar flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800"><?= $title ?? 'Kelola Sparepart' ?></h1>
    <a href="<?= site_url('admin/sparepart/tambah') ?>" class="inline-flex items-center px-4 py-2 bg-primary text-white font-medium rounded-lg shadow-lg hover:bg-blue-700 transition-colors duration-200">
        <i class="fas fa-plus text-sm mr-2"></i>Tambah Sparepart
    </a>
</nav>

<!-- Flash Messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-center">
        <i class="fas fa-exclamation-circle mr-2"></i>
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
     <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
        <h6 class="text-lg font-semibold text-gray-800 flex items-center">
            <i class="fas fa-cogs mr-2 text-primary"></i>
            Daftar Sparepart
        </h6>
    </div>
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full" id="dataTable">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 bg-gray-50 rounded-tl-lg">ID</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 bg-gray-50">Nama</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 bg-gray-50">Tipe Masalah</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 bg-gray-50 rounded-tr-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($spareparts as $sparepart): ?>
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center justify-center w-8 h-8 bg-primary bg-opacity-10 text-primary font-bold rounded-full text-sm">
                                <?= esc($sparepart['id']) ?>
                            </span>
                        </td>
                        <td class="py-4 px-4 text-gray-800 font-medium">
                            <?= esc($sparepart['name']) ?>
                        </td>
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                <?= ucfirst(esc($sparepart['problem_type'])) ?>
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex space-x-2">
                                <a href="<?= site_url('admin/sparepart/edit/'.$sparepart['id']) ?>" class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-sm font-medium rounded-lg hover:bg-yellow-600 transition-colors duration-200">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <a href="<?= site_url('admin/sparepart/hapus/'.$sparepart['id']) ?>" class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition-colors duration-200" onclick="return confirm('Yakin menghapus?')">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
