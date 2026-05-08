<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Notulen Rapat - <?= esc($meeting['nama_meeting'] ?? 'Meeting') ?></title>
    <style>
        /* ===== PDF Template - Minutes of Meeting ===== */
        @page {
            margin: 25mm 20mm 25mm 20mm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 11pt;
            color: #1E293B;
            line-height: 1.6;
        }

        /* ===== HEADER ===== */
        .doc-header {
            border-bottom: 3px solid #0F766E;
            padding-bottom: 18px;
            margin-bottom: 28px;
            position: relative;
        }

        .logo {
            width: 64px;
            height: auto;
            position: absolute;
            top: 0;
            left: 0;
        }

        .header-text {
            text-align: center;
            padding-top: 4px;
        }

        .header-text h1 {
            font-size: 22px;
            font-weight: 700;
            color: #0F766E;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0 0 4px 0;
        }

        .header-text .subtitle {
            font-size: 10px;
            font-weight: 400;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin: 0;
        }

        .header-accent {
            width: 50px;
            height: 3px;
            background: #0D9488;
            margin: 10px auto 0;
            border-radius: 2px;
        }

        /* ===== SECTION HEADERS ===== */
        .section-header {
            background-color: #F0FDFA;
            color: #0F766E;
            padding: 10px 16px;
            font-size: 11px;
            font-weight: 700;
            border-left: 4px solid #0F766E;
            margin-top: 24px;
            margin-bottom: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ===== INFO TABLE ===== */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .info-table th {
            width: 30%;
            text-align: left;
            padding: 7px 12px;
            color: #64748B;
            font-weight: 600;
            font-size: 10pt;
            border-bottom: 1px solid #E2E8F0;
            vertical-align: top;
        }

        .info-table td {
            padding: 7px 12px;
            color: #1E293B;
            font-size: 10.5pt;
            border-bottom: 1px solid #E2E8F0;
        }

        .info-table td strong {
            color: #0F172A;
        }

        /* ===== PARTICIPANT TABLE ===== */
        .participant-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .participant-table th {
            background-color: #0F766E;
            color: #ffffff;
            padding: 9px 12px;
            text-align: center;
            font-size: 9.5pt;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .participant-table th:first-child {
            border-radius: 4px 0 0 0;
        }

        .participant-table th:last-child {
            border-radius: 0 4px 0 0;
        }

        .participant-table td {
            padding: 7px 12px;
            border-bottom: 1px solid #E2E8F0;
            text-align: center;
            font-size: 10pt;
        }

        .participant-table tbody tr:nth-child(even) {
            background-color: #F8FAFC;
        }

        .participant-table tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .participant-table .name-cell {
            text-align: left;
            padding-left: 16px;
            font-weight: 500;
        }

        .status-hadir {
            color: #059669;
            font-weight: 700;
            font-size: 9.5pt;
        }

        .status-tidak {
            color: #DC2626;
            font-weight: 600;
            font-size: 9.5pt;
        }

        .no-data {
            text-align: center;
            color: #94A3B8;
            font-style: italic;
            padding: 24px 0;
            font-size: 10pt;
        }

        /* ===== DISCUSSION POINTS ===== */
        .discussion-box {
            padding: 0 8px;
        }

        .discussion-list {
            margin: 0;
            padding-left: 20px;
        }

        .discussion-list li {
            margin-bottom: 8px;
            text-align: justify;
            line-height: 1.7;
            font-size: 10.5pt;
            color: #334155;
        }

        .discussion-text {
            text-align: justify;
            line-height: 1.7;
            font-size: 10.5pt;
            color: #334155;
            padding: 0 8px;
        }

        /* ===== SIGNATURE ===== */
        .signature-section {
            margin-top: 50px;
            width: 100%;
        }

        .signature-box {
            float: right;
            width: 220px;
            text-align: center;
        }

        .signature-label {
            font-size: 10pt;
            color: #64748B;
            margin-bottom: 0;
        }

        .signature-date {
            font-size: 9pt;
            color: #94A3B8;
            margin-bottom: 0;
        }

        .signature-line {
            margin-top: 70px;
            border-top: 1.5px solid #1E293B;
            padding-top: 6px;
        }

        .signature-name {
            font-weight: 700;
            font-size: 10.5pt;
            color: #0F172A;
            margin: 0;
        }

        .signature-role {
            font-size: 9pt;
            color: #64748B;
            margin: 0;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        /* ===== FOOTER ===== */
        .doc-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8pt;
            color: #94A3B8;
            border-top: 1px solid #E2E8F0;
            padding-top: 8px;
            padding-bottom: 2px;
        }

        .doc-footer .footer-line {
            display: block;
        }
    </style>
</head>
<body>

    <!-- Document Header -->
    <div class="doc-header">
        <?php
            $logoPath = FCPATH . 'images/mom.png';
            if (file_exists($logoPath) && extension_loaded('gd')) {
                try {
                    $imageData = base64_encode(file_get_contents($logoPath));
                    $src = 'data:image/png;base64,'.$imageData;
                    echo '<img src="'.$src.'" class="logo">';
                } catch (\Throwable $e) {}
            }
        ?>
        <div class="header-text">
            <h1>Minutes of Meeting</h1>
            <p class="subtitle">Laporan Resmi Pertemuan</p>
            <div class="header-accent"></div>
        </div>
    </div>

    <!-- Section: Informasi Rapat -->
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

    <!-- Section: Daftar Hadir -->
    <div class="section-header">Daftar Hadir</div>
    <?php if (!empty($participants)): ?>
    <table class="participant-table">
        <thead>
            <tr>
                <th style="width:10%;">No</th>
                <th style="width:60%;">Nama Peserta</th>
                <th style="width:30%;">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($participants as $index => $p): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td class="name-cell"><?= esc($p['name']) ?></td>
                <td>
                    <?php
                        $status = strtolower($p['status'] ?? 'hadir');
                        if ($status === 'hadir'):
                    ?>
                        <span class="status-hadir">&#10003; Hadir</span>
                    <?php else: ?>
                        <span class="status-tidak">&#10007; Tidak Hadir</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p class="no-data">- Data peserta tidak tersedia -</p>
    <?php endif; ?>

    <!-- Section: Poin Pembahasan -->
    <div class="section-header">Poin Pembahasan</div>
    <div class="discussion-box">
        <?php
            $pembahasan = json_decode($discussion['pembahasan'], true);
            if (is_array($pembahasan) && !empty($pembahasan)):
        ?>
            <ol class="discussion-list">
                <?php foreach ($pembahasan as $p): ?>
                    <li><?= esc($p) ?></li>
                <?php endforeach; ?>
            </ol>
        <?php else: ?>
            <p class="discussion-text"><?= esc($discussion['pembahasan']) ?></p>
        <?php endif; ?>
    </div>

    <!-- Signature Section (right-aligned) -->
    <div class="signature-section clearfix">
        <div class="signature-box">
            <p class="signature-label">Dibuat oleh,</p>
            <p class="signature-date"><?= isset($discussion['tanggal']) ? date('d F Y', strtotime($discussion['tanggal'])) : date('d F Y') ?></p>
            <div class="signature-line">
                <p class="signature-name"><?= esc($discussion['nama_notulis'] ?? 'Notulis') ?></p>
                <p class="signature-role">Notulis</p>
            </div>
        </div>
    </div>

    <!-- Footer (fixed bottom) -->
    <div class="doc-footer">
        <span class="footer-line">Dokumen ini digenerate otomatis oleh Sistem Minutes of Meeting</span>
        <span class="footer-line"><?= date('d/m/Y H:i') ?> WIB</span>
    </div>

</body>
</html>
