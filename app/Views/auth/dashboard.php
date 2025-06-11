<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>
<!-- Top Navbar -->
<nav class="top-navbar">
    <h2 class="page-title">Dashboard</h2>
    <div class="user-profile dropdown">
        <a href="#" class="dropdown-toggle d-flex align-items-center" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://i.pravatar.cc/150?u=<?= session()->get('username') ?? 'guest' ?>" alt="User" class="me-2">
            <span><?= session()->get('username') ?? 'Guest' ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="#">Profil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="<?= site_url('auth/logout') ?>">Logout</a></li>
        </ul>
    </div>
</nav>

<!-- Welcome Hero -->
<div class="p-5 mb-4 rounded-3" style="background: var(--primary-gradient);">
    <div class="container-fluid py-5 text-white">
        <h1 class="display-5 fw-bold">Selamat Datang!</h1>
        <p class="col-md-8 fs-4">Sistem Pakar ini siap membantu Anda menemukan masalah pada motor dan merekomendasikan sparepart yang tepat. Klik tombol di bawah untuk memulai.</p>
        <a href="<?= site_url('diagnosa') ?>" class="btn btn-light btn-lg" type="button">
            <i class="fas fa-stethoscope me-2"></i>Mulai Diagnosa Sekarang
        </a>
    </div>
</div>

<!-- Quick Info Cards -->
<div class="row align-items-md-stretch">
    <div class="col-md-6 mb-4">
        <div class="h-100 p-5 text-bg-dark rounded-3">
            <h2>Riwayat Diagnosa</h2>
            <p>Lihat kembali semua hasil diagnosa yang pernah Anda lakukan sebelumnya.</p>
            <a href="<?= site_url('history') ?>" class="btn btn-outline-light" type="button">Lihat Riwayat</a>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="h-100 p-5 bg-light border rounded-3">
            <h2>Daftar Sparepart</h2>
            <p>Jelajahi daftar lengkap sparepart yang ada di dalam basis pengetahuan kami.</p>
            <a href="<?= site_url('sparepart') ?>" class="btn btn-outline-secondary" type="button">Lihat Daftar</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->include('layout/footer') ?>