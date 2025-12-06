<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h2>Minutes of Meeting</h2>
    <p><strong>Date:</strong> <?= $meeting['tanggal'] ?></p>
    <p><strong>Topic:</strong> <?= $meeting['topik'] ?></p>

    <h4>Participants</h4>
    <table>
        <thead><tr><th>No</th><th>Name</th><th>Status</th></tr></thead>
        <tbody>
            <?php foreach ($participants as $i => $p): ?>
                <tr><td><?= $i+1 ?></td><td><?= $p['nama'] ?></td><td><?= $p['status'] ?></td></tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <h4>Discussion</h4>
    <ul>
        <?php foreach ($discussions as $d): ?>
            <li><?= $d['pembahasan'] ?></li>
        <?php endforeach ?>
    </ul>

    <p><br><br><strong>Notulis:</strong> <?= $notulis ?></p>
</body>
</html>
