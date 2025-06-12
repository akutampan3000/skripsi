<?= $this->extend('admin/layout/header') ?>

<?= $this->section('content') ?>
<nav class="top-navbar mb-6">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800"><?= isset($sparepart) ? 'Edit' : 'Tambah' ?> Sparepart</h1>
</nav>

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-primary to-blue-600 px-6 py-4">
            <h4 class="text-lg font-semibold text-white flex items-center">
                <i class="fas fa-cogs mr-2"></i>
                <?= isset($sparepart) ? 'Edit' : 'Tambah' ?> Sparepart
            </h4>
        </div>
        <div class="p-6">
            <!-- Menampilkan pesan error validasi -->
            <?php if (session()->has('errors')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-circle mr-2 mt-0.5"></i>
                        <div>
                            <p class="font-medium mb-2">Terdapat kesalahan pada form:</p>
                            <ul class="list-disc list-inside space-y-1">
                                <?php foreach (session('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <form action="<?= isset($sparepart) ? site_url('admin/sparepart/update/'.$sparepart['id']) : site_url('admin/sparepart/simpan') ?>" method="post" class="space-y-6">
                <?= csrf_field() ?>
                
                <!-- ID Sparepart (hanya bisa diisi saat menambah) -->
                <div class="space-y-2">
                    <label for="id" class="block text-sm font-semibold text-gray-700">ID Sparepart</label>
                    <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 <?= isset($sparepart) ? 'bg-gray-100' : '' ?>" id="id" name="id" 
                           value="<?= old('id', $sparepart['id'] ?? '') ?>" 
                           <?= isset($sparepart) ? 'readonly' : 'required' ?>
                           placeholder="Masukkan ID sparepart">
                </div>

                <!-- Nama Sparepart -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-semibold text-gray-700">Nama Sparepart</label>
                    <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" id="name" name="name" 
                           value="<?= old('name', $sparepart['name'] ?? '') ?>" required placeholder="Masukkan nama sparepart">
                </div>

                <!-- Deskripsi -->
                <div class="space-y-2">
                    <label for="description" class="block text-sm font-semibold text-gray-700">Deskripsi</label>
                    <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 resize-none" id="description" name="description" rows="3" required placeholder="Masukkan deskripsi sparepart"><?= old('description', $sparepart['description'] ?? '') ?></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Tipe Masalah -->
                    <div class="space-y-2">
                        <label for="problem_type" class="block text-sm font-semibold text-gray-700">Tipe Masalah</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 bg-white" id="problem_type" name="problem_type" required>
                            <option value="" disabled <?= !isset($sparepart) && !old('problem_type') ? 'selected' : '' ?>>Pilih tipe masalah</option>
                            <option value="electrical" <?= old('problem_type', $sparepart['problem_type'] ?? '') == 'electrical' ? 'selected' : '' ?>>Kelistrikan</option>
                            <option value="engine" <?= old('problem_type', $sparepart['problem_type'] ?? '') == 'engine' ? 'selected' : '' ?>>Mesin</option>
                        </select>
                    </div>

                    <!-- Kategori -->
                    <div class="space-y-2">
                        <label for="category" class="block text-sm font-semibold text-gray-700">Kategori</label>
                        <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" id="category" name="category" placeholder="Contoh: Busi, Aki"
                               value="<?= old('category', $sparepart['category'] ?? '') ?>" required>
                    </div>

                    <!-- Level Performa -->
                    <div class="space-y-2">
                        <label for="performance_level" class="block text-sm font-semibold text-gray-700">Level Performa</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 bg-white" id="performance_level" name="performance_level" required>
                            <option value="" disabled <?= !isset($sparepart) && !old('performance_level') ? 'selected' : '' ?>>Pilih level performa</option>
                            <option value="standard" <?= old('performance_level', $sparepart['performance_level'] ?? '') == 'standard' ? 'selected' : '' ?>>Standard</option>
                            <option value="oem" <?= old('performance_level', $sparepart['performance_level'] ?? '') == 'oem' ? 'selected' : '' ?>>OEM</option>
                            <option value="racing" <?= old('performance_level', $sparepart['performance_level'] ?? '') == 'racing' ? 'selected' : '' ?>>Racing</option>
                        </select>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-6 border-t border-gray-200">
                    <a href="<?= site_url('admin/sparepart') ?>" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200 shadow-lg">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->include('admin/layout/footer') ?>
