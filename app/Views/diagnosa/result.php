<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>
<div class="bg-white border-b border-gray-200 px-4 py-4 sm:px-6">
    <h2 class="text-2xl font-bold text-gray-900">Hasil Diagnosa</h2>
</div>

<div class="bg-white shadow-sm rounded-lg mx-4 my-6">
    <div class="p-6">
        <!-- Progress Bar -->
        <div class="mb-8">
            <div class="flex items-center justify-between relative">
                <div class="absolute top-5 left-0 w-full h-0.5 bg-primary-500"></div>
                <div class="flex flex-col items-center relative z-10">
                    <div class="w-10 h-10 bg-primary-500 rounded-full flex items-center justify-center text-white">
                        <i class="fas fa-check text-sm"></i>
                    </div>
                    <div class="mt-2 text-xs font-medium text-gray-600 text-center">Pilih Merek</div>
                </div>
                <div class="flex flex-col items-center relative z-10">
                    <div class="w-10 h-10 bg-primary-500 rounded-full flex items-center justify-center text-white">
                        <i class="fas fa-check text-sm"></i>
                    </div>
                    <div class="mt-2 text-xs font-medium text-gray-600 text-center">Jenis Masalah</div>
                </div>
                <div class="flex flex-col items-center relative z-10">
                    <div class="w-10 h-10 bg-primary-500 rounded-full flex items-center justify-center text-white">
                        <i class="fas fa-check text-sm"></i>
                    </div>
                    <div class="mt-2 text-xs font-medium text-gray-600 text-center">Jawab Pertanyaan</div>
                </div>
                <div class="flex flex-col items-center relative z-10">
                    <div class="w-10 h-10 bg-primary-500 rounded-full flex items-center justify-center text-white">
                        <i class="fas fa-award text-sm"></i>
                    </div>
                    <div class="mt-2 text-xs font-medium text-gray-600 text-center">Hasil</div>
                </div>
            </div>
        </div>

        <?php if (!empty($recommendation)): ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                <!-- Kolom Kiri: Hasil Utama dan Rekomendasi -->
                <div class="lg:col-span-2">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Hasil Analisis Sistem</h3>
                    <p class="text-gray-600 mb-6">Berdasarkan jawaban Anda, berikut adalah rekomendasi sparepart yang perlu diperiksa atau diganti.</p>
                    
                    <div class="bg-blue-50 border-l-4 border-primary-500 p-6 rounded-r-lg">
                        <h4 class="text-lg font-semibold text-primary-700 mb-2"><?= esc($recommendation['name']) ?></h4>
                        <p class="text-gray-700"><?= esc($recommendation['description']) ?></p>
                    </div>

                    <?php if (!empty($brand_options)): ?>
                        <h5 class="text-lg font-medium text-gray-900 mt-6 mb-4">Rekomendasi Merek untuk <?= esc(ucfirst($brand)) ?></h5>
                        <div class="bg-white border border-gray-200 rounded-lg divide-y divide-gray-200">
                            <?php foreach ($brand_options as $item): ?>
                                <div class="px-4 py-3 flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                    <span class="text-gray-900"><?= esc($item) ?></span>
                                </div>
                            <?php endforeach ?>
                        </div>
                    <?php endif; ?>

                    <!-- ================================================================= -->
                    <!-- BLOK INTEGRASI UNTUK REKOMENDASI CBF -->
                    <!-- ================================================================= -->
                    <?php if (!empty($similar_parts)): ?>
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h5 class="text-lg font-medium text-gray-900 mb-4">Rekomendasi Produk Serupa (Content-Based Filtering)</h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <?php foreach ($similar_parts as $similar): ?>
                                <div class="bg-white border border-gray-200 rounded-lg p-4 h-full">
                                    <h6 class="font-medium text-primary-600 mb-2"><?= esc($similar['part']['name']) ?></h6>
                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mb-2"><?= esc(ucfirst($similar['part']['category'])) ?></span>
                                    <p class="text-sm text-gray-600"><?= esc($similar['part']['description']) ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- AKHIR BLOK CBF -->
        <?php else: ?>
            <div class="text-center py-12">
                <i class="far fa-thumbs-up text-6xl text-green-500 mb-6"></i>
                <h3 class="text-2xl font-semibold text-gray-900 mb-4">Tidak Ditemukan Masalah</h3>
                <p class="text-gray-600 max-w-md mx-auto">Berdasarkan jawaban Anda, sistem tidak menemukan masalah spesifik pada komponen yang diperiksa. Motor Anda dalam kondisi baik!</p>
            </div>
        <?php endif; ?>

        <div class="border-t border-gray-200 pt-6 mt-8">
            <div class="text-center">
                <a href="<?= site_url('diagnosa/reset') ?>" class="inline-flex items-center px-6 py-3 border border-primary-300 text-primary-700 bg-white hover:bg-primary-50 font-medium rounded-lg transition duration-200">
                    <i class="fas fa-redo mr-2"></i>Mulai Diagnosa Baru
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
