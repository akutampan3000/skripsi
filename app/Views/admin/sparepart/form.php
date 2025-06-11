<?= $this->extend('admin/layout/header') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-lg border-0 rounded-lg mt-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="m-0 font-weight-bold">
                        <i class="fas fa-cogs me-2"></i>
                        <?= isset($sparepart) ? 'Edit' : 'Tambah' ?> Sparepart
                    </h4>
                </div>
                <div class="card-body">
                    <form action="<?= isset($sparepart) ? site_url('admin/sparepart/update/'.$sparepart['id']) : site_url('admin/sparepart/simpan') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <!-- ID Sparepart -->
                        <div class="mb-4">
                            <label for="id" class="form-label fw-bold">ID Sparepart</label>
                            <input type="text" class="form-control form-control-lg <?= session('errors.id') ? 'is-invalid' : '' ?>" 
                                   id="id" name="id" 
                                   value="<?= isset($sparepart) ? esc($sparepart['id']) : old('id') ?>" 
                                   <?= isset($sparepart) ? 'readonly' : 'required' ?>>
                            <?php if (session('errors.id')): ?>
                                <div class="invalid-feedback">
                                    <?= session('errors.id') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Nama Sparepart -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Nama Sparepart</label>
                            <input type="text" class="form-control form-control-lg <?= session('errors.name') ? 'is-invalid' : '' ?>" 
                                   id="name" name="name" 
                                   value="<?= isset($sparepart) ? esc($sparepart['name']) : old('name') ?>" 
                                   required>
                            <?php if (session('errors.name')): ?>
                                <div class="invalid-feedback">
                                    <?= session('errors.name') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control form-control-lg <?= session('errors.description') ? 'is-invalid' : '' ?>" 
                                      id="description" name="description" rows="3" required><?= isset($sparepart) ? esc($sparepart['description']) : old('description') ?></textarea>
                            <?php if (session('errors.description')): ?>
                                <div class="invalid-feedback">
                                    <?= session('errors.description') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Tipe Masalah -->
                        <div class="mb-4">
                            <label for="problem_type" class="form-label fw-bold">Tipe Masalah</label>
                            <select class="form-select form-select-lg <?= session('errors.problem_type') ? 'is-invalid' : '' ?>" 
                                    id="problem_type" name="problem_type" required>
                                <option value="electrical" <?= (isset($sparepart) && $sparepart['problem_type'] == 'electrical') || old('problem_type') == 'electrical' ? 'selected' : '' ?>>Kelistrikan</option>
                                <option value="engine" <?= (isset($sparepart) && $sparepart['problem_type'] == 'engine') || old('problem_type') == 'engine' ? 'selected' : '' ?>>Mesin</option>
                            </select>
                            <?php if (session('errors.problem_type')): ?>
                                <div class="invalid-feedback">
                                    <?= session('errors.problem_type') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Brands -->
                        <div class="mb-4">
                            <label for="brands" class="form-label fw-bold">Brands (JSON)</label>
                            <textarea class="form-control form-control-lg <?= session('errors.brands') ? 'is-invalid' : '' ?>" 
                                      id="brands" name="brands" rows="3" required><?= isset($sparepart) ? esc($sparepart['brands']) : old('brands') ?></textarea>
                            <?php if (session('errors.brands')): ?>
                                <div class="invalid-feedback">
                                    <?= session('errors.brands') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Related Symptoms -->
                        <div class="mb-4">
                            <label for="related_symptoms" class="form-label fw-bold">Gejala Terkait (JSON)</label>
                            <textarea class="form-control form-control-lg <?= session('errors.related_symptoms') ? 'is-invalid' : '' ?>" 
                                      id="related_symptoms" name="related_symptoms" rows="3" required><?= isset($sparepart) ? esc($sparepart['related_symptoms']) : old('related_symptoms') ?></textarea>
                            <?php if (session('errors.related_symptoms')): ?>
                                <div class="invalid-feedback">
                                    <?= session('errors.related_symptoms') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Compatibility Score -->
                        <div class="mb-4">
                            <label for="compatibility_score" class="form-label fw-bold">Skor Kompatibilitas (JSON)</label>
                            <textarea class="form-control form-control-lg <?= session('errors.compatibility_score') ? 'is-invalid' : '' ?>" 
                                      id="compatibility_score" name="compatibility_score" rows="3" required><?= isset($sparepart) ? esc($sparepart['compatibility_score']) : old('compatibility_score') ?></textarea>
                            <?php if (session('errors.compatibility_score')): ?>
                                <div class="invalid-feedback">
                                    <?= session('errors.compatibility_score') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="<?= site_url('admin/sparepart') ?>" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->include('admin/layout/footer') ?>