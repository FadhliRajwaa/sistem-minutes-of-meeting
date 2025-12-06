<div class="container-fluid p-0">
  <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="h3 mb-0 text-gray-800 fw-bold text-dark">Add Discussion</h1>
  </div>

  <div class="row">
      <div class="col-lg-10 mx-auto">
          <div class="card border-0 shadow-sm rounded-3">
              <div class="card-header bg-white border-0 py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Formulir Notulensi Rapat</h6>
              </div>
              <div class="card-body p-4">
                  <form id="discussion-form">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                              <select id="meeting_id" name="meeting_id" class="form-select border-0 shadow-sm bg-light" required>
                                <option value="">-- Pilih Kegiatan Rapat --</option>
                                <?php foreach ($meetings as $meeting): ?>
                                  <option value="<?= $meeting['id'] ?>"><?= $meeting['nama_meeting'] ?></option>
                                <?php endforeach; ?>
                              </select>
                              <label for="meeting_id">Pilih Meeting</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                              <input type="text" id="topik" name="topik" class="form-control border-0 shadow-sm bg-light" placeholder="Topik Utama" required>
                              <label for="topik">Topik Pembahasan</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                      <label class="form-label fw-bold text-muted small">DETAIL PEMBAHASAN</label>
                      <div id="discussion-container" class="d-flex flex-column gap-3">
                        <div class="discussion-slide p-3 rounded-3 shadow-sm position-relative bg-white border border-light">
                          <div class="d-flex justify-content-between align-items-center mb-2">
                              <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">Poin 1</span>
                              <button type="button" class="btn btn-link text-danger p-0 remove-slide opacity-50 hover-opacity-100"><i class="fas fa-times"></i></button>
                          </div>
                          <textarea name="pembahasan[]" class="form-control border-0 bg-light" rows="3" placeholder="Tulis detail pembahasan..." required></textarea>
                        </div>
                      </div>
                      <button type="button" id="add-slide" class="btn btn-outline-primary w-100 mt-3 border-dashed">
                          <i class="fas fa-plus me-2"></i> Tambah Poin Pembahasan
                      </button>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                              <input type="date" id="tanggal" name="tanggal" class="form-control border-0 shadow-sm bg-light" required>
                              <label for="tanggal">Tanggal Pencatatan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-floating">
                              <input type="text" id="nama_notulis" name="nama_notulis" class="form-control border-0 shadow-sm bg-light" placeholder="Nama Notulis" required>
                              <label for="nama_notulis">Nama Notulis</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="reset" class="btn btn-light px-4 rounded-pill">Reset</button>
                        <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm">
                            <i class="fas fa-save me-2"></i> Simpan Notulensi
                        </button>
                    </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>

<style>
    .border-dashed {
        border-style: dashed !important;
    }
    .hover-opacity-100:hover {
        opacity: 1 !important;
    }
</style>

<script>
{
  const baseUrl = typeof siteBaseUrl !== 'undefined' ? siteBaseUrl : '<?= base_url() ?>';

  // Tambah pembahasan
  const addSlideBtn = document.getElementById('add-slide');
  if(addSlideBtn) {
    addSlideBtn.addEventListener('click', function () {
      const count = document.querySelectorAll('.discussion-slide').length + 1;
      const slide = document.createElement('div');
      slide.className = 'discussion-slide p-3 rounded-3 shadow-sm position-relative bg-white border border-light';
      slide.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">Poin ${count}</span>
            <button type="button" class="btn btn-link text-danger p-0 remove-slide opacity-50 hover-opacity-100"><i class="fas fa-times"></i></button>
        </div>
        <textarea name="pembahasan[]" class="form-control border-0 bg-light" rows="3" placeholder="Tulis detail pembahasan..." required></textarea>
      `;
      document.getElementById('discussion-container').appendChild(slide);
    });
  }

  // Hapus pembahasan (Delegation)
  const container = document.getElementById('discussion-container');
  if(container) {
    container.addEventListener('click', function (e) {
      if (e.target.closest('.remove-slide')) {
        e.target.closest('.discussion-slide').remove();
        // Renumber badges logic could be added here if strictly needed
      }
    });
  }

  // Submit form
  const form = document.getElementById('discussion-form');
  if(form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      const formData = new FormData(this);

      fetch(baseUrl + 'discussion/save', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(result => {
        alert(result.message || 'Berhasil disimpan!');
        this.reset();
        document.getElementById('discussion-container').innerHTML = '';
        if(addSlideBtn) addSlideBtn.click(); // Add one default field back
      })
      .catch(error => {
        alert('Gagal menyimpan');
        console.error(error);
      });
    });
  }
}
</script>
