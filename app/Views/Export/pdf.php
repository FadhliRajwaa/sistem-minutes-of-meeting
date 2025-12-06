<!DOCTYPE html>
<html>
<head>
    <title>Minutes of Meeting</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background-color: #f2f2f2; }
        .signature { margin-top: 50px; text-align: right; }
    </style>
</head>
<body>

    <h2>Minutes of Meeting</h2>

    <p><strong>Tanggal Meeting:</strong> <?= $meeting['tanggal'] ?></p>
    <p><strong>Topik Meeting:</strong> <?= $meeting['topik'] ?></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Hasil Pembahasan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($discussions as $disc): ?>
                <tr>
                    <td><?= $disc['nomor'] ?></td>
                    <td><?= nl2br($disc['isi']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="signature">
        <p>Notulis,</p>
        <br><br><br>
        <p><strong><?= $notulis ?></strong></p>
    </div>

</body>
</html>
