<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>
<nav class="top-navbar"><h2 class="page-title">Hasil Diagnosa</h2></nav>

<div class="card">
    <div class="card-body">
        <!-- Progress Bar -->
        <div class="diagnosa-progress">
             <div class="progress-bar-line" style="width: 100%;"></div>
            <div class="progress-step active">
                <div class="step-circle"><i class="fas fa-check"></i></div>
                <div class="step-label">Pilih Merek</div>
            </div>
            <div class="progress-step active">
                <div class="step-circle"><i class="fas fa-check"></i></div>
                <div class="step-label">Jenis Masalah</div>
            </div>
            <div class="progress-step active">
                <div class="step-circle"><i class="fas fa-check"></i></div>
                <div class="step-label">Jawab Pertanyaan</div>
            </div>
             <div class="progress-step active">
                <div class="step-circle"><i class="fas fa-award"></i></div>
                <div class="step-label">Hasil</div>
            </div>
        </div>

        <?php if (!empty($recommendation)): ?>
            <div class="row">
                <div class="col-lg-8">
                    <h3>Hasil Analisis Sistem</h3>
                    <p class="text-muted">Berdasarkan jawaban Anda, berikut adalah rekomendasi sparepart yang perlu diperiksa atau diganti.</p>
                    
                    <div class="alert alert-light border-primary border-2 p-4 mt-4">
                        <h4 class="alert-heading text-primary"><?= esc($recommendation['name']) ?></h4>
                        <p><?= esc($recommendation['description']) ?></p>
                    </div>

                    <?php if (!empty($brand_options)): ?>
                        <h5 class="mt-4">Rekomendasi Merek untuk <?= esc(ucfirst($brand)) ?></h5>
                        <ul class="list-group">
                            <?php foreach ($brand_options as $item): ?>
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <?= esc($item) ?>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="p-3 rounded" style="background-color: #f3e8ff;">
                        <h5>✨ Dapatkan Saran AI</h5>
                        <p class="small">Klik untuk mendapatkan tips perawatan tambahan dari AI berdasarkan hasil diagnosa ini.</p>
                        <button class="btn btn-primary w-100" id="get-ai-tips-btn" data-sparepart="<?= esc($recommendation['name']) ?>">
                            Minta Saran Perawatan
                        </button>
                        <div id="ai-tips-result" class="mt-3 small" style="display:none;"></div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center p-5">
                <i class="far fa-thumbs-up fa-4x text-success mb-4"></i>
                <h3>Tidak Ditemukan Masalah</h3>
                <p class="text-muted">Berdasarkan jawaban Anda, sistem tidak menemukan masalah spesifik pada komponen yang diperiksa. Motor Anda dalam kondisi baik!</p>
            </div>
        <?php endif; ?>
        
        <hr class="my-4">
        <div class="text-center">
            <a href="<?= site_url('diagnosa/reset') ?>" class="btn btn-outline-primary">
                <i class="fas fa-redo me-2"></i>Mulai Diagnosa Baru
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
