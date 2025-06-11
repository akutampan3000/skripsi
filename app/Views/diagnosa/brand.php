<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>
<nav class="top-navbar"><h2 class="page-title">Mulai Diagnosa</h2></nav>

<div class="card">
    <div class="card-body">
        <!-- Progress Bar -->
        <div class="diagnosa-progress">
            <div class="progress-bar-line" style="width: 0%;"></div>
            <div class="progress-step active">
                <div class="step-circle">1</div>
                <div class="step-label">Pilih Merek</div>
            </div>
            <div class="progress-step">
                <div class="step-circle">2</div>
                <div class="step-label">Jenis Masalah</div>
            </div>
            <div class="progress-step">
                <div class="step-circle">3</div>
                <div class="step-label">Jawab Pertanyaan</div>
            </div>
             <div class="progress-step">
                <div class="step-circle"><i class="fas fa-check"></i></div>
                <div class="step-label">Hasil</div>
            </div>
        </div>

        <div class="text-center mb-4">
            <h3>Pilih Merek Motor Anda</h3>
            <p class="text-muted">Pilih salah satu merek di bawah ini untuk melanjutkan.</p>
        </div>

        <form action="<?= site_url('diagnosa/process-brand') ?>" method="post">
            <?= csrf_field() ?>
            <div class="row justify-content-center">
                <?php foreach ($brands as $id => $name): ?>
                <div class="col-md-4 col-lg-3 mb-3">
                    <button type="submit" name="brand" value="<?= $id ?>" class="btn btn-outline-primary w-100 p-4 fs-5">
                        <?= $name ?>
                    </button>
                </div>
                <?php endforeach ?>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
