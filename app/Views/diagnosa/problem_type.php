<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>
<nav class="top-navbar"><h2 class="page-title">Proses Diagnosa</h2></nav>

<div class="card">
    <div class="card-body">
        <!-- Progress Bar -->
        <div class="diagnosa-progress">
            <div class="progress-bar-line" style="width: 33%;"></div>
            <div class="progress-step active">
                <div class="step-circle"><i class="fas fa-check"></i></div>
                <div class="step-label">Pilih Merek</div>
            </div>
            <div class="progress-step active">
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
            <h3>Pilih Kategori Masalah</h3>
            <p class="text-muted">Masalah pada motor Anda lebih cenderung ke arah mana?</p>
        </div>
        
        <form action="<?= site_url('diagnosa/process-problem-type') ?>" method="post" class="w-75 mx-auto">
            <?= csrf_field() ?>
            <div class="list-group list-group-flush">
                <?php foreach ($problemTypes as $id => $name): ?>
                <button type="submit" name="problem_type" value="<?= $id ?>" class="list-group-item list-group-item-action text-center p-4 mb-3 rounded-3 fs-5">
                    <i class="fas fa-<?= $id === 'electrical' ? 'bolt' : 'cogs' ?> fa-2x mb-2 text-primary"></i>
                    <br>
                    <?= $name ?>
                </button>
                <?php endforeach ?>
            </div>
            <div class="mt-4 text-center">
                <a href="<?= site_url('diagnosa/brand') ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
