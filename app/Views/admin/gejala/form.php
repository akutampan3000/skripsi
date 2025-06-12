<?php // File: gejala/form.php ?>
<?= $this->extend('admin/layout/header') ?>

<?= $this->section('content') ?>
<nav class="top-navbar mb-6">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800"><?= isset($question) ? 'Edit' : 'Tambah' ?> Gejala</h1>
</nav>

<div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
        <h4 class="text-lg font-semibold text-gray-800 flex items-center">
            <i class="fas fa-clipboard-list mr-2 text-primary"></i>
            Formulir Data Gejala
        </h4>
    </div>
    <div class="p-6">
        <form action="<?= isset($question) ? site_url('admin/gejala/update/'.$question['id']) : site_url('admin/gejala/simpan') ?>" method="post" class="space-y-6">
            <?= csrf_field() ?>
            
            <div class="space-y-2">
                <label for="id" class="block text-sm font-semibold text-gray-700">ID Gejala</label>
                <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" id="id" name="id" value="<?= isset($question) ? esc($question['id']) : '' ?>" required placeholder="Masukkan ID gejala">
            </div>

            <div class="space-y-2">
                <label for="question_text" class="block text-sm font-semibold text-gray-700">Teks Pertanyaan</label>
                <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 resize-none" id="question_text" name="question_text" rows="4" required placeholder="Masukkan teks pertanyaan gejala"><?= isset($question) ? esc($question['question_text']) : '' ?></textarea>
            </div>

            <div class="space-y-2">
                <label for="problem_type" class="block text-sm font-semibold text-gray-700">Tipe Masalah</label>
                <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 bg-white" id="problem_type" name="problem_type" required>
                    <option value="" disabled <?= !isset($question) ? 'selected' : '' ?>>Pilih tipe masalah</option>
                    <option value="electrical" <?= isset($question) && $question['problem_type'] == 'electrical' ? 'selected' : '' ?>>Kelistrikan</option>
                    <option value="engine" <?= isset($question) && $question['problem_type'] == 'engine' ? 'selected' : '' ?>>Mesin</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="next_if_yes" class="block text-sm font-semibold text-gray-700">Next if Yes</label>
                    <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" id="next_if_yes" name="next_if_yes" value="<?= isset($question) ? esc($question['next_if_yes']) : '' ?>" placeholder="ID pertanyaan selanjutnya jika Ya">
                </div>
                <div class="space-y-2">
                    <label for="next_if_no" class="block text-sm font-semibold text-gray-700">Next if No</label>
                    <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" id="next_if_no" name="next_if_no" value="<?= isset($question) ? esc($question['next_if_no']) : '' ?>" placeholder="ID pertanyaan selanjutnya jika Tidak">
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="<?= site_url('admin/gejala') ?>" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200 shadow-lg">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>