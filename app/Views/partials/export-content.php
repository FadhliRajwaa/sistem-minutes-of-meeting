<div class="container-fluid p-0">
  <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="h3 mb-0 text-gray-800 fw-bold text-dark">Export to PDF</h1>
  </div>

  <div class="card border-0 shadow-sm rounded-3">
      <div class="card-header bg-white border-0 py-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
          <h6 class="m-0 font-weight-bold text-primary">Arsip Notulensi</h6>
          <div class="input-group" style="max-width: 300px;">
              <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted"></i></span>
              <input type="text" id="search-discussion" class="form-control border-0 bg-light" placeholder="Cari topik, notulis...">
          </div>
      </div>
      
      <div class="card-body p-0">
        <style>
            @media (max-width: 768px) {
                /* Force table to not be like tables anymore */
                .no-more-tables table, 
                .no-more-tables thead, 
                .no-more-tables tbody, 
                .no-more-tables th, 
                .no-more-tables td, 
                .no-more-tables tr { 
                    display: block; 
                }
         
                /* Hide table headers (but not display: none;, for accessibility) */
                .no-more-tables thead tr { 
                    position: absolute;
                    top: -9999px;
                    left: -9999px;
                }
         
                .no-more-tables tr { 
                    border: 1px solid #eee; 
                    margin-bottom: 10px; 
                    border-radius: 8px;
                    background: #fff;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
                }
         
                .no-more-tables td { 
                    /* Behave  like a "row" */
                    border: none;
                    border-bottom: 1px solid #eee; 
                    position: relative;
                    padding-left: 50% !important; 
                    white-space: normal;
                    text-align: left;
                }
         
                .no-more-tables td:before { 
                    /* Now like a table header */
                    position: absolute;
                    /* Top/left values mimic padding */
                    top: 12px;
                    left: 15px;
                    width: 45%; 
                    padding-right: 10px; 
                    white-space: nowrap;
                    text-align: left;
                    font-weight: bold;
                    color: #6c757d;
                }
         
                /* Label the data */
                .no-more-tables td:nth-of-type(1):before { content: "Pilih"; }
                .no-more-tables td:nth-of-type(2):before { content: "Topik"; }
                .no-more-tables td:nth-of-type(3):before { content: "Notulis"; }
                .no-more-tables td:nth-of-type(4):before { content: "Tanggal"; }

                /* Adjust input check position */
                .no-more-tables td:nth-of-type(1) {
                    padding-left: 15px !important;
                    text-align: right;
                }
                .no-more-tables td:nth-of-type(1):before {
                    content: "";
                }

                /* Action Buttons Stack */
                .action-buttons {
                    flex-direction: column;
                    width: 100%;
                }
                .action-buttons button {
                    width: 100%;
                }
            }
        </style>
        <form action="<?= base_url('export/pdf') ?>" method="post" target="_blank" id="exportForm">
            <div class="table-responsive no-more-tables">
              <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary">
                  <tr>
                    <th class="ps-4 py-3 border-0 rounded-start" style="width: 50px;">Pilih</th>
                    <th class="py-3 border-0">Topik Pembahasan</th>
                    <th class="py-3 border-0">Notulis</th>
                    <th class="pe-4 py-3 border-0 rounded-end">Tanggal</th>
                  </tr>
                </thead>
                <tbody id="discussion-table-body">
                  <?php if(empty($discussions)): ?>
                     <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada data diskusi.</td></tr>
                  <?php else: ?>
                      <?php foreach ($discussions as $item): ?>
                        <tr>
                          <td class="ps-4">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="discussion_id" value="<?= $item['id'] ?>" required>
                              </div>
                          </td>
                          <td class="fw-bold text-dark"><?= esc($item['topik']) ?></td>
                          <td class="text-muted"><?= esc($item['nama_notulis']) ?></td>
                          <td class="pe-4 font-monospace text-muted small"><?= esc($item['tanggal']) ?></td>
                        </tr>
                      <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

            <div class="p-3 border-top d-flex justify-content-end gap-2 bg-white rounded-bottom action-buttons">
              <button id="viewBtn" type="button" class="btn btn-outline-primary rounded-pill px-4" disabled>
                  <i class="fas fa-eye me-2"></i> Preview
              </button>
              <button id="deleteBtn" type="button" class="btn btn-outline-danger rounded-pill px-4" disabled>
                  <i class="fas fa-trash me-2"></i> Hapus
              </button>
              <button id="exportBtn" type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm" disabled>
                  <i class="fas fa-file-download me-2"></i> Download PDF
              </button>
            </div>
        </form>
      </div>
  </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-body text-center p-4">
        <div class="mb-3">
          <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-inline-flex p-3">
            <i class="fas fa-trash-alt fa-2x"></i>
          </div>
        </div>
        <h5 class="mb-2 fw-bold">Hapus Arsip?</h5>
        <p class="text-muted mb-0">Apakah Anda yakin ingin menghapus data diskusi ini?</p>
        <p class="text-danger small mb-4">Tindakan ini tidak dapat dibatalkan.</p>
        <small id="deleteError" class="text-danger mt-1 d-none"></small>
        
        <div class="d-flex justify-content-center gap-2">
            <button class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
            <button id="confirmDeleteBtn" class="btn btn-danger px-4 rounded-pill">Ya, Hapus</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- PDF.js Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
  pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
</script>

<div class="modal fade" id="previewPdfModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg rounded-4" style="height: 90vh;">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title fw-bold text-primary"><i class="fas fa-file-pdf me-2"></i>Preview Notulensi</h5>
        <div class="d-flex align-items-center gap-2">
          <button id="pdfPrevPage" class="btn btn-sm btn-outline-secondary" disabled><i class="fas fa-chevron-left"></i></button>
          <span id="pdfPageInfo" class="small text-muted">1 / 1</span>
          <button id="pdfNextPage" class="btn btn-sm btn-outline-secondary" disabled><i class="fas fa-chevron-right"></i></button>
          <button type="button" class="btn-close ms-3" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>
      <div class="modal-body p-2 bg-light d-flex justify-content-center align-items-start overflow-auto" style="flex: 1;">
         <div id="pdfLoader" class="text-center position-absolute" style="top: 50%; transform: translateY(-50%);">
             <div class="spinner-border text-primary" role="status"></div>
             <p class="mt-2 text-muted">Memuat dokumen...</p>
         </div>
         <canvas id="pdfCanvas" style="max-width: 100%; box-shadow: 0 4px 15px rgba(0,0,0,0.1);"></canvas>
      </div>
      <div class="modal-footer border-top-0">
        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
        <a id="downloadPdfBtn" href="#" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="fas fa-download me-2"></i> Download
        </a>
      </div>
    </div>
  </div>
</div>

<script>
{
  // Gunakan block scope agar aman saat reload partial
  const exportBtn = document.getElementById("exportBtn");
  const viewBtn = document.getElementById("viewBtn");
  const deleteBtn = document.getElementById("deleteBtn");
  let selectedID = null;

  function refreshRadioEvents() {
    document.querySelectorAll('input[name="discussion_id"]').forEach(radio => {
      radio.addEventListener("change", () => {
        selectedID = radio.value;
        exportBtn.disabled = false;
        viewBtn.disabled = false;
        deleteBtn.disabled = false;
      });
    });
  }

  // Panggil langsung saat script dimuat
  refreshRadioEvents();

  const searchInput = document.getElementById("search-discussion");
  if (searchInput) {
    searchInput.addEventListener("keyup", function () {
      let keyword = this.value;
      
      // Gunakan siteBaseUrl dari main layout jika ada, atau fallback
      const url = (typeof siteBaseUrl !== 'undefined' ? siteBaseUrl : '<?= base_url() ?>') + 'discussion/search?keyword=' + keyword;

      fetch(url)
        .then(res => res.json())
        .then(data => {
          let rows = "";
          if (data.length === 0) {
            rows = `<tr><td colspan="4" class="text-center py-4 text-muted">Tidak ada data ditemukan</td></tr>`;
          } else {
            data.forEach(item => {
              rows += `
                <tr>
                  <td class="ps-4">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="discussion_id" value="${item.id}" required>
                      </div>
                  </td>
                  <td class="fw-bold text-dark">${item.topik}</td>
                  <td class="text-muted">${item.notulis ?? item.nama_notulis}</td>
                  <td class="pe-4 font-monospace text-muted small">${item.tanggal}</td>
                </tr>
              `;
            });
          }
          document.getElementById("discussion-table-body").innerHTML = rows;
          refreshRadioEvents();
        })
        .catch(err => console.error("Search error:", err));
    });
  }

  // PDF.js Preview Variables
  let pdfDoc = null;
  let currentPage = 1;
  let totalPages = 0;
  const pdfCanvas = document.getElementById('pdfCanvas');
  const pdfCtx = pdfCanvas ? pdfCanvas.getContext('2d') : null;
  
  function renderPdfPage(pageNum) {
    if (!pdfDoc) return;
    pdfDoc.getPage(pageNum).then(function(page) {
      const scale = 1.5;
      const viewport = page.getViewport({ scale: scale });
      pdfCanvas.height = viewport.height;
      pdfCanvas.width = viewport.width;
      
      const renderContext = {
        canvasContext: pdfCtx,
        viewport: viewport
      };
      page.render(renderContext);
      
      // Update page info
      document.getElementById('pdfPageInfo').textContent = pageNum + ' / ' + totalPages;
      document.getElementById('pdfPrevPage').disabled = (pageNum <= 1);
      document.getElementById('pdfNextPage').disabled = (pageNum >= totalPages);
    });
  }
  
  // Page navigation
  document.getElementById('pdfPrevPage')?.addEventListener('click', () => {
    if (currentPage > 1) {
      currentPage--;
      renderPdfPage(currentPage);
    }
  });
  
  document.getElementById('pdfNextPage')?.addEventListener('click', () => {
    if (currentPage < totalPages) {
      currentPage++;
      renderPdfPage(currentPage);
    }
  });

  if (viewBtn) {
    viewBtn.addEventListener("click", function () {
      if (!selectedID) return;
      const baseUrl = typeof siteBaseUrl !== 'undefined' ? siteBaseUrl : '<?= base_url() ?>';
      const pdfUrl = baseUrl + "export/pdf/" + selectedID + "?preview=true";
      const downloadUrl = baseUrl + "export/pdf/" + selectedID; 
      
      // FIX MOBILE PREVIEW: Google Docs Viewer for mobile
      if (window.innerWidth < 768) {
          const googleViewerUrl = 'https://docs.google.com/gview?embedded=true&url=' + encodeURIComponent(downloadUrl);
          window.open(googleViewerUrl, '_blank');
          return;
      }

      const previewModal = new bootstrap.Modal(document.getElementById('previewPdfModal'));
      const loader = document.getElementById('pdfLoader');
      const downloadBtn = document.getElementById('downloadPdfBtn');
      
      // Reset state
      loader.style.display = 'block';
      pdfCanvas.style.display = 'none';
      currentPage = 1;
      pdfDoc = null;
      
      previewModal.show();
      downloadBtn.href = downloadUrl;
      
      // Use PDF.js to load PDF via ArrayBuffer (bypasses IDM)
      fetch(pdfUrl)
        .then(response => response.arrayBuffer())
        .then(data => {
          pdfjsLib.getDocument({ data: data }).promise.then(function(pdf) {
            pdfDoc = pdf;
            totalPages = pdf.numPages;
            loader.style.display = 'none';
            pdfCanvas.style.display = 'block';
            renderPdfPage(currentPage);
          });
        })
        .catch(err => {
          console.error('PDF load error:', err);
          loader.innerHTML = '<p class="text-danger">Gagal memuat PDF</p>';
        });
    });
  }

  if (deleteBtn) {
    deleteBtn.addEventListener("click", function () {
      document.getElementById("deleteError").classList.add("d-none");
      const modal = new bootstrap.Modal(document.getElementById("deleteModal"));
      modal.show();
    });
  }

  const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
  if (confirmDeleteBtn) {
    confirmDeleteBtn.addEventListener("click", function () {
      const baseUrl = typeof siteBaseUrl !== 'undefined' ? siteBaseUrl : '<?= base_url() ?>';

      fetch(baseUrl + "discussion/delete", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: selectedID })
      })
      .then(res => res.json())
      .then(result => {
        if (!result.success) {
          document.getElementById("deleteError").textContent = "Gagal menghapus data!";
          document.getElementById("deleteError").classList.remove("d-none");
        } else {
          // Tutup modal
          const modalEl = document.getElementById("deleteModal");
          const modal = bootstrap.Modal.getInstance(modalEl);
          if (modal) modal.hide();
          
          // Reload content tanpa reload page
          if (typeof loadContent === 'function') {
             loadContent('export');
          } else {
             location.reload();
          }
        }
      })
      .catch(err => console.error("Delete error:", err));
    });
  }
}
</script>
