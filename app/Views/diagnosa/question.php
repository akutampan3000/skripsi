<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>
<nav class="top-navbar"><h2 class="page-title">Proses Diagnosa</h2></nav>

<div class="card">
    <div class="card-body">
        <!-- Progress Bar -->
        <div class="diagnosa-progress">
             <div class="progress-bar-line" style="width: 66%;"></div>
            <div class="progress-step active">
                <div class="step-circle"><i class="fas fa-check"></i></div>
                <div class="step-label">Pilih Merek</div>
            </div>
            <div class="progress-step active">
                <div class="step-circle"><i class="fas fa-check"></i></div>
                <div class="step-label">Jenis Masalah</div>
            </div>
            <div class="progress-step active">
                <div class="step-circle">3</div>
                <div class="step-label">Jawab Pertanyaan</div>
            </div>
             <div class="progress-step">
                <div class="step-circle"><i class="fas fa-check"></i></div>
                <div class="step-label">Hasil</div>
            </div>
        </div>

        <?php if(isset($question['text']) && !empty($question['text'])): ?>
            <div class="text-center p-lg-5">
                <i class="far fa-question-circle fa-4x text-primary mb-4"></i>
                <h3 class="mb-4"><?= esc($question['text']) ?></h3>
                
                <form action="/diagnosa/process-answer" method="post">
                    <?= csrf_field() ?>
                    <div class="d-grid gap-3 d-md-flex justify-content-md-center">
                        <button type="submit" name="answer" value="yes" class="btn btn-success btn-lg px-5 py-3">
                            <i class="fas fa-check me-2"></i>Ya, Benar
                        </button>
                        <button type="submit" name="answer" value="no" class="btn btn-danger btn-lg px-5 py-3">
                            <i class="fas fa-times me-2"></i>Tidak
                        </button>
                    </div>
                </form>
            </div>
        <?php else: ?>
            <div class="alert alert-danger text-center">Terjadi kesalahan dalam memuat pertanyaan.</div>
        <?php endif; ?>

        <div class="mt-4 text-center">
            <a href="<?= site_url('diagnosa/reset') ?>" class="btn btn-link text-muted">
                <i class="fas fa-undo me-2"></i>Mulai Ulang Diagnosa
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
