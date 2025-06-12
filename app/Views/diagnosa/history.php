<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>
<div class="bg-white border-b border-gray-200 px-4 py-4 sm:px-6">
    <h2 class="text-2xl font-bold text-gray-900">Riwayat Diagnosa</h2>
</div>

<div class="bg-white shadow-sm rounded-lg mx-4 my-6">
    <div class="p-6">
        <h5 class="text-lg font-semibold text-gray-900 mb-6">Hasil Diagnosa Anda Sebelumnya</h5>

        <?php if (!empty($history)): ?>
            <div class="space-y-4">
                <?php foreach ($history as $item): ?>
                    <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-2">
                            <h5 class="text-lg font-medium text-primary-600 mb-1 sm:mb-0"><?= esc($item['sparepart_name']) ?></h5>
                            <span class="text-sm text-gray-500"><?= date('d M Y, H:i', strtotime($item['diagnosed_at'])) ?></span>
                        </div>
                        <p class="text-gray-700">
                            Masalah terdeteksi pada sistem <span class="font-semibold text-gray-900"><?= esc(ucfirst($item['problem_type'])) ?></span>.
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
                <i class="fas fa-info-circle text-blue-500 text-2xl mb-2"></i>
                <p class="text-blue-800">Anda belum memiliki riwayat diagnosa.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
