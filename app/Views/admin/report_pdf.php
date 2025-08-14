<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Sistem Sparepart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #4F46E5;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #4F46E5;
            margin: 0;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h2 {
            color: #4F46E5;
            border-bottom: 1px solid #E5E7EB;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #E5E7EB;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #F3F4F6;
            font-weight: bold;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }
        .stat-card {
            border: 1px solid #E5E7EB;
            padding: 15px;
            border-radius: 8px;
        }
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #4F46E5;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #6B7280;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Sistem Sparepart</h1>
        <p>Tanggal: <?= date('d F Y H:i:s') ?></p>
    </div>

    <div class="section">
        <h2>Ringkasan Statistik</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?= $totalDiagnosis ?></div>
                <div>Total Diagnosis</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= count($popularSpareparts) ?></div>
                <div>Sparepart Aktif</div>
            </div>
        </div>
    </div>

    <div class="section">
        <h2>Sparepart Populer</h2>
        <?php if (!empty($popularSpareparts)): ?>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sparepart</th>
                        <th>Kategori</th>
                        <th>Jumlah Penggunaan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($popularSpareparts as $index => $sparepart): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= esc($sparepart['name']) ?></td>
                            <td><?= esc($sparepart['category']) ?></td>
                            <td><?= $sparepart['usage_count'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada data sparepart populer.</p>
        <?php endif; ?>
    </div>

    <div class="section">
        <h2>Statistik Jenis Masalah</h2>
        <?php if (!empty($problemTypeStats)): ?>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Masalah</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($problemTypeStats as $index => $problem): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= esc($problem['problem_type']) ?></td>
                            <td><?= $problem['count'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada data statistik jenis masalah.</p>
        <?php endif; ?>
    </div>

    <div class="section">
        <h2>Aktivitas Pengguna</h2>
        <?php if (!empty($userActivityStats)): ?>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Jumlah Diagnosis</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userActivityStats as $index => $user): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= esc($user['username']) ?></td>
                            <td><?= $user['diagnosis_count'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada data aktivitas pengguna.</p>
        <?php endif; ?>
    </div>

    <div class="footer">
        <p>Laporan ini dibuat secara otomatis oleh Sistem Sparepart pada <?= date('d F Y H:i:s') ?></p>
    </div>
</body>
</html>