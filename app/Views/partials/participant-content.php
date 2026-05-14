<style>
    /* ===== PARTICIPANT PAGE - Premium Design System ===== */
    .participant-page {
        --color-primary: #0F766E;
        --color-accent: #0D9488;
        --color-surface: #F8FAFC;
        --color-border: #E2E8F0;
        --color-text: #0F172A;
        --color-muted: #64748B;
        --color-success: #059669;
        --color-danger: #DC2626;
        --color-warning: #D97706;
        --radius-sm: 6px;
        --radius-md: 10px;
        --radius-lg: 14px;
        --radius-xl: 18px;
        --shadow-xs: 0 1px 2px rgba(15,23,42,0.04);
        --shadow-sm: 0 1px 3px rgba(15,23,42,0.06), 0 1px 2px rgba(15,23,42,0.04);
        --shadow-md: 0 4px 6px -1px rgba(15,23,42,0.06), 0 2px 4px -2px rgba(15,23,42,0.04);
        --shadow-lg: 0 10px 15px -3px rgba(15,23,42,0.06), 0 4px 6px -4px rgba(15,23,42,0.04);
        --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
        --transition-base: 200ms cubic-bezier(0.4, 0, 0.2, 1);
        --transition-slow: 300ms cubic-bezier(0.4, 0, 0.2, 1);
    }

    .participant-page .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.75rem;
        gap: 1rem;
    }

    .participant-page .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--color-text);
        margin: 0;
        letter-spacing: -0.025em;
        line-height: 1.2;
    }

    .participant-page .page-subtitle {
        font-size: 0.8125rem;
        color: var(--color-muted);
        margin-top: 2px;
        font-weight: 400;
    }

    .participant-page .btn-scan-barcode {
        background: var(--color-success);
        color: #fff;
        border: none;
        padding: 0.625rem 1.25rem;
        border-radius: 100px;
        font-weight: 600;
        font-size: 0.8125rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all var(--transition-base);
        box-shadow: 0 1px 2px rgba(5,150,105,0.2);
        white-space: nowrap;
    }

    .participant-page .btn-scan-barcode:hover {
        background: #047857;
        box-shadow: 0 4px 12px rgba(5,150,105,0.3);
        transform: translateY(-1px);
    }

    .participant-page .btn-scan-barcode:active {
        transform: translateY(0);
    }

    /* Cards */
    .participant-page .p-card {
        background: #fff;
        border: 1px solid var(--color-border);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        transition: box-shadow var(--transition-base);
    }

    .participant-page .p-card:hover {
        box-shadow: var(--shadow-md);
    }

    .participant-page .p-card-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--color-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        background: #fff;
    }

    .participant-page .p-card-title {
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--color-text);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        letter-spacing: -0.01em;
    }

    .participant-page .p-card-title .title-icon {
        width: 28px;
        height: 28px;
        border-radius: var(--radius-sm);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        flex-shrink: 0;
    }

    .participant-page .p-card-title .title-icon.teal {
        background: rgba(15,118,110,0.08);
        color: var(--color-primary);
    }

    .participant-page .p-card-title .title-icon.blue {
        background: rgba(59,130,246,0.08);
        color: #3B82F6;
    }

    .participant-page .p-card-body {
        padding: 1.25rem;
    }

    /* Form Elements */
    .participant-page .form-label-sm {
        font-size: 0.6875rem;
        font-weight: 600;
        color: var(--color-muted);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }

    .participant-page .select-meeting {
        width: 100%;
        padding: 0.625rem 0.875rem;
        border: 1px solid var(--color-border);
        border-radius: var(--radius-md);
        font-size: 0.875rem;
        color: var(--color-text);
        background-color: var(--color-surface);
        transition: all var(--transition-fast);
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748B' d='M6 8.825a.5.5 0 0 1-.354-.146l-3.5-3.5a.5.5 0 0 1 .708-.708L6 7.618l3.146-3.147a.5.5 0 0 1 .708.708l-3.5 3.5A.5.5 0 0 1 6 8.825z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.875rem center;
        padding-right: 2.25rem;
        cursor: pointer;
    }

    .participant-page .select-meeting:focus {
        outline: none;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(15,118,110,0.1);
        background-color: #fff;
    }

    .participant-page .btn-add-manual {
        width: 100%;
        padding: 0.625rem 1rem;
        background: var(--color-primary);
        color: #fff;
        border: none;
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 0.8125rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all var(--transition-base);
        margin-top: 1rem;
    }

    .participant-page .btn-add-manual:hover {
        background: #115E59;
        box-shadow: 0 4px 12px rgba(15,118,110,0.25);
        transform: translateY(-1px);
    }

    .participant-page .btn-add-manual:active {
        transform: translateY(0);
    }

    /* Badge Count */
    .participant-page .badge-count {
        background: rgba(15,118,110,0.08);
        color: var(--color-primary);
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        border-radius: 100px;
        letter-spacing: -0.01em;
    }

    /* Table */
    .participant-page .p-table {
        width: 100%;
        border-collapse: collapse;
    }

    .participant-page .p-table thead th {
        padding: 0.75rem 1rem;
        font-size: 0.6875rem;
        font-weight: 600;
        color: var(--color-muted);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid var(--color-border);
        background: var(--color-surface);
        white-space: nowrap;
    }

    .participant-page .p-table thead th:first-child { padding-left: 1.25rem; }
    .participant-page .p-table thead th:last-child { padding-right: 1.25rem; }

    .participant-page .p-table tbody td {
        padding: 0.75rem 1rem;
        font-size: 0.8125rem;
        color: var(--color-text);
        border-bottom: 1px solid var(--color-border);
        vertical-align: middle;
    }

    .participant-page .p-table tbody td:first-child { padding-left: 1.25rem; }
    .participant-page .p-table tbody td:last-child { padding-right: 1.25rem; }

    .participant-page .p-table tbody tr {
        transition: background var(--transition-fast);
    }

    .participant-page .p-table tbody tr:hover {
        background: var(--color-surface);
    }

    .participant-page .p-table tbody tr:last-child td {
        border-bottom: none;
    }

    .participant-page .td-num {
        color: var(--color-muted);
        font-weight: 600;
        font-variant-numeric: tabular-nums;
        width: 48px;
    }

    .participant-page .td-name {
        font-weight: 600;
        color: var(--color-text);
    }

    .participant-page .td-barcode {
        font-family: 'SF Mono', 'Fira Code', 'Consolas', monospace;
        font-size: 0.75rem;
        color: var(--color-muted);
        background: var(--color-surface);
        padding: 0.2rem 0.5rem;
        border-radius: var(--radius-sm);
        display: inline-block;
    }

    .participant-page .td-time {
        font-size: 0.75rem;
        color: var(--color-muted);
        font-variant-numeric: tabular-nums;
    }

    /* Status Badges */
    .participant-page .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.25rem 0.625rem;
        border-radius: 100px;
        font-size: 0.6875rem;
        font-weight: 600;
        letter-spacing: -0.01em;
    }

    .participant-page .status-badge.hadir {
        background: rgba(5,150,105,0.08);
        color: var(--color-success);
    }

    .participant-page .status-badge.belum {
        background: rgba(100,116,139,0.08);
        color: var(--color-muted);
    }

    /* Empty State */
    .participant-page .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
        color: var(--color-muted);
    }

    .participant-page .empty-state .empty-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: var(--color-surface);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.75rem;
        font-size: 1.125rem;
        color: var(--color-muted);
    }

    .participant-page .empty-state p {
        font-size: 0.8125rem;
        margin: 0;
    }

    /* Modal Styling */
    .participant-page .modal-content.p-modal {
        border: none;
        border-radius: var(--radius-xl);
        box-shadow: 0 25px 50px -12px rgba(15,23,42,0.15);
        overflow: hidden;
    }

    .participant-page .p-modal .modal-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--color-border);
    }

    .participant-page .p-modal .modal-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--color-text);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .participant-page .p-modal .modal-body {
        padding: 1.5rem;
    }

    .participant-page .p-modal .modal-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--color-border);
    }

    .participant-page .p-input-group {
        margin-bottom: 1.25rem;
    }

    .participant-page .p-input-group:last-child {
        margin-bottom: 0;
    }

    .participant-page .p-input-label {
        display: block;
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--color-text);
        margin-bottom: 0.375rem;
    }

    .participant-page .p-input {
        width: 100%;
        padding: 0.625rem 0.875rem;
        border: 1px solid var(--color-border);
        border-radius: var(--radius-md);
        font-size: 0.875rem;
        color: var(--color-text);
        background: var(--color-surface);
        transition: all var(--transition-fast);
    }

    .participant-page .p-input:focus {
        outline: none;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(15,118,110,0.1);
        background: #fff;
    }

    .participant-page .p-input::placeholder {
        color: #94A3B8;
    }

    .participant-page .btn-cancel {
        padding: 0.5rem 1rem;
        background: var(--color-surface);
        color: var(--color-muted);
        border: 1px solid var(--color-border);
        border-radius: var(--radius-md);
        font-weight: 500;
        font-size: 0.8125rem;
        transition: all var(--transition-fast);
    }

    .participant-page .btn-cancel:hover {
        background: #F1F5F9;
        color: var(--color-text);
    }

    .participant-page .btn-save {
        padding: 0.5rem 1.25rem;
        background: var(--color-primary);
        color: #fff;
        border: none;
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 0.8125rem;
        transition: all var(--transition-base);
    }

    .participant-page .btn-save:hover {
        background: #115E59;
    }

    /* Scanner Modal */
    .participant-page .scanner-area {
        background: #000;
        position: relative;
        overflow: hidden;
        min-height: 280px;
    }

    .participant-page .scanner-area #reader {
        width: 100% !important;
    }

    .participant-page .scanner-area #reader video {
        border-radius: 0 !important;
    }

    .participant-page .scan-status {
        padding: 0.75rem 1rem;
        background: rgba(15,118,110,0.06);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.8125rem;
        font-weight: 500;
        color: var(--color-primary);
    }

    .participant-page .scan-result {
        padding: 1.5rem;
        text-align: center;
    }

    .participant-page .scan-result-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.75rem;
        font-size: 1.25rem;
    }

    .participant-page .scan-result-icon.success {
        background: rgba(5,150,105,0.1);
        color: var(--color-success);
    }

    .participant-page .scan-result-icon.warning {
        background: rgba(217,119,6,0.1);
        color: var(--color-warning);
    }

    .participant-page .scan-result-icon.error {
        background: rgba(220,38,38,0.1);
        color: var(--color-danger);
    }

    .participant-page .scan-result-text {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--color-text);
        margin: 0;
    }

    .participant-page .scanner-footer {
        padding: 0.875rem 1.25rem;
        border-top: 1px solid var(--color-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
    }

    .participant-page .scanner-footer .info-text {
        font-size: 0.75rem;
        color: var(--color-muted);
        display: flex;
        align-items: center;
        gap: 0.375rem;
        margin: 0;
    }

    .participant-page .btn-rescan {
        padding: 0.375rem 0.875rem;
        background: rgba(5,150,105,0.08);
        color: var(--color-success);
        border: 1px solid rgba(5,150,105,0.2);
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        transition: all var(--transition-fast);
    }

    .participant-page .btn-rescan:hover {
        background: rgba(5,150,105,0.15);
        border-color: rgba(5,150,105,0.3);
    }

    /* Responsive */
    @media (max-width: 767.98px) {
        .participant-page .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .participant-page .btn-scan-barcode {
            width: 100%;
            justify-content: center;
        }

        .participant-page .p-table-wrap {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .participant-page .p-table {
            min-width: 560px;
        }
    }

    /* Spinner */
    .participant-page .spinner-sm {
        width: 14px;
        height: 14px;
        border: 2px solid rgba(255,255,255,0.3);
        border-top-color: #fff;
        border-radius: 50%;
        animation: p-spin 0.6s linear infinite;
    }

    .participant-page .spinner-teal {
        width: 16px;
        height: 16px;
        border: 2px solid rgba(15,118,110,0.2);
        border-top-color: var(--color-primary);
        border-radius: 50%;
        animation: p-spin 0.6s linear infinite;
    }

    @keyframes p-spin {
        to { transform: rotate(360deg); }
    }
</style>

<!-- Toast Notification -->
<div class="participant-toast-container">
    <div id="scanToast" class="toast align-items-center border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="scanToastBody">Pesan notifikasi</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
<style>
    .participant-toast-container {
        position: fixed;
        top: 84px;
        right: 24px;
        z-index: 1090;
        padding: 0;
        max-width: 420px;
    }
    .participant-toast-container .toast {
        box-shadow: 0 10px 40px rgba(15, 23, 42, 0.15), 0 4px 12px rgba(15, 23, 42, 0.08);
        border-radius: 12px;
    }
    @media (max-width: 768px) {
        .participant-toast-container {
            top: 72px;
            left: 12px;
            right: 12px;
            max-width: none;
        }
    }
</style>

<div class="participant-page">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="page-title">Participant Input</h2>
            <p class="page-subtitle">Kelola peserta dan absensi meeting</p>
        </div>
        <button id="btnScan" class="btn-scan-barcode">
            <i class="fas fa-qrcode"></i>
            Scan Barcode
        </button>
    </div>

    <div class="row g-3">
        <!-- Left Column: Meeting Selection -->
        <div class="col-md-4">
            <div class="p-card h-100">
                <div class="p-card-header">
                    <h6 class="p-card-title">
                        <span class="title-icon teal"><i class="fas fa-calendar-check"></i></span>
                        Pilih Meeting
                    </h6>
                </div>
                <div class="p-card-body">
                    <label class="form-label-sm">Meeting Aktif</label>
                    <select id="meetingSelect" class="select-meeting"></select>
                    <button id="addParticipantBtn" class="btn-add-manual">
                        <i class="fas fa-plus" style="font-size:0.7rem"></i>
                        Tambah Manual
                    </button>
                </div>
            </div>
        </div>

        <!-- Right Column: Participant List -->
        <div class="col-md-8">
            <div class="p-card">
                <div class="p-card-header">
                    <h6 class="p-card-title">
                        <span class="title-icon blue"><i class="fas fa-users"></i></span>
                        Daftar Peserta
                    </h6>
                    <span class="badge-count" id="participantCount">0 Peserta</span>
                </div>
                <div class="p-table-wrap">
                    <table class="p-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Barcode ID</th>
                                <th>Status</th>
                                <th>Waktu Scan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="participantTable"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Peserta -->
<div class="modal fade participant-page" id="addParticipantModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-modal">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user-plus" style="color:#0F766E"></i>
                    Tambah Peserta Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="meeting_id">
                <div class="p-input-group">
                    <label class="p-input-label" for="nama">Nama Peserta</label>
                    <input type="text" id="nama" class="p-input" placeholder="Masukkan nama lengkap">
                </div>
                <div class="p-input-group">
                    <label class="p-input-label" for="barcode">Barcode ID <span style="font-weight:400;color:#64748B;font-size:0.75rem;">(opsional — otomatis jika kosong)</span></label>
                    <input type="text" id="barcode" class="p-input" placeholder="Kosongkan untuk auto-generate">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" data-bs-dismiss="modal">Batal</button>
                <button id="saveParticipant" class="btn-save">Simpan Peserta</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Scanner -->
<div class="modal fade participant-page" id="modalScan" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-modal">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-qrcode" style="color:#059669"></i>
                    Scan Barcode Kehadiran
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <!-- Processing indicator -->
                <div id="scanStatus" class="scan-status d-none">
                    <span class="spinner-teal"></span>
                    <span>Memproses...</span>
                </div>
                <!-- Scanner area -->
                <div class="scanner-area">
                    <div id="reader" style="width:100%;overflow:hidden;"></div>
                </div>
                <!-- Scan result feedback -->
                <div id="scanResult" class="scan-result d-none">
                    <div id="scanResultIcon"></div>
                    <p id="scanResultText" class="scan-result-text"></p>
                </div>
            </div>
            <div class="scanner-footer">
                <p class="info-text"><i class="fas fa-info-circle"></i> Arahkan kamera ke QR Code / Barcode peserta</p>
                <button id="btnRescan" class="btn-rescan d-none">
                    <i class="fas fa-redo"></i> Scan Lagi
                </button>
            </div>
            <div style="padding:1rem 1.25rem;border-top:1px solid #E2E8F0;">
                <p style="font-size:0.75rem;color:#64748B;margin:0 0 0.5rem;font-weight:600;">Atau masukkan Barcode ID secara manual:</p>
                <div style="display:flex;gap:0.5rem;">
                    <input type="text" id="manualBarcodeInput" class="p-input" placeholder="Ketik Barcode ID peserta" style="flex:1;padding:0.5rem 0.75rem;font-size:0.8125rem;">
                    <button id="btnManualAbsen" class="btn-save" style="padding:0.5rem 1rem;font-size:0.8125rem;white-space:nowrap;">
                        <i class="fas fa-check me-1"></i> Absen
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal QR Code -->
<div class="modal fade participant-page" id="modalQR" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content p-modal">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-qrcode" style="color:#0F766E"></i>
                    QR Code Peserta
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <p id="qrParticipantName" style="font-weight:700;font-size:1rem;color:#0F172A;margin-bottom:0.25rem;"></p>
                <p id="qrBarcodeLabel" style="font-size:0.75rem;color:#64748B;margin-bottom:1rem;font-family:monospace;"></p>
                <div id="qrCanvas" style="display:inline-block;padding:16px;background:#fff;border:2px solid #E2E8F0;border-radius:12px;"></div>
            </div>
            <div class="modal-footer justify-content-center" style="gap:0.5rem;">
                <button id="btnDownloadQR" class="btn-save" style="font-size:0.8125rem;padding:0.5rem 1.25rem;">
                    <i class="fas fa-download me-1"></i> Download
                </button>
                <button id="btnPrintQR" class="btn-cancel" style="font-size:0.8125rem;padding:0.5rem 1.25rem;">
                    <i class="fas fa-print me-1"></i> Cetak
                </button>
            </div>
        </div>
    </div>
</div>

<script>
{
    const baseUrl = typeof siteBaseUrl !== 'undefined' ? siteBaseUrl : '<?= base_url() ?>';
    let html5QrCode = null;
    let isScanning = false;
    let isStarting = false; // Guard untuk race condition

    function escapeHtml(text) {
        if (!text) return '';
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(text));
        return div.innerHTML;
    }

    // ===== AUDIO BEEP (Web Audio API) =====
    var _audioCtx = null;
    function getAudioContext() {
        if (!_audioCtx) {
            _audioCtx = new (window.AudioContext || window.webkitAudioContext)();
        }
        return _audioCtx;
    }

    function playBeep(type) {
        try {
            const ctx = getAudioContext();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.connect(gain);
            gain.connect(ctx.destination);

            if (type === 'success') {
                osc.frequency.value = 880;
                gain.gain.value = 0.3;
                osc.start();
                osc.stop(ctx.currentTime + 0.15);
            } else if (type === 'warning') {
                osc.frequency.value = 440;
                gain.gain.value = 0.2;
                osc.start();
                osc.stop(ctx.currentTime + 0.3);
            } else {
                osc.frequency.value = 220;
                gain.gain.value = 0.2;
                osc.start();
                osc.stop(ctx.currentTime + 0.4);
            }

            // Vibrate jika tersedia
            if (navigator.vibrate) {
                navigator.vibrate(type === 'success' ? 100 : type === 'warning' ? [100, 50, 100] : [200, 100, 200]);
            }
        } catch (e) {
            // Audio tidak tersedia, skip
        }
    }

    // ===== TOAST NOTIFICATION =====
    function showToast(message, type) {
        type = type || 'success';
        const toast = document.getElementById('scanToast');
        const toastBody = document.getElementById('scanToastBody');

        toast.className = 'toast align-items-center border-0';

        const config = {
            success: { bg: 'text-bg-success', icon: 'fa-check-circle' },
            warning: { bg: 'text-bg-warning', icon: 'fa-exclamation-triangle' },
            error:   { bg: 'text-bg-danger text-white', icon: 'fa-times-circle' },
            info:    { bg: 'text-bg-info text-white', icon: 'fa-info-circle' }
        };

        const c = config[type] || config.info;
        toast.classList.add.apply(toast.classList, c.bg.split(' '));
        toastBody.innerHTML = '<i class="fas ' + c.icon + ' me-2"></i>' + message;

        const bsToast = new bootstrap.Toast(toast, { delay: 4000 });
        bsToast.show();
    }

    // ===== LOAD MEETINGS =====
    function loadMeetings() {
        $('#meetingSelect').html('<option>Memuat data...</option>');

        $.get(baseUrl + 'v1/meetings')
            .done(function(data) {
                $('#meetingSelect').empty();

                if (Array.isArray(data) && data.length === 0) {
                    $('#meetingSelect').append('<option value="">Tidak ada meeting aktif</option>');
                    $('#addParticipantBtn').prop('disabled', true).css('opacity', '0.5');
                    $('#btnScan').prop('disabled', true).css('opacity', '0.5');
                    return;
                }

                if (!Array.isArray(data)) {
                    $('#meetingSelect').html('<option value="">Error memuat data</option>');
                    return;
                }

                $.each(data, function(i, meeting) {
                    $('#meetingSelect').append($('<option>').val(meeting.id).text(meeting.nama_meeting));
                });

                $('#addParticipantBtn').prop('disabled', false).css('opacity', '1');
                $('#btnScan').prop('disabled', false).css('opacity', '1');
                loadParticipants();
            })
            .fail(function(jqXHR) {
                if (jqXHR.status === 401) {
                    window.location.href = baseUrl + 'auth/login';
                    return;
                }
                $('#meetingSelect').html('<option value="">Gagal memuat data</option>');
            });
    }

    // ===== LOAD PARTICIPANTS =====
    function loadParticipants() {
        const meetingId = $('#meetingSelect').val();
        if (!meetingId) return;

        $.get(baseUrl + 'v1/participants/' + meetingId, function(data) {
            $('#participantTable').empty();
            $('#participantCount').text(data.length + ' Peserta');

            if (data.length === 0) {
                $('#participantTable').append(
                    '<tr><td colspan="6">' +
                    '<div class="empty-state">' +
                    '<div class="empty-icon"><i class="fas fa-users"></i></div>' +
                    '<p>Belum ada peserta terdaftar</p>' +
                    '</div></td></tr>'
                );
                return;
            }

            $.each(data, function(i, p) {
                const isHadir = p.status === 'hadir';
                const badge = isHadir
                    ? '<span style="display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:100px;font-size:0.6875rem;font-weight:600;background:#ECFDF5;color:#059669;"><i class="fas fa-check-circle"></i> Hadir</span>'
                    : '<span style="display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:100px;font-size:0.6875rem;font-weight:600;background:#F1F5F9;color:#64748B;"><i class="fas fa-clock"></i> Belum Hadir</span>';

                const scanTime = p.scanned_at
                    ? '<span class="td-time">' + new Date(p.scanned_at).toLocaleString('id-ID', {hour:'2-digit', minute:'2-digit', day:'2-digit', month:'short'}) + '</span>'
                    : '<span class="td-time">-</span>';

                // Escape data untuk atribut HTML
                const safeName = $('<span>').text(p.name).html();
                const safeBarcode = $('<span>').text(p.barcode_id).html();

                $('#participantTable').append(
                    '<tr>' +
                    '<td class="td-num">' + (i + 1) + '</td>' +
                    '<td class="td-name">' + safeName + '</td>' +
                    '<td><span class="td-barcode">' + safeBarcode + '</span></td>' +
                    '<td>' + badge + '</td>' +
                    '<td>' + scanTime + '</td>' +
                    '<td><button class="btn-qr-show" data-name="' + safeName + '" data-barcode="' + safeBarcode + '" title="Lihat QR Code"><i class="fas fa-qrcode"></i></button></td>' +
                    '</tr>'
                );
            });
        }).fail(function(jqXHR) {
            if (jqXHR.status === 401) {
                window.location.href = baseUrl + 'auth/login';
            }
        });
    }

    // ===== QR CODE GENERATION =====
    function showQRCode(name, barcodeId) {
        $('#qrParticipantName').text(name);
        $('#qrBarcodeLabel').text(barcodeId);
        $('#qrCanvas').empty();

        if (typeof QRCode !== 'undefined') {
            new QRCode(document.getElementById('qrCanvas'), {
                text: String(barcodeId),
                width: 512,
                height: 512,
                colorDark: '#0F172A',
                colorLight: '#FFFFFF',
                correctLevel: QRCode.CorrectLevel.H
            });
            // Scale down display, keep high-res for download
            $('#qrCanvas canvas, #qrCanvas img').css({ width: '200px', height: '200px' });
        } else {
            $('#qrCanvas').html('<p style="color:#DC2626;font-size:0.8rem;">Library QR Code belum dimuat. Coba refresh halaman.</p>');
        }

        $('#modalQR').modal('show');
    }

    // Build download image with quiet zone (white padding required by QR spec)
    function getQrDownloadUrl() {
        var img = $('#qrCanvas img')[0];
        var canvas = $('#qrCanvas canvas')[0];
        var src = (img && img.src) ? img.src : (canvas ? canvas.toDataURL('image/png') : null);
        if (!src) return null;

        var padding = 40;
        var tmpImg = new Image();
        tmpImg.src = src;
        var dlCanvas = document.createElement('canvas');
        dlCanvas.width = tmpImg.naturalWidth + padding * 2;
        dlCanvas.height = tmpImg.naturalHeight + padding * 2;
        var ctx = dlCanvas.getContext('2d');
        ctx.fillStyle = '#FFFFFF';
        ctx.fillRect(0, 0, dlCanvas.width, dlCanvas.height);
        ctx.drawImage(tmpImg, padding, padding);
        return dlCanvas.toDataURL('image/png');
    }

    // Download QR sebagai PNG dengan quiet zone
    $('#btnDownloadQR').off('click').click(function() {
        var dataUrl = getQrDownloadUrl();
        if (!dataUrl) return;
        var name = $('#qrParticipantName').text();
        var link = document.createElement('a');
        link.download = 'QR_' + name.replace(/\s+/g, '_') + '.png';
        link.href = dataUrl;
        link.click();
    });

    // Cetak QR
    $('#btnPrintQR').off('click').click(function() {
        var dataUrl = getQrDownloadUrl();
        if (!dataUrl) return;
        var name = $('#qrParticipantName').text();
        var barcode = $('#qrBarcodeLabel').text();
        var win = window.open('', '_blank');
        win.document.write(
            '<!DOCTYPE html><html><head><title>QR - ' + escapeHtml(name) + '</title>' +
            '<style>body{font-family:Inter,sans-serif;text-align:center;padding:40px;}' +
            '.qr-card{display:inline-block;border:2px solid #E2E8F0;border-radius:16px;padding:32px;background:#fff;}' +
            'h2{margin:0 0 4px;font-size:1.25rem;color:#0F172A;}' +
            'p{margin:0 0 20px;font-size:0.875rem;color:#64748B;font-family:monospace;}' +
            'img{border-radius:8px;}' +
            '@media print{body{padding:20px;}}</style></head>' +
            '<body><div class="qr-card">' +
            '<h2>' + escapeHtml(name) + '</h2>' +
            '<p>' + escapeHtml(barcode) + '</p>' +
            '<img src="' + dataUrl + '" width="200" height="200">' +
            '</div>' +
            '<script>setTimeout(function(){window.print();},300);<\/script>' +
            '</body></html>'
        );
        win.document.close();
    });

    // Event: klik tombol QR di tabel
    $(document).off('click', '.btn-qr-show').on('click', '.btn-qr-show', function() {
        const name = $(this).data('name');
        const barcode = $(this).data('barcode');
        showQRCode(name, barcode);
    });

    // ===== EVENT HANDLERS =====
    $('#meetingSelect').off('change').on('change', loadParticipants);

    $('#addParticipantBtn').off('click').click(function() {
        const mId = $('#meetingSelect').val();
        if (!mId) {
            showToast('Silakan buat atau pilih meeting terlebih dahulu!', 'warning');
            return;
        }
        $('#meeting_id').val(mId);
        $('#nama').val('');
        $('#barcode').val('');
        $('#addParticipantModal').modal('show');
    });

    $('#saveParticipant').off('click').click(function() {
        const nameVal = $('#nama').val().trim();
        const barcodeVal = $('#barcode').val().trim();

        if (!nameVal) {
            showToast('Nama peserta harus diisi!', 'warning');
            return;
        }

        const btn = $(this);
        btn.prop('disabled', true).html('<span class="spinner-sm d-inline-block me-2"></span>Menyimpan...');

        $.post(baseUrl + 'v1/participants', {
            meeting_id: $('#meeting_id').val(),
            name: nameVal,
            barcode_id: barcodeVal
        }, function(response) {
            if (response.status === 'success') {
                $('#addParticipantModal').modal('hide');
                $('#nama').val('');
                $('#barcode').val('');
                showToast('Peserta berhasil ditambahkan!', 'success');
                loadParticipants();
            } else {
                showToast(response.message || 'Gagal menambahkan peserta', 'error');
            }
        }, 'json')
        .fail(function() {
            showToast('Terjadi kesalahan server', 'error');
        })
        .always(function() {
            btn.prop('disabled', false).html('Simpan Peserta');
        });
    });

    // ===== SCANNER LOGIC =====
    $('#btnScan').off('click').click(function() {
        const mId = $('#meetingSelect').val();
        if (!mId) {
            showToast('Pilih meeting terlebih dahulu sebelum scan!', 'warning');
            return;
        }
        $('#scanStatus').addClass('d-none');
        $('#scanResult').addClass('d-none');
        $('#btnRescan').addClass('d-none');
        $('#manualBarcodeInput').val('');
        $('#reader').show();
        $('#modalScan').modal('show');
    });

    $('#modalScan').on('shown.bs.modal', function() {
        startScanner();
    });

    $('#modalScan').on('hidden.bs.modal', function() {
        stopScanner();
    });

    $('#btnRescan').off('click').click(function() {
        $('#scanResult').addClass('d-none');
        $('#btnRescan').addClass('d-none');
        $('#reader').show();
        startScanner();
    });

    function getResponsiveQrBox() {
        // Responsif qrbox berdasarkan viewport
        var modalWidth = Math.min(window.innerWidth - 60, 460);
        var size = Math.min(Math.floor(modalWidth * 0.6), 250);
        size = Math.max(size, 150); // minimum 150px
        return { width: size, height: size };
    }

    function startScanner() {
        if (isScanning || isStarting) return;
        isStarting = true;

        try {
            var qrFormats = (typeof Html5QrcodeSupportedFormats !== 'undefined')
                ? [Html5QrcodeSupportedFormats.QR_CODE]
                : undefined;

            html5QrCode = new Html5Qrcode("reader", {
                formatsToSupport: qrFormats,
                experimentalFeatures: { useBarCodeDetectorIfSupported: true }
            });
        } catch (e) {
            isStarting = false;
            showScanResult('error', 'Gagal memuat scanner: ' + e.message);
            return;
        }

        var config = {
            fps: 15,
            qrbox: getResponsiveQrBox()
        };

        html5QrCode.start(
            { facingMode: "environment" },
            config,
            function onScanSuccess(decodedText) {
                try {
                    isScanning = false;
                    isStarting = false;
                    html5QrCode.stop().then(function() {
                        $('#reader').hide();
                        showScanProcessing();
                        playBeep('success');
                        submitAbsen(decodedText);
                    }).catch(function() {
                        showScanProcessing();
                        submitAbsen(decodedText);
                    });
                } catch (e) {
                    showScanProcessing();
                    submitAbsen(decodedText);
                }
            },
            function onScanFailure(error) {
                // Ignore - normal saat belum ada barcode terdeteksi
            }
        ).then(function() {
            isScanning = true;
            isStarting = false;
        }).catch(function(err) {
            isStarting = false;
            var msg = 'Gagal mengakses kamera.';
            if (err && err.toString().includes('NotAllowedError')) {
                msg = 'Izin kamera ditolak. Buka pengaturan browser dan izinkan akses kamera.';
            } else if (err && err.toString().includes('NotFoundError')) {
                msg = 'Kamera tidak ditemukan pada perangkat ini.';
            } else if (err && err.toString().includes('NotReadableError')) {
                msg = 'Kamera sedang digunakan aplikasi lain.';
            } else if (location.protocol !== 'https:' && location.hostname !== 'localhost') {
                msg = 'Kamera membutuhkan koneksi HTTPS yang aman.';
            }
            showScanResult('error', msg);
        });
    }

    function stopScanner() {
        isStarting = false;
        if (html5QrCode) {
            if (isScanning) {
                html5QrCode.stop().then(function() {
                    html5QrCode.clear();
                    isScanning = false;
                }).catch(function() {
                    isScanning = false;
                });
            } else {
                try { html5QrCode.clear(); } catch(e) {}
            }
            html5QrCode = null;
        }
    }

    // SPA cleanup function — dipanggil oleh main layout saat navigasi
    window._participantCleanup = function() {
        stopScanner();
        // Tutup modal yang masih terbuka
        try {
            var modalScan = bootstrap.Modal.getInstance(document.getElementById('modalScan'));
            if (modalScan) modalScan.hide();
            var modalAdd = bootstrap.Modal.getInstance(document.getElementById('addParticipantModal'));
            if (modalAdd) modalAdd.hide();
            var modalQR = bootstrap.Modal.getInstance(document.getElementById('modalQR'));
            if (modalQR) modalQR.hide();
        } catch(e) {}
    };

    function showScanProcessing() {
        $('#scanStatus').removeClass('d-none');
    }

    function showScanResult(type, message) {
        $('#scanStatus').addClass('d-none');
        $('#scanResult').removeClass('d-none');
        $('#btnRescan').removeClass('d-none');

        const icons = {
            success: '<div class="scan-result-icon success"><i class="fas fa-check-circle"></i></div>',
            warning: '<div class="scan-result-icon warning"><i class="fas fa-exclamation-circle"></i></div>',
            error:   '<div class="scan-result-icon error"><i class="fas fa-times-circle"></i></div>'
        };

        $('#scanResultIcon').html(icons[type] || icons.error);
        $('#scanResultText').text(message);
    }

    function submitAbsen(barcode) {
        const selectedMeetingId = $('#meetingSelect').val();
        if (!selectedMeetingId) {
            showScanResult('error', 'Pilih meeting terlebih dahulu!');
            return;
        }

        $.post(baseUrl + 'participant/absen', {
            barcode: barcode,
            meeting_id: selectedMeetingId
        }, function(response) {
            if (response.success) {
                if (response.already_present) {
                    showScanResult('warning', response.message);
                    showToast(response.message, 'warning');
                    playBeep('warning');
                } else {
                    showScanResult('success', response.message);
                    showToast(response.message, 'success');
                }
                loadParticipants();
            } else {
                showScanResult('error', response.message || 'Barcode tidak ditemukan!');
                showToast(response.message || 'Barcode tidak ditemukan!', 'error');
                playBeep('error');
            }
        }, 'json')
        .fail(function(jqXHR) {
            if (jqXHR.status === 401) {
                window.location.href = baseUrl + 'auth/login';
                return;
            }
            showScanResult('error', 'Terjadi kesalahan server');
            showToast('Terjadi kesalahan server saat absen', 'error');
            playBeep('error');
        });
    }

    // ===== MANUAL BARCODE INPUT =====
    $('#btnManualAbsen').off('click').click(function() {
        var barcode = $('#manualBarcodeInput').val().trim();
        if (!barcode) {
            showToast('Masukkan Barcode ID terlebih dahulu!', 'warning');
            return;
        }
        showScanProcessing();
        submitAbsen(barcode);
    });

    $('#manualBarcodeInput').off('keypress').on('keypress', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            $('#btnManualAbsen').click();
        }
    });

    // ===== INITIALIZE =====
    loadMeetings();
}
</script>

<style>
    /* Tombol QR di tabel */
    .participant-page .btn-qr-show {
        background: rgba(15,118,110,0.08);
        color: var(--color-primary);
        border: 1px solid rgba(15,118,110,0.15);
        border-radius: var(--radius-sm);
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all var(--transition-fast);
    }
    .participant-page .btn-qr-show:hover {
        background: rgba(15,118,110,0.15);
        border-color: rgba(15,118,110,0.3);
        transform: translateY(-1px);
    }
</style>
