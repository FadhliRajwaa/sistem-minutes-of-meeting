<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Notulen Rapat - <?= esc($meeting['nama_meeting'] ?? 'Meeting') ?></title>
    <style>
        @page {
            margin: 20mm 18mm 22mm 18mm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 10pt;
            color: #1E293B;
            line-height: 1.5;
        }

        /* ===== HEADER ===== */
        .doc-header {
            border-bottom: 2.5px solid #0F766E;
            padding-bottom: 14px;
            margin-bottom: 22px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: middle;
            padding: 0;
        }

        .logo-cell {
            width: 56px;
        }

        .logo {
            width: 50px;
            height: auto;
        }

        .header-text-cell {
            text-align: center;
        }

        .header-text-cell h1 {
            font-size: 20px;
            font-weight: 700;
            color: #0F766E;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            margin: 0 0 2px 0;
        }

        .header-text-cell .subtitle {
            font-size: 9px;
            font-weight: 400;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 4px;
            margin: 0;
        }

        .spacer-cell {
            width: 56px;
        }

        /* ===== DOC META ===== */
        .doc-meta {
            background-color: #F0FDFA;
            border: 1px solid #CCFBF1;
            border-radius: 4px;
            padding: 8px 14px;
            margin-bottom: 20px;
            font-size: 8.5pt;
            color: #64748B;
        }

        .doc-meta table {
            width: 100%;
            border-collapse: collapse;
        }

        .doc-meta td {
            padding: 1px 0;
        }

        .doc-meta .label {
            width: 50%;
            text-align: left;
        }

        .doc-meta .value {
            width: 50%;
            text-align: right;
        }

        /* ===== SECTION HEADERS ===== */
        .section-header {
            color: #0F766E;
            padding: 8px 14px;
            font-size: 10pt;
            font-weight: 700;
            border-left: 3.5px solid #0F766E;
            border-bottom: 1px solid #E2E8F0;
            margin-top: 22px;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            background-color: #F8FFFE;
        }

        /* ===== INFO TABLE ===== */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        .info-table th {
            width: 28%;
            text-align: left;
            padding: 6px 14px;
            color: #64748B;
            font-weight: 600;
            font-size: 9pt;
            border-bottom: 1px solid #F1F5F9;
            vertical-align: top;
        }

        .info-table td {
            padding: 6px 14px;
            color: #1E293B;
            font-size: 9.5pt;
            border-bottom: 1px solid #F1F5F9;
        }

        .info-table td strong {
            color: #0F172A;
            font-weight: 700;
        }

        .info-table tr:last-child th,
        .info-table tr:last-child td {
            border-bottom: none;
        }

        /* ===== PARTICIPANT TABLE ===== */
        .participant-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        .participant-table th {
            background-color: #0F766E;
            color: #ffffff;
            padding: 8px 12px;
            text-align: center;
            font-size: 8.5pt;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .participant-table td {
            padding: 6px 12px;
            border-bottom: 1px solid #F1F5F9;
            text-align: center;
            font-size: 9.5pt;
        }

        .participant-table tbody tr:nth-child(even) {
            background-color: #F8FAFC;
        }

        .participant-table .name-cell {
            text-align: left;
            padding-left: 16px;
            font-weight: 500;
        }

        .status-hadir {
            color: #059669;
            font-weight: 700;
            font-size: 9pt;
        }

        .status-tidak {
            color: #DC2626;
            font-weight: 600;
            font-size: 9pt;
        }

        /* Attendance summary */
        .attendance-summary {
            margin-top: 8px;
            margin-bottom: 4px;
            font-size: 8.5pt;
            color: #64748B;
        }

        .attendance-summary table {
            border-collapse: collapse;
        }

        .attendance-summary td {
            padding: 2px 0;
        }

        .attendance-summary .sum-label {
            padding-right: 8px;
            font-weight: 600;
        }

        .att-dot {
            display: inline-block;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            margin-right: 4px;
        }

        .att-dot-hadir { background-color: #059669; }
        .att-dot-tidak { background-color: #DC2626; }

        .no-data {
            text-align: center;
            color: #94A3B8;
            font-style: italic;
            padding: 20px 0;
            font-size: 9.5pt;
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
            margin-bottom: 6px;
            text-align: justify;
            line-height: 1.6;
            font-size: 9.5pt;
            color: #334155;
        }

        .discussion-text {
            text-align: justify;
            line-height: 1.6;
            font-size: 9.5pt;
            color: #334155;
            padding: 0 8px;
        }

        /* ===== SIGNATURE ===== */
        .signature-section {
            margin-top: 40px;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }

        .signature-table td {
            vertical-align: top;
            padding: 0;
        }

        .signature-left {
            width: 50%;
        }

        .signature-right {
            width: 50%;
            text-align: center;
        }

        .signature-label {
            font-size: 9pt;
            color: #64748B;
            margin-bottom: 0;
        }

        .signature-date {
            font-size: 8.5pt;
            color: #94A3B8;
            margin-bottom: 0;
        }

        .signature-line {
            margin-top: 60px;
            border-top: 1.5px solid #1E293B;
            padding-top: 5px;
            display: inline-block;
            width: 180px;
        }

        .signature-name {
            font-weight: 700;
            font-size: 10pt;
            color: #0F172A;
            margin: 0;
        }

        .signature-role {
            font-size: 8.5pt;
            color: #64748B;
            margin: 0;
        }

        /* ===== FOOTER ===== */
        .doc-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 7.5pt;
            color: #94A3B8;
            border-top: 1px solid #E2E8F0;
            padding-top: 6px;
        }
    </style>
</head>
<body>

    <!-- Document Header -->
    <div class="doc-header">
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    <?php
                        $logoPath = FCPATH . 'images/mom.png';
                        if (file_exists($logoPath) && extension_loaded('gd')) {
                            try {
                                $imageData = base64_encode(file_get_contents($logoPath));
                                echo '<img src="data:image/png;base64,'.$imageData.'" class="logo">';
                            } catch (\Throwable $e) {}
                        }
                    ?>
                </td>
                <td class="header-text-cell">
                    <h1>Minutes of Meeting</h1>
                    <p class="subtitle">Laporan Resmi Pertemuan</p>
                </td>
                <td class="spacer-cell"></td>
            </tr>
        </table>
    </div>

    <!-- Document Meta -->
    <div class="doc-meta">
        <table>
            <tr>
                <td class="label">Kegiatan: <strong><?= esc($meeting['nama_meeting'] ?? '-') ?></strong></td>
                <td class="value">Tanggal cetak: <?= date('d/m/Y H:i') ?> WIB</td>
            </tr>
        </table>
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
            <th>Waktu</th>
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
        <?php
            $totalHadir = 0;
            $totalTidak = 0;
            foreach ($participants as $p) {
                if (strtolower($p['status'] ?? '') === 'hadir') {
                    $totalHadir++;
                } else {
                    $totalTidak++;
                }
            }
        ?>
        <table class="participant-table">
            <thead>
                <tr>
                    <th style="width:8%;">No</th>
                    <th style="width:52%;">Nama Peserta</th>
                    <th style="width:20%;">Barcode ID</th>
                    <th style="width:20%;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($participants as $index => $p): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td class="name-cell"><?= esc($p['name']) ?></td>
                    <td style="font-family:monospace;font-size:8.5pt;color:#64748B;"><?= esc($p['barcode_id'] ?? '-') ?></td>
                    <td>
                        <?php if (strtolower($p['status'] ?? 'hadir') === 'hadir'): ?>
                            <span class="status-hadir">&#10003; Hadir</span>
                        <?php else: ?>
                            <span class="status-tidak">&#10007; Tidak Hadir</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="attendance-summary">
            <table>
                <tr>
                    <td class="sum-label"><span class="att-dot att-dot-hadir"></span> Hadir:</td>
                    <td><?= $totalHadir ?> orang</td>
                    <td style="padding-left:20px;" class="sum-label"><span class="att-dot att-dot-tidak"></span> Tidak Hadir:</td>
                    <td><?= $totalTidak ?> orang</td>
                    <td style="padding-left:20px;" class="sum-label">Total:</td>
                    <td><?= count($participants) ?> orang</td>
                </tr>
            </table>
        </div>
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

    <!-- Signature Section -->
    <div class="signature-section">
        <table class="signature-table">
            <tr>
                <td class="signature-left"></td>
                <td class="signature-right">
                    <p class="signature-label">Dibuat oleh,</p>
                    <p class="signature-date"><?= isset($discussion['tanggal']) ? date('d F Y', strtotime($discussion['tanggal'])) : date('d F Y') ?></p>
                    <div class="signature-line">
                        <p class="signature-name"><?= esc($discussion['nama_notulis'] ?? 'Notulis') ?></p>
                        <p class="signature-role">Notulis</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Footer -->
    <div class="doc-footer">
        Dokumen ini digenerate otomatis oleh Sistem Minutes of Meeting
    </div>

</body>
</html>
