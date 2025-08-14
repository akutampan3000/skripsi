<?= $this->extend('admin/layout/header') ?>

<?= $this->section('content') ?>
<div class="top-navbar">
    <h1>Riwayat Diagnosa</h1>
    <div class="user-profile">
        <div class="dropdown">
            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle"></i>
                Admin
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= site_url('auth/logout') ?>">Logout</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-history me-2"></i>Riwayat Diagnosa Pengguna</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($diagnosticHistory)): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pengguna</th>
                                    <th>Nama Sparepart</th>
                                    <th>Jenis Masalah</th>
                                    <th>Tanggal Diagnosa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($diagnosticHistory as $history): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2">
                                                    <i class="fas fa-user text-white"></i>
                                                </div>
                                                <strong><?= esc($history['username']) ?></strong>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info text-dark"><?= esc($history['sparepart_name']) ?></span>
                                        </td>
                                        <td>
                                            <?php 
                                                $badgeClass = '';
                                                switch(strtolower($history['problem_type'])) {
                                                    case 'kelistrikan':
                                                        $badgeClass = 'bg-warning text-dark';
                                                        break;
                                                    case 'mesin':
                                                        $badgeClass = 'bg-danger';
                                                        break;
                                                    default:
                                                        $badgeClass = 'bg-secondary';
                                                }
                                            ?>
                                            <span class="badge <?= $badgeClass ?>"><?= esc($history['problem_type']) ?></span>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                <i class="fas fa-calendar-alt me-1"></i>
                                                <?= date('d/m/Y H:i', strtotime($history['diagnosed_at'])) ?>
                                            </small>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-history fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada riwayat diagnosa</h5>
                        <p class="text-muted">Riwayat diagnosa akan muncul setelah pengguna melakukan diagnosa.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-sm {
    width: 32px;
    height: 32px;
    font-size: 14px;
}

.table th {
    border-top: none;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.table td {
    vertical-align: middle;
    padding: 1rem 0.75rem;
}

.badge {
    font-size: 0.75rem;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
}

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-bottom: none;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.025);
}
</style>
<?= $this->endSection() ?>