<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>
<div class="bg-white border-b border-gray-200 px-4 py-4 sm:px-6">
    <h2 class="text-2xl font-bold text-gray-900">Mulai Diagnosa</h2>
</div>

<div class="bg-white shadow-sm rounded-lg mx-4 my-6">
    <div class="p-6">
        <!-- Progress Bar -->
        <div class="mb-8">
            <div class="flex items-center justify-between relative">
                <div class="absolute top-5 left-0 w-full h-0.5 bg-gray-300"></div>
                <div class="flex flex-col items-center relative z-10">
                    <div class="w-10 h-10 bg-primary-500 rounded-full flex items-center justify-center text-white font-semibold">
                        1
                    </div>
                    <div class="mt-2 text-xs font-medium text-gray-600 text-center">Pilih Merek</div>
                </div>
                <div class="flex flex-col items-center relative z-10">
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-500 font-semibold">
                        2
                    </div>
                    <div class="mt-2 text-xs font-medium text-gray-600 text-center">Jenis Masalah</div>
                </div>
                <div class="flex flex-col items-center relative z-10">
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-500 font-semibold">
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

        <div class="text-center mb-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Pilih Merek Motor Anda</h3>
            <p class="text-gray-600">Pilih salah satu merek di bawah ini untuk melanjutkan.</p>
        </div>

        <form action="<?= site_url('diagnosa/process-brand') ?>" method="post">
            <?= csrf_field() ?>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-w-4xl mx-auto">
                <?php foreach ($brands as $id => $name): ?>
                    <button type="submit" name="brand" value="<?= $id ?>" class="bg-white hover:bg-primary-50 border-2 border-gray-200 hover:border-primary-300 text-gray-900 hover:text-primary-700 font-medium py-4 px-6 rounded-lg transition duration-200 text-center">
                        <?= $name ?>
                    </button>
                <?php endforeach ?>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
