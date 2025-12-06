<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notulen Rapat - <?= esc($meeting['nama_meeting'] ?? 'Meeting') ?></title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11pt;
            color: #333;
            line-height: 1.6;
            margin: 0; 
            padding: 0;
        }
        .header-container {
            border-bottom: 3px solid #0056b3;
            padding-bottom: 20px;
            margin-bottom: 30px;
            position: relative;
        }
        .logo {
            width: 80px;
            position: absolute;
            top: 0;
            left: 0;
        }
        .header-text {
            text-align: center;
            margin-left: 0; /* Center alignment */
        }
        .header-text h1 {
            margin: 0;
            font-size: 26px;
            color: #0056b3;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header-text h2 {
            margin: 5px 0 0;
            font-size: 14px;
            font-weight: normal;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .section-header {
            background-color: #f4f6f9;
            color: #0056b3;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: bold;
            border-left: 5px solid #0056b3;
            margin-top: 25px;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table th {
            width: 35%;
            text-align: left;
            padding: 8px;
            background-color: #fff;
            color: #444;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }
        .info-table td {
            padding: 8px;
            color: #222;
            border-bottom: 1px solid #eee;
        }
        .participant-table th {
            background-color: #0056b3;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 12px;
        }
        .participant-table td {
            padding: 8px;
            border: 1px solid #dee2e6;
            text-align: center;
        }
        .discussion-box {
            padding: 0 15px;
        }
        .discussion-list {
            margin: 0;
            padding-left: 20px;
        }
        .discussion-list li {
            margin-bottom: 10px;
            text-align: justify;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #aaa;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        .signature-section {
            margin-top: 60px;
            width: 100%;
        }
        .signature-box {
            float: right;
            width: 250px;
            text-align: center;
        }
        .signature-line {
            margin-top: 80px;
            border-top: 1px solid #333;
        }
    </style>
</head>
<body>

    <div class="header-container">
        <?php 
            // Cek logo, gunakan FCPATH agar terbaca oleh Dompdf
            $logoPath = FCPATH . 'images/mom.png';
            if (file_exists($logoPath)) {
                $imageData = base64_encode(file_get_contents($logoPath));
                $src = 'data:image/png;base64,'.$imageData;
                echo '<img src="'.$src.'" class="logo">';
            }
        ?>
        <div class="header-text">
            <h1>Minutes of Meeting</h1>
            <h2>Laporan Resmi Pertemuan</h2>
        </div>
    </div>

    <div class="section-header">Informasi Rapat</div>
    <table class="info-table">
        <tr>
            <th>Topik Rapat</th>
            <td><strong><?= esc($discussion['topik'] ?? '-') ?></strong></td>
        </tr>
        <tr>
            <th>Kegiatan</th>
            <td><?= esc($meeting['nama_meeting'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Waktu Pelaksanaan</th>
            <td><?= isset($meeting['tanggal']) ? date('d F Y, H:i', strtotime($meeting['tanggal'])) . ' WIB' : '-' ?></td>
        </tr>
        <tr>
            <th>Tempat</th>
            <td><?= esc($meeting['tempat'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Notulis</th>
            <td><?= esc($discussion['nama_notulis'] ?? '-') ?></td>
        </tr>
    </table>

    <div class="section-header">Daftar Hadir</div>
    <?php if(!empty($participants)): ?>
    <table class="participant-table">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th width="60%">Nama Peserta</th>
                <th width="30%">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($participants as $index => $p): ?>
            <tr style="background-color: <?= $index % 2 == 0 ? '#fff' : '#f8f9fa' ?>;">
                <td><?= $index + 1 ?></td>
                <td style="text-align: left; padding-left: 15px;"><?= esc($p['name']) ?></td>
                <td><span style="color: #28a745; font-weight: bold;">Hadir</span></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p style="text-align: center; color: #888; font-style: italic; padding: 20px;">- Data peserta tidak tersedia -</p>
    <?php endif; ?>

    <div class="section-header">Poin Pembahasan</div>
    <div class="discussion-box">
        <?php 
            $pembahasan = json_decode($discussion['pembahasan'], true);
            if (is_array($pembahasan) && !empty($pembahasan)): 
        ?>
            <ul class="discussion-list">
                <?php foreach ($pembahasan as $p): ?>
                    <li><?= esc($p) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p><?= esc($discussion['pembahasan']) ?></p>
        <?php endif; ?>
    </div>

    <div class="signature-section">
        <div class="signature-box">
            <p>Dibuat oleh,</p>
            <div class="signature-line"></div>
            <p><strong><?= esc($discussion['nama_notulis'] ?? 'Notulis') ?></strong></p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="footer">
        Dokumen ini digenerate otomatis oleh Sistem Minutes of Meeting pada <?= date('d/m/Y H:i') ?>
    </div>

</body>
</html>
