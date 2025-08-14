<aside class="sidebar fixed left-0 top-0 w-64 h-full bg-white border-r border-gray-200 p-5 flex flex-col z-30 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-30 h-30 rounded-xl mb-4">
            <img src="<?= base_url('logo.png') ?>" alt="Logo" class="w-30 h-30 rounded-xl object-cover">
        </div>
        <h3 class="text-xl font-bold text-gray-800">JAM SPEED Expert System</h3>
        <p class="text-sm text-gray-500 mt-1">Sparepart Motor</p>
    </div>
    
    <!-- Navigation -->
    <nav class="flex-1">
        <ul class="space-y-2">
            <li>
                <a href="<?= site_url('dashboard') ?>" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-all duration-200 group <?= (uri_string() == 'dashboard' || uri_string() == '/') ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-lg shadow-primary-500/25' : 'text-gray-600 hover:bg-primary-50 hover:text-primary-600' ?>">
                    <i class="fas fa-home text-lg <?= (uri_string() == 'dashboard' || uri_string() == '/') ? 'text-white' : 'text-gray-400 group-hover:text-primary-500' ?>"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?= site_url('diagnosa') ?>" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-all duration-200 group <?= (strpos(uri_string(), 'diagnosa') !== false && strpos(uri_string(), 'history') === false && strpos(uri_string(), 'sparepart') === false) ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-lg shadow-primary-500/25' : 'text-gray-600 hover:bg-primary-50 hover:text-primary-600' ?>">
                    <i class="fas fa-stethoscope text-lg <?= (strpos(uri_string(), 'diagnosa') !== false && strpos(uri_string(), 'history') === false && strpos(uri_string(), 'sparepart') === false) ? 'text-white' : 'text-gray-400 group-hover:text-primary-500' ?>"></i>
                    <span>Mulai Diagnosa</span>
                </a>
            </li>

        </ul>
    </nav>
    
    <!-- Logout Button -->
    <div class="mt-auto">
        <a href="<?= site_url('auth/logout') ?>" 
           class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-all duration-200 group text-red-600 hover:bg-red-50 hover:text-red-700 mb-4">
            <i class="fas fa-sign-out-alt text-lg text-red-400 group-hover:text-red-500"></i>
            <span>Logout</span>
        </a>
    </div>
    
    <!-- Footer Info -->
    <div class="pt-4 border-t border-gray-100">
        <div class="text-center">
            <p class="text-xs text-gray-400">Version 1.0</p>
            <p class="text-xs text-gray-400 mt-1">© 2025 Expert Systems Recomendation Spareparts @andhyka</p>
        </div>
    </div>
</aside>
