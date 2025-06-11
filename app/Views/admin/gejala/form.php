<?php // File: gejala/form.php ?>
<?= $this->extend('admin/layout/header') ?>

<?= $this->section('content') ?>
<nav class="top-navbar">
    <h1 class="h3 mb-0 text-gray-800"><?= isset($question) ? 'Edit' : 'Tambah' ?> Gejala</h1>
</nav>

<div class="card">
    <div class="card-header">
        <h4 class="m-0 font-weight-bold"><i class="fas fa-clipboard-list me-2"></i>Formulir Data Gejala</h4>
    </div>
    <div class="card-body">
        <form action="<?= isset($question) ? site_url('admin/gejala/update/'.$question['id']) : site_url('admin/gejala/simpan') ?>" method="post">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label for="id" class="form-label fw-bold">ID Gejala</label>
                <input type="text" class="form-control" id="id" name="id" value="<?= isset($question) ? esc($question['id']) : '' ?>" required>
            </div>

            <div class="mb-3">
                <label for="question_text" class="form-label fw-bold">Teks Pertanyaan</label>
                <textarea class="form-control" id="question_text" name="question_text" rows="4" required><?= isset($question) ? esc($question['question_text']) : '' ?></textarea>
            </div>

            <div class="mb-3">
                <label for="problem_type" class="form-label fw-bold">Tipe Masalah</label>
                <select class="form-select" id="problem_type" name="problem_type" required>
                    <option value="electrical" <?= isset($question) && $question['problem_type'] == 'electrical' ? 'selected' : '' ?>>Kelistrikan</option>
                    <option value="engine" <?= isset($question) && $question['problem_type'] == 'engine' ? 'selected' : '' ?>>Mesin</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="next_if_yes" class="form-label fw-bold">Next if Yes</label>
                    <input type="text" class="form-control" id="next_if_yes" name="next_if_yes" value="<?= isset($question) ? esc($question['next_if_yes']) : '' ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="next_if_no" class="form-label fw-bold">Next if No</label>
                    <input type="text" class="form-control" id="next_if_no" name="next_if_no" value="<?= isset($question) ? esc($question['next_if_no']) : '' ?>">
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="<?= site_url('admin/gejala') ?>" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Simpan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>