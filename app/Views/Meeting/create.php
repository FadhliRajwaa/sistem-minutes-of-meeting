<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Create Meeting</title>
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
    <h2 class="mb-4">Create Meeting</h2>
    <form action="<?= base_url('meeting/store') ?>" method="post">
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" name="date" id="date" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="location" class="form-label">Location</label>
        <input type="text" name="location" id="location" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="created_by" class="form-label">created_by</label>
        <input type="text" name="created_by" id="created_by" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="created_at" class="form-label">created_at</label>
        <input type="date" name="created_at" id="created_at" class="form-control" required>
      </div>
      <!-- Optional: created_by & created_at otomatis di backend -->
      <button type="submit" class="btn btn-primary">Save Meeting</button>
    </form>
  </div>
</body>
</html>

