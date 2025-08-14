<?= $this->extend('admin/layout/header') ?>

<?= $this->section('content') ?>

<!-- Hero Section with Gradient Background -->
<div class="bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 rounded-2xl p-6 md:p-8 mb-8 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-10"></div>
    <div class="relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl md:text-4xl font-bold mb-2">Selamat Datang, <?= session()->get('username') ?? 'Admin' ?>!</h1>
                <p class="text-blue-100 text-lg">Dashboard Sistem Pakar Sparepart</p>
                <p class="text-blue-200 text-sm mt-1">Kelola sistem dengan mudah dan efisien</p>
            </div>
            <div class="user-profile dropdown">
                <a href="#" class="dropdown-toggle flex items-center space-x-3 px-4 py-3 rounded-xl bg-white bg-opacity-20 hover:bg-opacity-30 transition-all duration-300 backdrop-blur-sm" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle text-2xl"></i>
                    <span class="font-medium"><?= session()->get('username') ?? 'Guest' ?></span>
                    <i class="fas fa-chevron-down text-sm"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-xl border-0 rounded-xl mt-2" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 transition-colors" href="#"><i class="fas fa-user text-gray-500"></i><span>Profil Saya</span></a></li>
                    <li><a class="dropdown-item flex items-center space-x-3 px-4 py-3 hover:bg-gray-50 transition-colors" href="#"><i class="fas fa-cog text-gray-500"></i><span>Pengaturan</span></a></li>
                    <li><hr class="dropdown-divider my-2"></li>
                    <li><a class="dropdown-item flex items-center space-x-3 px-4 py-3 hover:bg-red-50 text-red-600 transition-colors" href="<?= site_url('auth/logout') ?>"><i class="fas fa-sign-out-alt text-red-500"></i><span>Logout</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-16 -mt-16"></div>
    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-5 rounded-full -ml-12 -mb-12"></div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
    <!-- Card Total Gejala -->
    <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 h-2"></div>
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="text-sm font-semibold text-purple-600 uppercase tracking-wide mb-2 flex items-center">
                        <i class="fas fa-clipboard-list mr-2"></i>Total Gejala
                    </div>
                    <div class="text-3xl font-bold text-gray-800 mb-1"><?= $total_gejala ?? 0 ?></div>
                    <div class="text-sm text-gray-500">Gejala terdaftar</div>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-purple-200 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-clipboard-list text-2xl text-purple-600"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Total Sparepart -->
    <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 h-2"></div>
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="text-sm font-semibold text-green-600 uppercase tracking-wide mb-2 flex items-center">
                        <i class="fas fa-cogs mr-2"></i>Total Sparepart
                    </div>
                    <div class="text-3xl font-bold text-gray-800 mb-1"><?= $total_sparepart ?? 0 ?></div>
                    <div class="text-sm text-gray-500">Sparepart tersedia</div>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-emerald-200 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-cogs text-2xl text-green-600"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Total Users -->
    <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 h-2"></div>
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="text-sm font-semibold text-blue-600 uppercase tracking-wide mb-2 flex items-center">
                        <i class="fas fa-users mr-2"></i>Total Users
                    </div>
                    <div class="text-3xl font-bold text-gray-800 mb-1"><?= $total_users ?? 0 ?></div>
                    <div class="text-sm text-gray-500">Pengguna aktif</div>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-indigo-200 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-users text-2xl text-blue-600"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Quick Actions & System Info -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="fas fa-bolt mr-3"></i>Aksi Cepat
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="<?= site_url('admin/gejala') ?>" class="group flex items-center p-4 bg-gradient-to-r from-purple-50 to-indigo-50 rounded-xl hover:from-purple-100 hover:to-indigo-100 transition-all duration-300 border border-purple-100">
                    <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-plus text-white"></i>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">Tambah Gejala</div>
                        <div class="text-sm text-gray-600">Kelola gejala baru</div>
                    </div>
                </a>
                
                <a href="<?= site_url('admin/sparepart') ?>" class="group flex items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl hover:from-green-100 hover:to-emerald-100 transition-all duration-300 border border-green-100">
                    <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-cog text-white"></i>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">Kelola Sparepart</div>
                        <div class="text-sm text-gray-600">Atur data sparepart</div>
                    </div>
                </a>
                
                <a href="<?= site_url('admin/riwayat-diagnosa') ?>" class="group flex items-center p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl hover:from-blue-100 hover:to-cyan-100 transition-all duration-300 border border-blue-100">
                    <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-history text-white"></i>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">Riwayat Diagnosa</div>
                        <div class="text-sm text-gray-600">Lihat aktivitas sistem</div>
                    </div>
                </a>
                
                <a href="<?= site_url('admin/laporan') ?>" class="group flex items-center p-4 bg-gradient-to-r from-orange-50 to-red-50 rounded-xl hover:from-orange-100 hover:to-red-100 transition-all duration-300 border border-orange-100">
                    <div class="w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-chart-bar text-white"></i>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">Laporan</div>
                        <div class="text-sm text-gray-600">Analisis data sistem</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    
    <!-- System Information -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-emerald-500 to-teal-600 px-6 py-4">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="fas fa-info-circle mr-3"></i>Informasi Sistem
            </h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-desktop text-blue-600"></i>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">Sistem Pakar Sparepart</div>
                        <div class="text-sm text-gray-600">Platform diagnosis dan rekomendasi sparepart otomotif</div>
                    </div>
                </div>
                
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-shield-alt text-green-600"></i>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">Status Sistem</div>
                        <div class="text-sm text-green-600 font-medium">✓ Semua layanan berjalan normal</div>
                    </div>
                </div>
                
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-clock text-purple-600"></i>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">Terakhir Diperbarui</div>
                        <div class="text-sm text-gray-600"><?= date('d F Y, H:i') ?> WIB</div>
                    </div>
                </div>
                
                <div class="mt-6 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                    <div class="text-sm text-gray-700">
                        <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                        <strong>Tips:</strong> Gunakan menu navigasi di sebelah kiri untuk mengakses fitur-fitur sistem dengan mudah.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Activity Timeline -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="bg-gradient-to-r from-gray-600 to-gray-700 px-6 py-4">
        <h3 class="text-xl font-bold text-white flex items-center">
            <i class="fas fa-chart-line mr-3"></i>Aktivitas Terbaru
        </h3>
    </div>
    <div class="p-6">
        <?php if (!empty($recent_activities)): ?>
            <div class="space-y-4">
                <?php foreach ($recent_activities as $activity): ?>
                    <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-stethoscope text-blue-600 text-sm"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    <span class="font-semibold"><?= esc($activity['username']) ?></span> melakukan diagnosa
                                </p>
                                <span class="text-xs text-gray-500">
                                    <?= date('H:i', strtotime($activity['diagnosed_at'])) ?>
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">
                                Hasil: <span class="font-medium"><?= esc($activity['sparepart_name']) ?></span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ml-2
                                    <?php 
                                        switch(strtolower($activity['problem_type'])) {
                                            case 'ringan':
                                                echo 'bg-green-100 text-green-800';
                                                break;
                                            case 'sedang':
                                                echo 'bg-yellow-100 text-yellow-800';
                                                break;
                                            case 'berat':
                                                echo 'bg-red-100 text-red-800';
                                                break;
                                            default:
                                                echo 'bg-gray-100 text-gray-800';
                                        }
                                    ?>">
                                    <?= esc($activity['problem_type']) ?>
                                </span>
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                <?= date('d M Y', strtotime($activity['diagnosed_at'])) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-6 text-center">
                <a href="<?= site_url('admin/riwayat-diagnosa') ?>" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 font-medium text-sm">
                    <i class="fas fa-eye mr-2"></i>Lihat Semua Aktivitas
                </a>
            </div>
        <?php else: ?>
            <div class="text-center py-8">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-area text-2xl text-gray-400"></i>
                </div>
                <h4 class="text-lg font-semibold text-gray-800 mb-2">Belum Ada Aktivitas</h4>
                <p class="text-gray-600 mb-4">Aktivitas diagnosa akan muncul di sini setelah pengguna melakukan diagnosa</p>
                <a href="<?= site_url('admin/riwayat-diagnosa') ?>" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 font-medium text-sm">
                    <i class="fas fa-eye mr-2"></i>Lihat Riwayat
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
