<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>

<!-- Top Navbar dengan Profil Pengguna dan Search Bar -->
<nav class="bg-white border-b border-gray-200 px-4 py-4 sm:px-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-900">Dashboard</h2>
        
        <div class="flex items-center space-x-4">


            <!-- Dropdown Profil Pengguna -->
            <div class="relative">
                <button class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 focus:outline-none" id="userDropdown" onclick="toggleDropdown()">
                    <img src="https://i.pravatar.cc/150?u=<?= session()->get('username') ?? 'guest' ?>" alt="User" class="w-8 h-8 rounded-full">
                    <span class="hidden sm:block font-medium"><?= esc(ucfirst(session()->get('username') ?? 'Guest')) ?></span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                    <a href="<?= site_url('auth/profile') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                    <hr class="border-gray-200">
                    <a href="<?= site_url('auth/logout') ?>" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Banner Selamat Datang (Hero) -->
<div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-lg mx-4 my-6 p-12">
    <div class="max-w-4xl">
        <h1 class="text-4xl font-bold mb-4">Selamat Datang Kembali!</h1>
        <p class="text-xl mb-6 text-primary-100 max-w-3xl">Sistem Pakar ini siap membantu Anda menemukan masalah pada motor dan merekomendasikan sparepart yang tepat.</p>
        <a href="<?= site_url('diagnosa') ?>" class="inline-flex items-center px-6 py-3 bg-white text-primary-700 font-semibold rounded-lg hover:bg-gray-50 transition duration-200">
            <i class="fas fa-wrench mr-2"></i>Mulai Diagnosa Sekarang
        </a>
    </div>
</div>

<!-- Konten Utama: Fitur & Layanan -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mx-4 mb-6">

</div>

<!-- Bagian Informasi & Tips -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mx-4 mb-6">
    <!-- Tips Perawatan Harian -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <h5 class="text-lg font-semibold text-gray-900 mb-4">
                <i class="fas fa-lightbulb mr-2 text-yellow-500"></i>Tips Perawatan Harian
            </h5>
            <div class="space-y-3">
                <div class="flex items-start space-x-3">
                    <div class="bg-yellow-100 p-2 rounded-full">
                        <i class="fas fa-check text-yellow-600 text-sm"></i>
                    </div>
                    <div>
                        <h6 class="font-medium text-gray-900">Periksa Oli Mesin</h6>
                        <p class="text-sm text-gray-600">Cek level dan kualitas oli secara rutin setiap 1000 km</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="bg-yellow-100 p-2 rounded-full">
                        <i class="fas fa-check text-yellow-600 text-sm"></i>
                    </div>
                    <div>
                        <h6 class="font-medium text-gray-900">Tekanan Ban</h6>
                        <p class="text-sm text-gray-600">Pastikan tekanan ban sesuai standar untuk performa optimal</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="bg-yellow-100 p-2 rounded-full">
                        <i class="fas fa-check text-yellow-600 text-sm"></i>
                    </div>
                    <div>
                        <h6 class="font-medium text-gray-900">Rantai Motor</h6>
                        <p class="text-sm text-gray-600">Bersihkan dan lumasi rantai setiap 500 km</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sparepart Populer -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <h5 class="text-lg font-semibold text-gray-900 mb-4">
                <i class="fas fa-star mr-2 text-orange-500"></i>Sparepart Paling Dicari
            </h5>
            <div class="space-y-3">
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-cog text-primary-600"></i>
                        <span class="font-medium text-gray-900">Filter Udara</span>
                    </div>
                    <span class="text-sm text-gray-500">85% pengguna</span>
                </div>
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-oil-can text-primary-600"></i>
                        <span class="font-medium text-gray-900">Oli Mesin</span>
                    </div>
                    <span class="text-sm text-gray-500">78% pengguna</span>
                </div>
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-battery-half text-primary-600"></i>
                        <span class="font-medium text-gray-900">Busi</span>
                    </div>
                    <span class="text-sm text-gray-500">72% pengguna</span>
                </div>
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
