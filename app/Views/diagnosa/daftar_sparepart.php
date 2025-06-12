<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>
<div class="bg-white border-b border-gray-200 px-4 py-4 sm:px-6">
    <h2 class="text-2xl font-bold text-gray-900">Daftar Sparepart</h2>
</div>

<!-- Form Pencarian -->
<div class="bg-white shadow-sm rounded-lg mx-4 my-6">
    <div class="p-6">
        <form action="<?= site_url('diagnosa/daftar-sparepart') ?>" method="get">
            <div class="flex flex-col sm:flex-row gap-3">
                <input type="text" name="q" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="Cari berdasarkan nama atau deskripsi..." value="<?= esc($searchQuery ?? '') ?>">
                <button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition duration-200 flex items-center justify-center">
                    <i class="fas fa-search mr-2"></i>Cari
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Daftar Hasil -->
<div class="mx-4 mb-6">
    <?php if (!empty($spareparts)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($spareparts as $part): ?>
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition duration-200">
                    <div class="p-6">
                        <h5 class="text-lg font-semibold text-primary-600 mb-3"><?= esc($part['name']) ?></h5>
                        <p class="text-gray-700 mb-4"><?= esc($part['description']) ?></p>
                    </div>
                    <div class="px-6 pb-6">
                        <div class="flex flex-wrap gap-2">
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full"><?= esc(ucfirst($part['category'])) ?></span>
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full"><?= esc(ucfirst($part['performance_level'])) ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
            <i class="fas fa-exclamation-triangle text-yellow-500 text-2xl mb-2"></i>
            <p class="text-yellow-800">
                <?php if (!empty($searchQuery)): ?>
                    Tidak ada sparepart yang cocok dengan pencarian "<span class="font-semibold"><?= esc($searchQuery) ?></span>".
                <?php else: ?>
                    Tidak ada data sparepart untuk ditampilkan.
                <?php endif; ?>
            </p>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
