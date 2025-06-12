<aside class="sidebar bg-white shadow-xl border-r border-gray-200 h-full flex flex-col" id="sidebar">
    <div class="sidebar-header p-6 border-b border-gray-100">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-br from-primary to-blue-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM13 13H16V15H13V18H11V15H8V13H11V10H13V13Z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800">Admin Panel</h3>
        </div>
    </div>
    <nav class="sidebar-nav flex-1 py-4">
        <ul class="space-y-2 px-4">
            <li>
                <a href="<?= site_url('admin/dashboard') ?>" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 hover:bg-gray-50 group <?= (uri_string() == 'admin/dashboard') ? 'bg-primary text-white shadow-lg' : 'text-gray-700 hover:text-primary' ?>">
                    <i class="fas fa-fw fa-tachometer-alt text-lg <?= (uri_string() == 'admin/dashboard') ? 'text-white' : 'text-gray-500 group-hover:text-primary' ?>"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?= site_url('admin/gejala') ?>" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 hover:bg-gray-50 group <?= (strpos(uri_string(), 'admin/gejala') !== false) ? 'bg-primary text-white shadow-lg' : 'text-gray-700 hover:text-primary' ?>">
                    <i class="fas fa-fw fa-clipboard-list text-lg <?= (strpos(uri_string(), 'admin/gejala') !== false) ? 'text-white' : 'text-gray-500 group-hover:text-primary' ?>"></i>
                    <span class="font-medium">Kelola Gejala</span>
                </a>
            </li>
            <li>
                <a href="<?= site_url('admin/sparepart') ?>" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 hover:bg-gray-50 group <?= (strpos(uri_string(), 'admin/sparepart') !== false) ? 'bg-primary text-white shadow-lg' : 'text-gray-700 hover:text-primary' ?>">
                    <i class="fas fa-fw fa-cogs text-lg <?= (strpos(uri_string(), 'admin/sparepart') !== false) ? 'text-white' : 'text-gray-500 group-hover:text-primary' ?>"></i>
                    <span class="font-medium">Kelola Sparepart</span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="sidebar-footer p-4 border-t border-gray-100">
        <a href="<?= site_url('auth/logout') ?>" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 transition-all duration-200 group">
            <i class="fas fa-sign-out-alt text-lg group-hover:text-red-700"></i>
            <span class="font-medium group-hover:text-red-700">Logout</span>
        </a>
    </div>
</aside>
