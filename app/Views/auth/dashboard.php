<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>

<!-- Top Navbar dengan Profil Pengguna dan Search Bar -->
<nav class="bg-white border-b border-gray-200 px-4 py-4 sm:px-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-900">Dashboard</h2>
        
        <div class="flex items-center space-x-4">
            <!-- Fitur Quick Access: Search Bar -->
            <div class="hidden md:block">
                <form action="<?= site_url('diagnosa/daftar-sparepart') ?>" method="get">
                    <div class="flex">
                        <input type="text" name="q" class="block w-64 px-3 py-2 border border-gray-300 rounded-l-md placeholder-gray-500 focus:outline-none focus:ring-primary-500 focus:border-primary-500" placeholder="Cari sparepart...">
                        <button class="px-4 py-2 bg-primary-600 text-white rounded-r-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Dropdown Profil Pengguna -->
            <div class="relative">
                <button class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 focus:outline-none" id="userDropdown" onclick="toggleDropdown()">
                    <img src="https://i.pravatar.cc/150?u=<?= session()->get('username') ?? 'guest' ?>" alt="User" class="w-8 h-8 rounded-full">
                    <span class="hidden sm:block font-medium"><?= esc(ucfirst(session()->get('username') ?? 'Guest')) ?></span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                    <hr class="border-gray-200">
                    <a href="<?= site_url('auth/logout') ?>" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Banner Selamat Datang (Hero) -->
<div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-lg mx-4 my-6 p-8">
    <div class="max-w-4xl">
        <h1 class="text-4xl font-bold mb-4">Selamat Datang Kembali!</h1>
        <p class="text-xl mb-6 text-primary-100 max-w-3xl">Sistem Pakar ini siap membantu Anda menemukan masalah pada motor dan merekomendasikan sparepart yang tepat.</p>
        <a href="<?= site_url('diagnosa') ?>" class="inline-flex items-center px-6 py-3 bg-white text-primary-700 font-semibold rounded-lg hover:bg-gray-50 transition duration-200">
            <i class="fas fa-wrench mr-2"></i>Mulai Diagnosa Sekarang
        </a>
    </div>
</div>

<!-- Konten Utama: Riwayat, Statistik, Info -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mx-4 mb-6">
    <!-- Kolom Kiri: Riwayat Diagnosa Terakhir -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 h-full">
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <h5 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-history mr-2 text-primary-600"></i>Riwayat Diagnosa Terakhir Anda
                </h5>
                <a href="<?= site_url('diagnosa/history') ?>" class="text-primary-600 hover:text-primary-700 text-sm font-medium">Lihat Semua</a>
            </div>
            <div class="p-6">
                <?php if (!empty($recent_history)): ?>
                    <div class="space-y-4">
                        <?php foreach ($recent_history as $item): ?>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100 last:border-b-0">
                                <div>
                                    <div class="font-semibold text-primary-700"><?= esc($item['sparepart_name']) ?></div>
                                    <div class="text-sm text-gray-600">Masalah <?= esc($item['problem_type']) ?></div>
                                </div>
                                <span class="text-sm text-gray-500"><?= date('d M Y', strtotime($item['diagnosed_at'])) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <i class="fas fa-clipboard-list text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">Anda belum memiliki riwayat diagnosa.</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="bg-gray-50 px-6 py-3 text-center border-t border-gray-200 rounded-b-lg">
                <a href="<?= site_url('diagnosa/history') ?>" class="text-primary-600 hover:text-primary-700 font-medium">Lihat Semua Riwayat</a>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Statistik & Info Sparepart -->
    <div class="space-y-6">
        <!-- Kartu Statistik -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h5 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-chart-pie mr-2 text-primary-600"></i>Statistik Anda
                </h5>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Total Diagnosa</span>
                        <span class="bg-primary-100 text-primary-800 px-3 py-1 rounded-full text-sm font-medium"><?= esc($stats['total']) ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Masalah Tersering</span>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium"><?= esc($stats['most_frequent']) ?></span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Kartu Info Sparepart -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h5 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-cogs mr-2 text-primary-600"></i>Basis Data Sparepart
                </h5>
                <p class="text-gray-600 mb-4">
                    Total <strong class="text-primary-700"><?= esc($total_spareparts) ?></strong> jenis sparepart ada di dalam basis pengetahuan kami.
                </p>
                <a href="<?= site_url('diagnosa/daftar-sparepart') ?>" class="w-full inline-flex justify-center items-center px-4 py-2 border border-primary-300 text-primary-700 bg-white hover:bg-primary-50 rounded-lg font-medium transition duration-200">
                    Lihat Daftar Lengkap
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function toggleDropdown() {
    const dropdown = document.getElementById('userDropdownMenu');
    dropdown.classList.toggle('hidden');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('userDropdownMenu');
    const button = document.getElementById('userDropdown');
    
    if (!button.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.add('hidden');
    }
});
</script>

<?= $this->endSection() ?>
