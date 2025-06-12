<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>
<div class="bg-white border-b border-gray-200 px-4 py-4 sm:px-6">
    <h2 class="text-2xl font-bold text-gray-900">Proses Diagnosa</h2>
</div>

<div class="bg-white shadow-sm rounded-lg mx-4 my-6">
    <div class="p-6">
        <!-- Progress Bar -->
        <div class="mb-8">
            <div class="flex items-center justify-between relative">
                <div class="absolute top-5 left-0 w-2/3 h-0.5 bg-primary-500"></div>
                <div class="absolute top-5 right-0 w-1/3 h-0.5 bg-gray-300"></div>
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
                    <div class="w-10 h-10 bg-primary-500 rounded-full flex items-center justify-center text-white font-semibold">
                        3
                    </div>
                    <div class="mt-2 text-xs font-medium text-gray-600 text-center">Jawab Pertanyaan</div>
                </div>
                <div class="flex flex-col items-center relative z-10">
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-500">
                        <i class="fas fa-award text-sm"></i>
                    </div>
                    <div class="mt-2 text-xs font-medium text-gray-600 text-center">Hasil</div>
                </div>
            </div>
        </div>

        <?php if(isset($question['text']) && !empty($question['text'])): ?>
            <div class="text-center py-8">
                <i class="far fa-question-circle text-6xl text-primary-500 mb-6"></i>
                <h3 class="text-xl font-semibold text-gray-900 mb-8 max-w-2xl mx-auto"><?= esc($question['text']) ?></h3>
                
                <form action="/diagnosa/process-answer" method="post">
                    <?= csrf_field() ?>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <button type="submit" name="answer" value="yes" class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-8 rounded-lg transition duration-200 flex items-center justify-center">
                            <i class="fas fa-check mr-2"></i>Ya, Benar
                        </button>
                        <button type="submit" name="answer" value="no" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-8 rounded-lg transition duration-200 flex items-center justify-center">
                            <i class="fas fa-times mr-2"></i>Tidak
                        </button>
                    </div>
                </form>
            </div>
        <?php else: ?>
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 text-center">
                <p class="text-red-800">Terjadi kesalahan dalam memuat pertanyaan.</p>
            </div>
        <?php endif; ?>

        <div class="mt-6 text-center">
            <a href="<?= site_url('diagnosa/reset') ?>" class="inline-flex items-center text-gray-500 hover:text-gray-700 transition duration-200">
                <i class="fas fa-undo mr-2"></i>Mulai Ulang Diagnosa
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
