<aside class="sidebar">
    <div class="sidebar-header">
        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM13 13H16V15H13V18H11V15H8V13H11V10H13V13Z"></path></svg>
        <h3>Admin Panel</h3>
    </div>
    <ul class="sidebar-nav">
        <li>
            <a href="<?= site_url('admin/dashboard') ?>" class="<?= (uri_string() == 'admin/dashboard') ? 'active' : '' ?>">
                <i class="fas fa-fw fa-tachometer-alt icon"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="<?= site_url('admin/gejala') ?>" class="<?= (strpos(uri_string(), 'admin/gejala') !== false) ? 'active' : '' ?>">
                <i class="fas fa-fw fa-clipboard-list icon"></i>
                <span>Kelola Gejala</span>
            </a>
        </li>
        <li>
            <a href="<?= site_url('admin/sparepart') ?>" class="<?= (strpos(uri_string(), 'admin/sparepart') !== false) ? 'active' : '' ?>">
                <i class="fas fa-fw fa-cogs icon"></i>
                <span>Kelola Sparepart</span>
            </a>
        </li>
        <!-- Tambahkan link lain di sini jika ada -->
    </ul>
    <div class="sidebar-footer">
        <a href="<?= site_url('auth/logout') ?>">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>
