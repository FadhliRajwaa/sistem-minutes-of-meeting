<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Scan Barcode Peserta</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    #reader {
      width: 100%;
      max-width: 400px;
      margin: 0 auto;
      border: 2px solid #0d6efd;
      border-radius: 10px;
      padding: 10px;
    }
    .result {
      background: #f0f8ff;
      padding: 10px;
      margin-top: 15px;
      border-radius: 8px;
    }
  </style>
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2 class="text-center mb-4">Scan Barcode Peserta</h2>
    <div id="reader"></div>
    <div id="result" class="result d-none"></div>
    
      <form action="/participants/mark-present" method="POST" class="mt-4 d-none" id="participantForm">
      <input type="hidden" name="meeting_id" value="<?= $meeting_id ?>">
      <input type="hidden" name="nama_peserta" id="nama_peserta">
      <input type="hidden" name="barcode_id" id="barcode_id">
      <button type="submit" class="btn btn-success w-100">Absen Sekarang</button>
    </form>
  </div>
  <div id="submitMsg" class="mt-3 text-center text-success d-none">
  ✅ Absen berhasil!
</div>
<a href="<?= base_url('participants/' . $meeting_id) ?>" class="btn btn-secondary mt-4">
    ← Kembali ke Daftar Peserta
</a>
<div id="loading" class="text-center mt-3 d-none">
  <div class="spinner-border text-primary" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>

  <script src="https://unpkg.com/html5-qrcode"></script>
  <script>
    function onScanSuccess(decodedText) {
      // Format barcode misalnya: NamaPeserta|BarcodeID123
      const data = decodedText.split('|');

      if (data.length === 2) {
        const nama = data[0].trim();
        const barcode = data[1].trim();

        document.getElementById('nama_peserta').value = nama;
        document.getElementById('barcode_id').value = barcode;

        document.getElementById('result').classList.remove('d-none');
        document.getElementById('result').innerHTML = `<strong>Nama:</strong> ${nama}<br><strong>Kode Barcode:</strong> ${barcode}`;

        document.getElementById('participantForm').classList.remove('d-none');
        html5QrcodeScanner.clear(); // stop scanner
      }
    }

    const html5QrcodeScanner = new Html5QrcodeScanner("reader", {
      fps: 10,
      qrbox: 250
    });
    html5QrcodeScanner.render(onScanSuccess);
      // Tambahkan auto-submit AJAX saat form tampil
  const form = document.getElementById('participantForm');
  form.addEventListener('submit', function(e) {
    e.preventDefault(); // stop default form submit
    document.getElementById('loading').classList.remove('d-none');

    const formData = new FormData(form);
    fetch(form.action, {
      method: 'POST',
      body: formData
    }).then(response => response.json())
      .then(data => {
        document.getElementById('loading').classList.add('d-none');

        if (data.status === 'success') {
          document.getElementById('submitMsg').classList.remove('d-none');
          form.classList.add('d-none'); // sembunyikan form
        } else {
          alert(data.message || 'Gagal absen.');
        }
      }).catch(err => {
        document.getElementById('loading').classList.add('d-none');
        alert('Terjadi kesalahan saat mengirim data.');
        console.error(err);
      });
  });
  </script>
</body>
</html>
