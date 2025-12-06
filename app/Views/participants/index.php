<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Daftar Peserta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
  <style>
    .belum-hadir {
        color: red;
        font-weight: bold;
    }
    .hadir {
        color: black;
    }
  </style>
</head>
<body class="bg-light">

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Peserta</h2>
    <div class="d-flex gap-2">
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">
        + Tambah Peserta
      </button>
      <a href="<?= base_url('participants/scan/' . $meeting_id) ?>" class="btn btn-primary">
        + Absen
      </a>
    </div>
  </div>
</div>

  <table class="table table-bordered bg-white shadow-sm">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Status</th>
        <th>Barcode ID</th>
        <th>Waktu Scan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($participants as $index => $p): ?>
        <tr>
          <td>
            <?= $index + 1 ?>
        </td>
          <td class="<?= $p['status'] === 'hadir' ? 'hadir' : 'belum-hadir' ?>"><?= esc($p['name']) ?></td>
          <td><?= esc($p['status']) ?></td>
          <td><?= esc($p['barcode_id']) ?></td>
          <td><?= esc($p['scanned_at']) ?: '-' ?></td>
          <td><a href="<?= base_url('participants/edit/' . $p['id']) ?>" class="text-primary me-2" title="Edit Peserta">
        <i class="fas fa-pen"></i></a>
        <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
       data-delete-url="<?= base_url('participants/delete/' . $p['id']) ?>" title="Hapus Peserta"><i class="fas fa-trash"></i>
      </a>
      <a href="<?= base_url('participants/edit/' . $p['id']) ?>" class="text-primary me-2" title="Edit Peserta">
    <i class="fas fa-pen"></i>
  </a>
      <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
     data-delete-url="<?= base_url('participants/delete/' . $p['id']) ?>" title="Hapus Peserta">
      <i class="fas fa-trash"></i>
      </a>
        </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModalLabel">Hapus Peserta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin menghapus peserta ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <a href="#" class="btn btn-danger" id="confirmDelete">Ya</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModalLabel">Delete Participant</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin menghapus peserta ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <a href="#" class="btn btn-danger" id="btnDeleteConfirm">Yes</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Peserta -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('participants/create') ?>" method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahLabel">Tambah Peserta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="meeting_id" value="<?= $meeting_id ?>">
        <div class="mb-3">
          <label for="name" class="form-label">Nama</label>
          <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
          <label for="barcode_id" class="form-label">Barcode ID</label>
          <input type="text" class="form-control" name="barcode_id" required>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Scan Barcode -->
<div class="modal fade" id="modalScan" tabindex="-1" aria-labelledby="modalScanLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalScanLabel">Scan Barcode</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="reader" style="width:100%"></div>
        <div id="scan-result" class="mt-3 fw-bold text-success"></div>
      </div>
    </div>
  </div>
</div>

<script>
  function onScanSuccess(decodedText, decodedResult) {
    fetch("<?= base_url('participants/scan') ?>", {
      method: "POST",
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify({barcode_id: decodedText, meeting_id: <?= $meeting_id ?>})
    })
    .then(res => res.json())
    .then(res => {
      if (res.status === 'success') {
        document.getElementById('scan-result').innerText = 'Absen berhasil: ' + res.name;
        setTimeout(() => location.reload(), 1000);
      } else {
        document.getElementById('scan-result').innerText = 'Gagal: ' + res.message;
      }
    });
  }

  const html5QrcodeScanner = new Html5QrcodeScanner("reader", {
    fps: 10,
    qrbox: 250
  });
  html5QrcodeScanner.render(onScanSuccess);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const deleteModal = document.getElementById('deleteModal');
  deleteModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const url = button.getAttribute('data-delete-url');
    const confirmBtn = document.getElementById('btnDeleteConfirm');
    confirmBtn.setAttribute('href', url);
  });
</script>

</body>
</html>
