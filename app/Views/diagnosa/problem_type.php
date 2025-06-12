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
                <div class="absolute top-5 left-0 w-1/3 h-0.5 bg-primary-500"></div>
                <div class="absolute top-5 left-1/3 w-2/3 h-0.5 bg-gray-300"></div>
                <div class="flex flex-col items-center relative z-10">
                    <div class="w-10 h-10 bg-primary-500 rounded-full flex items-center justify-center text-white">
                        <i class="fas fa-check text-sm"></i>
                    </div>
                    <div class="mt-2 text-xs font-medium text-gray-600 text-center">Pilih Merek</div>
                </div>
                <div class="flex flex-col items-center relative z-10">
                    <div class="w-10 h-10 bg-primary-500 rounded-full flex items-center justify-center text-white font-semibold">
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
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Pilih Kategori Masalah</h3>
            <p class="text-gray-600">Masalah pada motor Anda lebih cenderung ke arah mana?</p>
        </div>
        
        <form action="<?= site_url('diagnosa/process-problem-type') ?>" method="post" class="max-w-md mx-auto">
            <?= csrf_field() ?>
            <div class="space-y-4">
                <?php foreach ($problemTypes as $id => $name): ?>
                <button type="submit" name="problem_type" value="<?= $id ?>" class="w-full bg-white hover:bg-gray-50 border-2 border-gray-200 hover:border-primary-300 rounded-lg p-6 text-center transition duration-200 group">
                    <i class="fas fa-<?= $id === 'electrical' ? 'bolt' : 'cogs' ?> text-4xl mb-3 text-primary-500 group-hover:text-primary-600"></i>
                    <div class="text-lg font-medium text-gray-900"><?= $name ?></div>
                </button>
                <?php endforeach ?>
            </div>
            <div class="mt-8 text-center">
                <a href="<?= site_url('diagnosa/brand') ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 font-medium rounded-lg transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
