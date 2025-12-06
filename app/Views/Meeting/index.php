<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Meeting</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <style>
    body {
      background: url('images/batik.avif') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
    }
  </style>
</head>
<body class="p-5">
  <div class="container">
    <h2 class="mb-4">Daftar Meeting</h2>
    <a href="<?= base_url('meeting/create') ?>" class="btn btn-success mb-3">➕ Buat Meeting Baru</a>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>id</th>
          <th>title</th>
          <th>date</th>
          <th>location</th>
          <th>created_by</th>
          <th>created_at</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($meeting as $m): ?>
        <tr>
          <td><?= esc($m['id']) ?></td>
          <td><?= esc($m['title']) ?></td>
          <td><?= esc($m['date']) ?></td>
          <td><?= esc($m['location']) ?></td>
          <td><?= esc($m['created_by']) ?></td>
          <td><?= esc($m['created_at']) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
