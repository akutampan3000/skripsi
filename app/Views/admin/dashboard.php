<?= $this->extend('admin/layout/header') ?>

<?= $this->section('content') ?>

<!-- Top Navbar -->
<nav class="top-navbar flex flex-col md:flex-row justify-between items-center mb-6 md:mb-8">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4 md:mb-0">Dashboard Admin</h1>
    <div class="user-profile dropdown">
        <a href="#" class="dropdown-toggle flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user-circle text-2xl text-primary"></i>
            <span class="hidden md:inline font-medium"><?= session()->get('username') ?? 'Guest' ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-lg" aria-labelledby="userDropdown">
            <li><a class="dropdown-item flex items-center space-x-2 px-4 py-3 hover:bg-gray-50" href="#"><i class="fas fa-user text-gray-400"></i><span>Profil</span></a></li>
            <li><hr class="dropdown-divider my-2"></li>
            <li><a class="dropdown-item flex items-center space-x-2 px-4 py-3 hover:bg-gray-50 text-red-600" href="<?= site_url('auth/logout') ?>"><i class="fas fa-sign-out-alt text-red-400"></i><span>Logout</span></a></li>
        </ul>
    </div>
</nav>

<!-- Card Stats -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 md:gap-6 mb-6">
    <!-- Card Total Gejala -->
    <div class="bg-white rounded-xl shadow-lg border-l-4 border-primary hover:shadow-xl transition-shadow duration-300">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="text-xs font-bold text-primary uppercase tracking-wide mb-2">Total Gejala</div>
                    <div class="text-2xl md:text-3xl font-bold text-gray-800"><?= $total_gejala ?? 0 ?></div>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-primary bg-opacity-10 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clipboard-list text-2xl text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Total Sparepart -->
    <div class="bg-white rounded-xl shadow-lg border-l-4 border-green-500 hover:shadow-xl transition-shadow duration-300">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="text-xs font-bold text-green-500 uppercase tracking-wide mb-2">Total Sparepart</div>
                    <div class="text-2xl md:text-3xl font-bold text-gray-800"><?= $total_sparepart ?? 0 ?></div>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-cogs text-2xl text-green-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Total Users -->
    <div class="bg-white rounded-xl shadow-lg border-l-4 border-blue-500 hover:shadow-xl transition-shadow duration-300">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="text-xs font-bold text-blue-500 uppercase tracking-wide mb-2">Total Users</div>
                    <div class="text-2xl md:text-3xl font-bold text-gray-800"><?= $total_users ?? 0 ?></div>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-2xl text-blue-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Welcome Panel -->
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-chart-line me-2"></i>Statistik Sistem</h6>
            </div>
            <div class="card-body">
                <p class="mb-0">
                    Selamat datang di dashboard admin Sistem Pakar Sparepart. Anda dapat mengelola gejala, sparepart, dan data lainnya dari sini. Gunakan menu di sebelah kiri untuk navigasi.
                </p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
