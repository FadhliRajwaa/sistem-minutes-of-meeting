<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Tambah Peserta</h2>

<form action="/meetings/addParticipant/<?= $meeting_id ?>" method="post">
    <div>
        <label for="nama_peserta">Nama Peserta:</label>
        <input type="text" name="nama_peserta" id="nama_peserta" required>
    </div>

    <div>
        <label for="barcode_id">ID Barcode:</label>
        <input type="text" name="barcode_id" id="barcode_id" required>
    </div>

    <button type="submit">Simpan</button>
</form>

<?= $this->endSection() ?>
