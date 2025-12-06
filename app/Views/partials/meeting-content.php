<div class="container-fluid p-0">
  <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="h3 mb-0 text-gray-800 fw-bold text-dark">Manage Meeting</h1>
      <button class="btn btn-primary shadow-sm rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#createMeetingModal">
          <i class="fas fa-plus me-2"></i> Buat Meeting
      </button>
  </div>

  <div class="card border-0 shadow-sm rounded-3">
      <div class="card-header bg-white border-0 py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Daftar Rapat</h6>
      </div>
      <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="bg-light text-secondary">
                <tr>
                  <th class="ps-4 py-3 border-0 rounded-start">No</th>
                  <th class="py-3 border-0">Kegiatan</th>
                  <th class="py-3 border-0">Waktu</th>
                  <th class="py-3 border-0">Tempat</th>
                  <th class="py-3 border-0">Status</th>
                  <th class="pe-4 py-3 border-0 text-end rounded-end">Aksi</th> 
                </tr>
              </thead>
              <tbody>
                <?php if (empty($meetings)): ?>
                    <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada data rapat.</td></tr>
                <?php else: ?>
                    <?php foreach ($meetings as $i => $m): ?>
                    <?php
                      $meetingTime = strtotime($m['tanggal']);
                      $now = time();
                      $status = $meetingTime < $now
                        ? '<span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">Selesai</span>'
                        : '<span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">Belum Mulai</span>';
                    ?>
                    <tr>
                      <td class="ps-4 fw-bold text-muted"><?= $i + 1 ?></td>
                      <td class="fw-bold text-dark"><?= esc($m['nama_meeting']) ?></td>
                      <td>
                          <div class="d-flex flex-column">
                              <span class="fw-bold text-dark"><?= date('d M Y', strtotime($m['tanggal'])) ?></span>
                              <span class="small text-muted"><?= date('H:i', strtotime($m['tanggal'])) ?> WIB</span>
                          </div>
                      </td>
                      <td class="text-muted"><i class="fas fa-map-marker-alt me-1 text-secondary"></i> <?= esc($m['tempat']) ?></td>
                      <td><?= $status ?></td>
                      <td class="text-end pe-4">
                        <button class="btn btn-outline-danger btn-sm rounded-circle btn-delete shadow-sm" data-id="<?= $m['id'] ?>" data-name="<?= esc($m['nama_meeting']) ?>" title="Hapus">
                          <i class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
      </div>
  </div>
</div>

<!-- Modal Form Create Meeting -->
<div class="modal fade" id="createMeetingModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <form id="form-meeting">
        <div class="modal-header border-0 pb-0">
          <h5 class="modal-title fw-bold text-primary">Jadwalkan Rapat Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="p-3 bg-light rounded-3 mb-3">
                <small class="text-muted d-block mb-2">Informasi Dasar</small>
                <div class="mb-3">
                    <label class="form-label fw-bold text-dark small">Nama Kegiatan</label>
                    <input type="text" name="nama_meeting" class="form-control border-0 shadow-sm" placeholder="Contoh: Rapat Evaluasi Q1" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-dark small">Waktu Pelaksanaan</label>
                        <input type="datetime-local" name="tanggal" class="form-control border-0 shadow-sm" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-dark small">Tempat / Link</label>
                        <input type="text" name="tempat" class="form-control border-0 shadow-sm" placeholder="R. Meeting 1 / Zoom" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer border-0 pt-0">
          <button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary px-4 rounded-pill">Simpan Jadwal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-body text-center p-4">
        <div class="mb-3">
          <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-inline-flex p-3">
            <i class="fas fa-trash-alt fa-2x"></i>
          </div>
        </div>
        <h5 class="mb-2 fw-bold">Hapus Rapat?</h5>
        <p class="text-muted mb-4">Anda akan menghapus data meeting: <br><strong id="deleteMeetingName" class="text-dark"></strong></p>
        
        <input type="hidden" id="deleteMeetingId">
        
        <div class="d-flex justify-content-center gap-2">
          <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-danger px-4 rounded-pill" id="confirmDeleteBtn">
            Ya, Hapus
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Toast Notification -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
  <div id="toastNotif" class="toast align-items-center border-0 shadow-lg" role="alert">
    <div class="d-flex">
      <div class="toast-body d-flex align-items-center fw-bold">
        <i id="toastIcon" class="me-2" style="font-size: 1.2rem;"></i>
        <span id="toastMessage"></span>
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>

<script>
{
  // Gunakan block scope agar variabel tidak bentrok saat diload ulang
  // Gunakan siteBaseUrl dari main layout, jangan deklarasi ulang const baseUrl

  function showToast(message, type = 'success') {
    const toast = document.getElementById('toastNotif');
    const toastMessage = document.getElementById('toastMessage');
    const toastIcon = document.getElementById('toastIcon');
    
    if (!toast) return; // Safety check

    toast.classList.remove('bg-success', 'bg-danger', 'bg-warning', 'text-white');
    
    if (type === 'success') {
      toast.classList.add('bg-success', 'text-white');
      toastIcon.className = 'fas fa-check-circle me-2';
    } else if (type === 'error') {
      toast.classList.add('bg-danger', 'text-white');
      toastIcon.className = 'fas fa-times-circle me-2';
    } else {
      toast.classList.add('bg-warning');
      toastIcon.className = 'fas fa-exclamation-circle me-2';
    }
    
    toastMessage.textContent = message;
    const bsToast = new bootstrap.Toast(toast, { delay: 3000 });
    bsToast.show();
  }

  const deleteModalEl = document.getElementById('deleteConfirmModal');
  const deleteModal = new bootstrap.Modal(deleteModalEl);
  
  // Tombol delete - buka modal konfirmasi
  document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', () => {
      const id = button.dataset.id;
      const name = button.dataset.name;
      document.getElementById('deleteMeetingId').value = id;
      document.getElementById('deleteMeetingName').textContent = name;
      deleteModal.show();
    });
  });

  // Konfirmasi hapus
  const confirmBtn = document.getElementById('confirmDeleteBtn');
  
  confirmBtn.addEventListener('click', () => {
    const id = document.getElementById('deleteMeetingId').value;
    
    // Gunakan siteBaseUrl yang didefinisikan di main.php
    fetch(siteBaseUrl + 'meeting/delete', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'id=' + id
    })
    .then(res => res.json())
    .then(data => {
      deleteModal.hide();
      if (data.success) {
        showToast('Meeting berhasil dihapus!', 'success');
        // Reload content partial instead of full page reload for smoother UX
        loadContent('meeting'); 
      } else {
        showToast(data.message || 'Gagal menghapus meeting', 'error');
      }
    })
    .catch(err => {
      deleteModal.hide();
      showToast('Terjadi kesalahan!', 'error');
      console.error(err);
    });
  });

  // Form create meeting
  const formMeeting = document.getElementById('form-meeting');
  formMeeting.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch(siteBaseUrl + 'meeting/save', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      // Tutup modal create
      const createModalEl = document.getElementById('createMeetingModal');
      const createModal = bootstrap.Modal.getInstance(createModalEl) || new bootstrap.Modal(createModalEl);
      createModal.hide();
      
      showToast('Meeting berhasil dibuat!', 'success');
      loadContent('meeting'); // Reload content partial
    })
    .catch(err => {
      showToast('Gagal membuat meeting', 'error');
      console.error(err);
    });
  });
}
</script>
