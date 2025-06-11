<?= $this->extend('admin/layout/header') ?>

<?= $this->section('content') ?>

<!-- Top Navbar -->
<nav class="top-navbar">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
    <div class="user-profile dropdown">
        <a href="#" class="dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user-circle"></i>
            <span class="ms-2 d-none d-lg-inline"><?= session()->get('username') ?? 'Guest' ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>Profil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= site_url('auth/logout') ?>"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>Logout</a></li>
        </ul>
    </div>
</nav>

<!-- Card Stats -->
<div class="row">
    <!-- Card Total Gejala -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100 py-2 border-start border-primary border-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Gejala</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_gejala ?? 0 ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Total Sparepart -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100 py-2 border-start border-success border-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Sparepart</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_sparepart ?? 0 ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cogs fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Total Users -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100 py-2 border-start border-info border-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_users ?? 0 ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-3x text-gray-300"></i>
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
