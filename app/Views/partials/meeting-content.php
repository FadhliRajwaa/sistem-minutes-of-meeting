<style>
    /* ── Meeting Page Scoped Styles ── */
    .meeting-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.75rem;
    }
    .meeting-header-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .meeting-header h2 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #0F172A;
        margin: 0;
        letter-spacing: -0.025em;
    }
    .meeting-count-badge {
        background: rgba(15, 118, 110, 0.08);
        color: #0F766E;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 20px;
        white-space: nowrap;
    }

    .btn-create-meeting {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: #0F766E;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.22, 1, 0.36, 1);
        white-space: nowrap;
    }
    .btn-create-meeting:hover {
        background: #0D9488;
        box-shadow: 0 4px 16px rgba(15, 118, 110, 0.25);
        transform: translateY(-1px);
    }
    .btn-create-meeting:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(15, 118, 110, 0.2);
    }

    /* Table Card */
    .table-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        overflow: hidden;
    }
    .table-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .table-card-header h6 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.9rem;
        font-weight: 600;
        color: #0F172A;
        margin: 0;
    }
    .table-card-header .badge-count {
        background: rgba(15, 118, 110, 0.08);
        color: #0F766E;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 20px;
    }

    /* Table */
    .mtg-table {
        width: 100%;
        border-collapse: collapse;
    }
    .mtg-table thead th {
        padding: 14px 24px;
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #64748B;
        background: #F8FAFC;
        border-bottom: 1px solid #E2E8F0;
        white-space: nowrap;
    }
    .mtg-table thead th:first-child {
        padding-left: 24px;
    }
    .mtg-table thead th:last-child {
        text-align: right;
        padding-right: 24px;
    }

    .mtg-table tbody tr {
        transition: background 0.2s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .mtg-table tbody tr:hover {
        background: #F8FAFC;
    }
    .mtg-table tbody td {
        padding: 16px 24px;
        font-size: 0.88rem;
        color: #334155;
        border-bottom: 1px solid #F1F5F9;
        vertical-align: middle;
    }
    .mtg-table tbody tr:last-child td {
        border-bottom: none;
    }
    .mtg-table tbody td:first-child {
        padding-left: 24px;
    }
    .mtg-table tbody td:last-child {
        text-align: right;
        padding-right: 24px;
    }

    .mtg-table .td-num {
        font-weight: 600;
        color: #94A3B8;
        font-size: 0.82rem;
        width: 50px;
    }
    .mtg-table .td-name {
        font-weight: 600;
        color: #0F172A;
    }
    .mtg-table .td-time .date-main {
        font-weight: 600;
        color: #0F172A;
        font-size: 0.88rem;
    }
    .mtg-table .td-time .date-sub {
        font-size: 0.78rem;
        color: #94A3B8;
        margin-top: 2px;
    }
    .mtg-table .td-place {
        color: #64748B;
        font-size: 0.85rem;
    }
    .mtg-table .td-place i {
        color: #94A3B8;
        margin-right: 6px;
        font-size: 0.8rem;
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        white-space: nowrap;
    }
    .status-badge .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
        flex-shrink: 0;
    }
    .status-badge.done {
        background: rgba(5, 150, 105, 0.08);
        color: #059669;
    }
    .status-badge.pending {
        background: rgba(217, 119, 6, 0.08);
        color: #D97706;
    }

    /* Delete Button */
    .btn-delete-row {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: 1px solid #E2E8F0;
        background: #fff;
        color: #94A3B8;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.22, 1, 0.36, 1);
        font-size: 0.78rem;
    }
    .btn-delete-row:hover {
        background: #FEF2F2;
        border-color: #FECACA;
        color: #EF4444;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.12);
    }
    .btn-delete-row:active {
        transform: translateY(0);
    }

    /* Empty State */
    .empty-state {
        padding: 48px 24px;
        text-align: center;
    }
    .empty-state .empty-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: #F1F5F9;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #94A3B8;
        margin-bottom: 16px;
    }
    .empty-state h6 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.95rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 4px;
    }
    .empty-state p {
        font-size: 0.85rem;
        color: #94A3B8;
        margin: 0;
    }

    /* Modal Styles */
    .modal-meeting .modal-content {
        border: none;
        border-radius: 16px;
        box-shadow: 0 24px 64px rgba(15, 23, 42, 0.12);
    }
    .modal-meeting .modal-header {
        padding: 24px 28px 12px;
        border: none;
    }
    .modal-meeting .modal-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.1rem;
        font-weight: 700;
        color: #0F172A;
    }
    .modal-meeting .modal-body {
        padding: 12px 28px 16px;
    }
    .modal-meeting .modal-footer {
        padding: 12px 28px 24px;
        border: none;
    }

    .modal-meeting .form-section {
        background: #F8FAFC;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid #F1F5F9;
    }
    .modal-meeting .form-section .section-label {
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #94A3B8;
        margin-bottom: 14px;
    }
    .modal-meeting .form-label {
        font-size: 0.82rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 6px;
    }
    .modal-meeting .form-control {
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.88rem;
        background: #fff;
        transition: border-color 0.2s cubic-bezier(0.22, 1, 0.36, 1),
                    box-shadow 0.2s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .modal-meeting .form-control:focus {
        border-color: #0F766E;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.08);
    }
    .modal-meeting .form-control::placeholder {
        color: #94A3B8;
    }

    .btn-modal-cancel {
        padding: 9px 20px;
        border-radius: 10px;
        border: 1px solid #E2E8F0;
        background: #fff;
        color: #64748B;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .btn-modal-cancel:hover {
        background: #F8FAFC;
        border-color: #CBD5E1;
    }

    .btn-modal-save {
        padding: 9px 24px;
        border-radius: 10px;
        border: none;
        background: #0F766E;
        color: #fff;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .btn-modal-save:hover {
        background: #0D9488;
        box-shadow: 0 4px 12px rgba(15, 118, 110, 0.25);
    }

    /* Delete Modal */
    .delete-modal-body {
        padding: 32px 28px;
        text-align: center;
    }
    .delete-modal-body .delete-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        background: #FEF2F2;
        color: #EF4444;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 16px;
    }
    .delete-modal-body h5 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.05rem;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 8px;
    }
    .delete-modal-body p {
        font-size: 0.88rem;
        color: #64748B;
        margin-bottom: 24px;
    }
    .delete-modal-body p strong {
        color: #0F172A;
    }

    .btn-modal-delete {
        padding: 9px 24px;
        border-radius: 10px;
        border: none;
        background: #EF4444;
        color: #fff;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .btn-modal-delete:hover {
        background: #DC2626;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
    }

    /* Toast */
    .toast-meeting {
        position: fixed;
        top: 84px;
        right: 24px;
        z-index: 1090;
        min-width: 300px;
        max-width: 420px;
        padding: 14px 20px;
        border-radius: 12px;
        font-size: 0.88rem;
        font-weight: 600;
        display: none;
        align-items: center;
        gap: 10px;
        box-shadow: 0 10px 40px rgba(15, 23, 42, 0.15), 0 4px 12px rgba(15, 23, 42, 0.08);
        animation: toastSlideIn 0.35s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }
    .toast-meeting.show {
        display: flex;
    }
    .toast-meeting.toast-success {
        background: #ECFDF5;
        color: #059669;
        border: 1px solid #A7F3D0;
    }
    .toast-meeting.toast-error {
        background: #FEF2F2;
        color: #EF4444;
        border: 1px solid #FECACA;
    }
    .toast-meeting .toast-close {
        margin-left: auto;
        background: none;
        border: none;
        color: inherit;
        opacity: 0.5;
        cursor: pointer;
        font-size: 1.1rem;
        padding: 0;
        line-height: 1;
        transition: opacity 0.2s ease;
    }
    .toast-meeting .toast-close:hover {
        opacity: 1;
    }

    @keyframes toastSlideIn {
        from {
            opacity: 0;
            transform: translateX(24px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .meeting-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
        .btn-create-meeting {
            width: 100%;
            justify-content: center;
        }
        .mtg-table thead th,
        .mtg-table tbody td {
            padding: 12px 16px;
        }
        .mtg-table thead th:first-child,
        .mtg-table tbody td:first-child {
            padding-left: 16px;
        }
        .mtg-table thead th:last-child,
        .mtg-table tbody td:last-child {
            padding-right: 16px;
        }
        .table-card-header {
            padding: 16px;
        }
        .toast-meeting {
            top: 72px;
            left: 12px;
            right: 12px;
            min-width: auto;
            max-width: none;
        }
    }
</style>

<!-- Header -->
<div class="container-fluid p-0">
    <div class="meeting-header">
        <div class="meeting-header-left">
            <h2>Manage Meeting</h2>
            <?php if (!empty($meetings)): ?>
                <span class="meeting-count-badge"><?= count($meetings) ?> rapat</span>
            <?php endif; ?>
        </div>
        <button class="btn-create-meeting" data-bs-toggle="modal" data-bs-target="#createMeetingModal">
            <i class="fas fa-plus"></i> Buat Meeting
        </button>
    </div>

    <!-- Table Card -->
    <div class="table-card">
        <div class="table-card-header">
            <h6>Daftar Rapat</h6>
            <?php if (!empty($meetings)): ?>
                <span class="badge-count"><?= count($meetings) ?> rapat</span>
            <?php endif; ?>
        </div>
        <div class="table-responsive">
            <table class="mtg-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Waktu</th>
                        <th>Tempat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($meetings)): ?>
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-icon"><i class="fas fa-calendar-plus"></i></div>
                                    <h6>Belum ada rapat terjadwal</h6>
                                    <p>Klik "Buat Meeting" untuk menambahkan jadwal rapat baru.</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($meetings as $i => $m): ?>
                        <?php
                            $meetingTime = strtotime($m['tanggal']);
                            $now = time();
                            $isDone = $meetingTime < $now;
                        ?>
                        <tr>
                            <td class="td-num"><?= $i + 1 ?></td>
                            <td class="td-name"><?= esc($m['nama_meeting']) ?></td>
                            <td class="td-time">
                                <div class="date-main"><?= date('d M Y', strtotime($m['tanggal'])) ?></div>
                                <div class="date-sub"><?= date('H:i', strtotime($m['tanggal'])) ?> WIB</div>
                            </td>
                            <td class="td-place">
                                <i class="fas fa-map-marker-alt"></i><?= esc($m['tempat']) ?>
                            </td>
                            <td>
                                <?php if ($isDone): ?>
                                    <span class="status-badge done"><span class="dot"></span> Selesai</span>
                                <?php else: ?>
                                    <span class="status-badge pending"><span class="dot"></span> Belum Mulai</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <button class="btn-delete-row btn-delete"
                                        data-id="<?= $m['id'] ?>"
                                        data-name="<?= esc($m['nama_meeting']) ?>"
                                        title="Hapus rapat">
                                    <i class="fas fa-trash-alt"></i>
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

<!-- Modal Create Meeting -->
<div class="modal fade modal-meeting" id="createMeetingModal" tabindex="-1" aria-labelledby="createMeetingLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-meeting">
                <div class="modal-header">
                    <h5 class="modal-title" id="createMeetingLabel">Jadwalkan Rapat Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="form-section">
                        <div class="section-label">Informasi Rapat</div>
                        <div class="mb-3">
                            <label class="form-label" for="input-nama-meeting">Nama Kegiatan</label>
                            <input type="text"
                                   id="input-nama-meeting"
                                   name="nama_meeting"
                                   class="form-control"
                                   placeholder="Contoh: Rapat Evaluasi Q1"
                                   required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="input-tanggal">Waktu Pelaksanaan</label>
                                <input type="datetime-local"
                                       id="input-tanggal"
                                       name="tanggal"
                                       class="form-control"
                                       required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="input-tempat">Tempat / Link</label>
                                <input type="text"
                                       id="input-tempat"
                                       name="tempat"
                                       class="form-control"
                                       placeholder="R. Meeting 1 / Zoom"
                                       required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-modal-save">
                        <i class="fas fa-check me-1"></i> Simpan Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete Confirm -->
<div class="modal fade modal-meeting" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="delete-modal-body">
                <div class="delete-icon"><i class="fas fa-trash-alt"></i></div>
                <h5 id="deleteConfirmLabel">Hapus Rapat?</h5>
                <p>Data meeting <strong id="deleteMeetingName"></strong> akan dihapus permanen.</p>
                <input type="hidden" id="deleteMeetingId">
                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn-modal-delete" id="confirmDeleteBtn">
                        <i class="fas fa-trash-alt me-1"></i> Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div class="toast-meeting" id="toastMeeting">
    <i id="toastMeetingIcon"></i>
    <span id="toastMeetingMsg"></span>
    <button class="toast-close" onclick="this.parentElement.classList.remove('show')">&times;</button>
</div>

<script>
{
    const baseUrl = typeof siteBaseUrl !== 'undefined' ? siteBaseUrl : '<?= base_url() ?>';

    /**
     * Show toast notification
     * @param {string} message - Message to display
     * @param {string} type - 'success' or 'error'
     */
    function showToast(message, type) {
        var toast = document.getElementById('toastMeeting');
        var icon = document.getElementById('toastMeetingIcon');
        var msg = document.getElementById('toastMeetingMsg');
        if (!toast) return;

        toast.classList.remove('toast-success', 'toast-error', 'show');
        void toast.offsetWidth; // Force reflow for re-animation

        if (type === 'success') {
            toast.classList.add('toast-success');
            icon.className = 'fas fa-check-circle';
        } else {
            toast.classList.add('toast-error');
            icon.className = 'fas fa-exclamation-circle';
        }

        msg.textContent = message;
        toast.classList.add('show');

        setTimeout(function() {
            toast.classList.remove('show');
        }, 3500);
    }

    // ── Delete Modal Logic ──
    var deleteModalEl = document.getElementById('deleteConfirmModal');
    var deleteModal = new bootstrap.Modal(deleteModalEl);

    document.querySelectorAll('.btn-delete').forEach(function(button) {
        button.addEventListener('click', function() {
            document.getElementById('deleteMeetingId').value = this.dataset.id;
            document.getElementById('deleteMeetingName').textContent = this.dataset.name;
            deleteModal.show();
        });
    });

    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        var id = document.getElementById('deleteMeetingId').value;
        var btn = this;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menghapus...';

        fetch(baseUrl + 'meeting/delete', {
            method: 'POST',
            headers: getCsrfHeaders({ 'Content-Type': 'application/x-www-form-urlencoded' }),
            body: appendCsrf('id=' + encodeURIComponent(id))
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            deleteModal.hide();
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-trash-alt me-1"></i> Ya, Hapus';

            if (data.success) {
                showToast('Meeting berhasil dihapus!', 'success');
                setTimeout(function() { loadContent('meeting'); }, 400);
            } else {
                showToast(data.message || 'Gagal menghapus meeting', 'error');
            }
        })
        .catch(function(err) {
            deleteModal.hide();
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-trash-alt me-1"></i> Ya, Hapus';
            showToast('Terjadi kesalahan jaringan!', 'error');
        });
    });

    // ── Create Form Logic ──
    document.getElementById('form-meeting').addEventListener('submit', function(e) {
        e.preventDefault();
        var form = this;
        var formData = new FormData(form);
        var submitBtn = form.querySelector('.btn-modal-save');
        var originalText = submitBtn.innerHTML;

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';

        fetch(baseUrl + 'meeting/save', {
            method: 'POST',
            headers: getCsrfHeaders(),
            body: appendCsrf(formData)
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            var createModalEl = document.getElementById('createMeetingModal');
            var createModal = bootstrap.Modal.getInstance(createModalEl) || new bootstrap.Modal(createModalEl);
            createModal.hide();

            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
            form.reset();

            if (data.success !== false) {
                showToast('Meeting berhasil dibuat!', 'success');
                setTimeout(function() { loadContent('meeting'); }, 400);
            } else {
                showToast(data.message || 'Gagal membuat meeting', 'error');
            }
        })
        .catch(function(err) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
            showToast('Gagal membuat meeting. Periksa koneksi Anda.', 'error');
        });
    });
}
</script>
