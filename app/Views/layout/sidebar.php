<aside class="sidebar">
    <div class="sidebar-header">
        <i class="fas fa-motorcycle brand-icon"></i>
        <h3>Sistem Pakar</h3>
    </div>
    <ul class="sidebar-nav">
        <li>
            <a href="<?= site_url('dashboard') ?>" class="<?= (uri_string() == 'dashboard' || uri_string() == '/') ? 'active' : '' ?>">
                <i class="fas fa-fw fa-home-alt icon"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="<?= site_url('diagnosa') ?>" class="<?= (strpos(uri_string(), 'diagnosa') !== false) ? 'active' : '' ?>">
                <i class="fas fa-fw fa-stethoscope icon"></i>
                <span>Mulai Diagnosa</span>
            </a>
        </li>
        <li>
            <a href="<?= site_url('history') ?>" class="<?= (strpos(uri_string(), 'history') !== false) ? 'active' : '' ?>">
                <i class="fas fa-fw fa-history icon"></i>
                <span>Riwayat</span>
            </a>
        </li>
        <li>
            <a href="<?= site_url('sparepart') ?>" class="<?= (strpos(uri_string(), 'sparepart') !== false) ? 'active' : '' ?>">
                <i class="fas fa-fw fa-cogs icon"></i>
                <span>Daftar Sparepart</span>
            </a>
        </li>
    </ul>
</aside>
