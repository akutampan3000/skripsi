<?= $this->extend('admin/layout/header') ?>

<?= $this->section('content') ?>

<!-- Header Section -->
<div class="bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl p-6 md:p-8 mb-8 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-10"></div>
    <div class="relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl md:text-4xl font-bold mb-2 flex items-center">
                    <i class="fas fa-chart-bar mr-4"></i>Laporan Sistem
                </h1>
                <p class="text-orange-100 text-lg">Analisis data dan statistik sistem pakar sparepart</p>
                <p class="text-orange-200 text-sm mt-1">Data terkini per <?= date('d F Y, H:i') ?> WIB</p>
            </div>
            <div class="flex space-x-3">
                <a href="<?= base_url('admin/laporan/export-pdf') ?>" class="px-4 py-2 bg-white bg-opacity-90 hover:bg-opacity-100 text-gray-800 hover:text-gray-900 rounded-lg transition-all duration-300 backdrop-blur-sm no-underline inline-block font-medium shadow-lg">
                    <i class="fas fa-download mr-2"></i>Export PDF
                </a>
                <a href="<?= base_url('admin/laporan/export-excel') ?>" class="px-4 py-2 bg-green-500 bg-opacity-90 hover:bg-opacity-100 text-white hover:text-white rounded-lg transition-all duration-300 backdrop-blur-sm no-underline inline-block font-medium shadow-lg">
                    <i class="fas fa-file-excel mr-2"></i>Export Excel
                </a>
            </div>
        </div>
    </div>
    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-16 -mt-16"></div>
    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-5 rounded-full -ml-12 -mb-12"></div>
</div>

<!-- Statistics Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
    <!-- Total Diagnosis -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 h-2"></div>
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="text-sm font-semibold text-blue-600 uppercase tracking-wide mb-2">
                        Total Diagnosa
                    </div>
                    <div class="text-3xl font-bold text-gray-800"><?= $totalDiagnosis ?? 0 ?></div>
                    <div class="text-sm text-gray-500">Diagnosa dilakukan</div>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-stethoscope text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Spareparts -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 h-2"></div>
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="text-sm font-semibold text-green-600 uppercase tracking-wide mb-2">
                        Sparepart Populer
                    </div>
                    <div class="text-3xl font-bold text-gray-800"><?= count($popularSpareparts ?? []) ?></div>
                    <div class="text-sm text-gray-500">Item teratas</div>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-star text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Problem Types -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 h-2"></div>
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="text-sm font-semibold text-purple-600 uppercase tracking-wide mb-2">
                        Jenis Masalah
                    </div>
                    <div class="text-3xl font-bold text-gray-800"><?= count($problemTypeStats ?? []) ?></div>
                    <div class="text-sm text-gray-500">Kategori masalah</div>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Users -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 h-2"></div>
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="text-sm font-semibold text-indigo-600 uppercase tracking-wide mb-2">
                        Pengguna Aktif
                    </div>
                    <div class="text-3xl font-bold text-gray-800"><?= count($userActivityStats ?? []) ?></div>
                    <div class="text-sm text-gray-500">User dengan aktivitas</div>
                </div>
                <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-indigo-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Tables -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Popular Spareparts Chart -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="fas fa-trophy mr-3"></i>Sparepart Paling Populer
            </h3>
        </div>
        <div class="p-6">
            <?php if (!empty($popularSpareparts)): ?>
                <div class="space-y-4">
                    <?php foreach (array_slice($popularSpareparts, 0, 5) as $index => $sparepart): ?>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                    <?= $index + 1 ?>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-800"><?= esc($sparepart['name']) ?></div>
                                    <div class="text-sm text-gray-600"><?= esc($sparepart['category']) ?></div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-green-600"><?= $sparepart['usage_count'] ?></div>
                                <div class="text-xs text-gray-500">diagnosa</div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-8">
                    <i class="fas fa-chart-bar text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Belum ada data sparepart populer</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Problem Type Distribution -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="fas fa-pie-chart mr-3"></i>Distribusi Jenis Masalah
            </h3>
        </div>
        <div class="p-6">
            <?php if (!empty($problemTypeStats)): ?>
                <div class="space-y-4">
                    <?php 
                    $total = array_sum(array_column($problemTypeStats, 'count'));
                    foreach ($problemTypeStats as $stat): 
                        $percentage = $total > 0 ? round(($stat['count'] / $total) * 100, 1) : 0;
                        $colorClass = '';
                        switch(strtolower($stat['problem_type'])) {
                            case 'ringan':
                                $colorClass = 'bg-green-500';
                                break;
                            case 'sedang':
                                $colorClass = 'bg-yellow-500';
                                break;
                            case 'berat':
                                $colorClass = 'bg-red-500';
                                break;
                            default:
                                $colorClass = 'bg-gray-500';
                        }
                    ?>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-4 h-4 <?= $colorClass ?> rounded-full"></div>
                                <span class="font-medium text-gray-800"><?= esc($stat['problem_type']) ?></span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-24 bg-gray-200 rounded-full h-2">
                                    <div class="<?= $colorClass ?> h-2 rounded-full" style="width: <?= $percentage ?>%"></div>
                                </div>
                                <span class="text-sm font-semibold text-gray-600 w-12 text-right"><?= $percentage ?>%</span>
                                <span class="text-sm text-gray-500 w-8 text-right">(<?= $stat['count'] ?>)</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-8">
                    <i class="fas fa-pie-chart text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Belum ada data jenis masalah</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- User Activity Table -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
        <h3 class="text-xl font-bold text-white flex items-center">
            <i class="fas fa-users mr-3"></i>Aktivitas Pengguna Teratas
        </h3>
    </div>
    <div class="p-6">
        <?php if (!empty($userActivityStats)): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Ranking</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Username</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Jumlah Diagnosa</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($userActivityStats as $index => $user): ?>
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="py-3 px-4">
                                    <div class="w-8 h-8 bg-indigo-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                        <?= $index + 1 ?>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-user-circle text-gray-400 text-xl"></i>
                                        <span class="font-medium text-gray-800"><?= esc($user['username']) ?></span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="font-bold text-indigo-600"><?= $user['diagnosis_count'] ?></span>
                                    <span class="text-sm text-gray-500 ml-1">diagnosa</span>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-circle text-green-400 text-xs mr-1"></i>
                                        Aktif
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-8">
                <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">Belum ada data aktivitas pengguna</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Monthly Diagnosis Trend -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="bg-gradient-to-r from-blue-500 to-cyan-600 px-6 py-4">
        <h3 class="text-xl font-bold text-white flex items-center">
            <i class="fas fa-chart-line mr-3"></i>Tren Diagnosa Bulanan
        </h3>
    </div>
    <div class="p-6">
        <?php if (!empty($diagnosisByMonth)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php 
                $months = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
                foreach ($diagnosisByMonth as $data): 
                ?>
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-4 border border-blue-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm font-semibold text-blue-600">
                                    <?= $months[$data['month']] ?> <?= $data['year'] ?>
                                </div>
                                <div class="text-2xl font-bold text-gray-800"><?= $data['total'] ?></div>
                                <div class="text-xs text-gray-500">diagnosa</div>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-calendar text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-8">
                <i class="fas fa-chart-line text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">Belum ada data tren bulanan</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>