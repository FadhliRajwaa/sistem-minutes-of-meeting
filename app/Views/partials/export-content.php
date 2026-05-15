<style>
    /* ===== EXPORT PAGE - Premium Design System ===== */
    .export-page {
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
    }

    .export-page .page-header {
        margin-bottom: 1.75rem;
    }

    .export-page .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--color-text);
        margin: 0;
        letter-spacing: -0.025em;
        line-height: 1.2;
    }

    .export-page .page-subtitle {
        font-size: 0.8125rem;
        color: var(--color-muted);
        margin-top: 2px;
        font-weight: 400;
    }

    /* Card */
    .export-page .e-card {
        background: #fff;
        border: 1px solid var(--color-border);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        transition: box-shadow var(--transition-base);
    }

    .export-page .e-card:hover {
        box-shadow: var(--shadow-md);
    }

    .export-page .e-card-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--color-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .export-page .e-card-title {
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--color-text);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .export-page .e-card-title .title-icon {
        width: 28px;
        height: 28px;
        border-radius: var(--radius-sm);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        background: rgba(15,118,110,0.08);
        color: var(--color-primary);
        flex-shrink: 0;
    }

    /* Search */
    .export-page .search-wrap {
        position: relative;
        width: 100%;
        max-width: 280px;
    }

    .export-page .search-wrap .search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94A3B8;
        font-size: 0.75rem;
        pointer-events: none;
    }

    .export-page .search-input {
        width: 100%;
        padding: 0.5rem 0.75rem 0.5rem 2.125rem;
        border: 1px solid var(--color-border);
        border-radius: var(--radius-md);
        font-size: 0.8125rem;
        color: var(--color-text);
        background: var(--color-surface);
        transition: all var(--transition-fast);
    }

    .export-page .search-input:focus {
        outline: none;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(15,118,110,0.1);
        background: #fff;
    }

    .export-page .search-input::placeholder {
        color: #94A3B8;
    }

    /* Table */
    .export-page .e-table {
        width: 100%;
        border-collapse: collapse;
    }

    .export-page .e-table thead th {
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

    .export-page .e-table thead th:first-child { padding-left: 1.25rem; width: 48px; }
    .export-page .e-table thead th:last-child { padding-right: 1.25rem; }

    .export-page .e-table tbody td {
        padding: 0.75rem 1rem;
        font-size: 0.8125rem;
        color: var(--color-text);
        border-bottom: 1px solid var(--color-border);
        vertical-align: middle;
    }

    .export-page .e-table tbody td:first-child { padding-left: 1.25rem; }
    .export-page .e-table tbody td:last-child { padding-right: 1.25rem; }

    .export-page .e-table tbody tr {
        transition: background var(--transition-fast);
        cursor: pointer;
    }

    .export-page .e-table tbody tr:hover {
        background: var(--color-surface);
    }

    .export-page .e-table tbody tr:last-child td {
        border-bottom: none;
    }

    .export-page .e-table tbody tr.selected-row {
        background: rgba(15,118,110,0.04);
    }

    .export-page .td-topic {
        font-weight: 600;
        color: var(--color-text);
    }

    .export-page .td-notulis {
        color: var(--color-muted);
    }

    .export-page .td-date {
        font-family: 'SF Mono', 'Fira Code', 'Consolas', monospace;
        font-size: 0.75rem;
        color: var(--color-muted);
    }

    /* Custom Radio */
    .export-page .e-radio {
        width: 16px;
        height: 16px;
        border: 2px solid var(--color-border);
        border-radius: 50%;
        appearance: none;
        -webkit-appearance: none;
        cursor: pointer;
        transition: all var(--transition-fast);
        position: relative;
    }

    .export-page .e-radio:checked {
        border-color: var(--color-primary);
        background: var(--color-primary);
    }

    .export-page .e-radio:checked::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #fff;
    }

    .export-page .e-radio:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(15,118,110,0.15);
    }

    /* Empty State */
    .export-page .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
        color: var(--color-muted);
    }

    .export-page .empty-state .empty-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: var(--color-surface);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.75rem;
        font-size: 1.125rem;
    }

    .export-page .empty-state p {
        font-size: 0.8125rem;
        margin: 0;
    }

    /* Action Footer */
    .export-page .action-footer {
        padding: 0.875rem 1.25rem;
        border-top: 1px solid var(--color-border);
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.5rem;
        background: #fff;
        flex-wrap: wrap;
    }

    .export-page .btn-action {
        padding: 0.5rem 1rem;
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 0.8125rem;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        transition: all var(--transition-base);
        border: none;
        cursor: pointer;
    }

    .export-page .btn-action:disabled {
        opacity: 0.4;
        cursor: not-allowed;
        transform: none !important;
    }

    .export-page .btn-preview {
        background: var(--color-surface);
        color: var(--color-text);
        border: 1px solid var(--color-border);
    }

    .export-page .btn-preview:not(:disabled):hover {
        background: #F1F5F9;
        border-color: #CBD5E1;
    }

    .export-page .btn-delete {
        background: rgba(220,38,38,0.06);
        color: var(--color-danger);
        border: 1px solid rgba(220,38,38,0.15);
    }

    .export-page .btn-delete:not(:disabled):hover {
        background: rgba(220,38,38,0.1);
        border-color: rgba(220,38,38,0.25);
    }

    .export-page .btn-download {
        background: var(--color-primary);
        color: #fff;
    }

    .export-page .btn-download:not(:disabled):hover {
        background: #115E59;
        box-shadow: 0 4px 12px rgba(15,118,110,0.25);
        transform: translateY(-1px);
    }

    .export-page .btn-download:active {
        transform: translateY(0);
    }

    /* Modal */
    .export-page .modal-content.e-modal {
        border: none;
        border-radius: var(--radius-xl);
        box-shadow: 0 25px 50px -12px rgba(15,23,42,0.15);
        overflow: hidden;
    }

    /* Delete Modal */
    .export-page .delete-modal-body {
        padding: 2rem 1.5rem;
        text-align: center;
    }

    .export-page .delete-icon-wrap {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: rgba(220,38,38,0.08);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        color: var(--color-danger);
        font-size: 1.25rem;
    }

    .export-page .delete-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 0.375rem;
    }

    .export-page .delete-desc {
        font-size: 0.8125rem;
        color: var(--color-muted);
        margin-bottom: 0.25rem;
    }

    .export-page .delete-warning {
        font-size: 0.75rem;
        color: var(--color-danger);
        margin-bottom: 1.5rem;
    }

    .export-page .delete-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .export-page .btn-cancel-del {
        padding: 0.5rem 1.25rem;
        background: var(--color-surface);
        color: var(--color-muted);
        border: 1px solid var(--color-border);
        border-radius: var(--radius-md);
        font-weight: 500;
        font-size: 0.8125rem;
        transition: all var(--transition-fast);
    }

    .export-page .btn-cancel-del:hover {
        background: #F1F5F9;
        color: var(--color-text);
    }

    .export-page .btn-confirm-del {
        padding: 0.5rem 1.25rem;
        background: var(--color-danger);
        color: #fff;
        border: none;
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 0.8125rem;
        transition: all var(--transition-base);
    }

    .export-page .btn-confirm-del:hover {
        background: #B91C1C;
    }

    /* Preview Modal */
    .export-page .preview-modal .modal-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--color-border);
    }

    .export-page .preview-modal .modal-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--color-text);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .export-page .preview-modal .modal-body {
        padding: 0;
        background: var(--color-surface);
        flex: 1;
        overflow: hidden;
        position: relative;
    }

    .export-page .preview-loader {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        background: var(--color-surface);
        z-index: 2;
    }

    .export-page .preview-spinner {
        width: 32px;
        height: 32px;
        border: 3px solid var(--color-border);
        border-top-color: var(--color-primary);
        border-radius: 50%;
        animation: e-spin 0.7s linear infinite;
    }

    @keyframes e-spin {
        to { transform: rotate(360deg); }
    }

    .export-page .preview-loader p {
        font-size: 0.8125rem;
        color: var(--color-muted);
        margin: 0;
    }

    .export-page .preview-modal .modal-footer {
        padding: 0.875rem 1.5rem;
        border-top: 1px solid var(--color-border);
    }

    .export-page .btn-close-preview {
        padding: 0.5rem 1rem;
        background: var(--color-surface);
        color: var(--color-muted);
        border: 1px solid var(--color-border);
        border-radius: var(--radius-md);
        font-weight: 500;
        font-size: 0.8125rem;
        transition: all var(--transition-fast);
        text-decoration: none;
    }

    .export-page .btn-close-preview:hover {
        background: #F1F5F9;
        color: var(--color-text);
    }

    .export-page .btn-dl-pdf {
        padding: 0.5rem 1.25rem;
        background: var(--color-primary);
        color: #fff;
        border: none;
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 0.8125rem;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        transition: all var(--transition-base);
        text-decoration: none;
    }

    .export-page .btn-dl-pdf:hover {
        background: #115E59;
        color: #fff;
    }

    /* Responsive - Mobile stacked card layout */
    @media (max-width: 767.98px) {
        .export-page .e-card-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .export-page .search-wrap {
            max-width: 100%;
        }

        .export-page .e-table-wrap.mobile-stack table,
        .export-page .e-table-wrap.mobile-stack thead,
        .export-page .e-table-wrap.mobile-stack tbody,
        .export-page .e-table-wrap.mobile-stack th,
        .export-page .e-table-wrap.mobile-stack td,
        .export-page .e-table-wrap.mobile-stack tr {
            display: block;
        }

        .export-page .e-table-wrap.mobile-stack thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        .export-page .e-table-wrap.mobile-stack tbody tr {
            border: 1px solid var(--color-border);
            border-radius: var(--radius-md);
            margin-bottom: 0.625rem;
            background: #fff;
            padding: 0.75rem 1rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.25rem;
        }

        .export-page .e-table-wrap.mobile-stack tbody tr:hover {
            box-shadow: var(--shadow-sm);
        }

        .export-page .e-table-wrap.mobile-stack tbody td {
            border: none;
            padding: 0.125rem 0;
        }

        .export-page .e-table-wrap.mobile-stack tbody td:first-child {
            padding-left: 0;
            order: -1;
            margin-right: 0.75rem;
        }

        .export-page .e-table-wrap.mobile-stack tbody td:nth-child(2) {
            flex: 1;
            min-width: 0;
        }

        .export-page .e-table-wrap.mobile-stack tbody td:nth-child(3),
        .export-page .e-table-wrap.mobile-stack tbody td:nth-child(4) {
            width: 100%;
            padding-left: 1.75rem;
        }

        .export-page .e-table-wrap.mobile-stack tbody td:nth-child(3)::before {
            content: "Notulis: ";
            font-weight: 600;
            color: var(--color-muted);
            font-size: 0.6875rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .export-page .e-table-wrap.mobile-stack tbody td:nth-child(4)::before {
            content: "Tanggal: ";
            font-weight: 600;
            color: var(--color-muted);
            font-size: 0.6875rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .export-page .action-footer {
            flex-direction: column;
        }

        .export-page .action-footer .btn-action {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="export-page">
    <!-- Page Header -->
    <div class="page-header">
        <h2 class="page-title">Export to PDF</h2>
        <p class="page-subtitle">Arsipkan dan unduh notulensi dalam format PDF</p>
    </div>

    <!-- Main Card -->
    <div class="e-card">
        <div class="e-card-header">
            <h6 class="e-card-title">
                <span class="title-icon"><i class="fas fa-archive"></i></span>
                Arsip Notulensi
            </h6>
            <div class="search-wrap">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="search-discussion" class="search-input" placeholder="Cari topik, notulis...">
            </div>
        </div>

        <form action="<?= base_url('export/pdf') ?>" method="post" target="_blank" id="exportForm">
            <?= csrf_field() ?>
            <div class="e-table-wrap mobile-stack">
                <table class="e-table">
                    <thead>
                        <tr>
                            <th>Pilih</th>
                            <th>Topik</th>
                            <th>Notulis</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody id="discussion-table-body">
                        <?php if (empty($discussions)): ?>
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <div class="empty-icon"><i class="fas fa-folder-open"></i></div>
                                        <p>Belum ada data diskusi</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($discussions as $item): ?>
                                <tr>
                                    <td>
                                        <input class="e-radio" type="radio" name="discussion_id" value="<?= $item['id'] ?>" required>
                                    </td>
                                    <td class="td-topic"><?= esc($item['topik']) ?></td>
                                    <td class="td-notulis"><?= esc($item['nama_notulis']) ?></td>
                                    <td class="td-date"><?= esc($item['tanggal']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="action-footer">
                <button id="viewBtn" type="button" class="btn-action btn-preview" disabled>
                    <i class="fas fa-eye"></i> Preview
                </button>
                <button id="deleteBtn" type="button" class="btn-action btn-delete" disabled>
                    <i class="fas fa-trash-alt"></i> Hapus
                </button>
                <button id="exportBtn" type="submit" class="btn-action btn-download" disabled>
                    <i class="fas fa-download"></i> Download PDF
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade export-page" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content e-modal">
            <div class="delete-modal-body">
                <div class="delete-icon-wrap">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <h5 class="delete-title">Hapus Arsip?</h5>
                <p class="delete-desc">Data diskusi ini akan dihapus secara permanen.</p>
                <p class="delete-warning">Tindakan ini tidak dapat dibatalkan.</p>
                <small id="deleteError" class="text-danger d-none" style="display:block;margin-bottom:1rem;font-size:0.75rem;"></small>
                <div class="delete-actions">
                    <button class="btn-cancel-del" data-bs-dismiss="modal">Batal</button>
                    <button id="confirmDeleteBtn" class="btn-confirm-del">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview PDF Modal -->
<div class="modal fade export-page" id="previewPdfModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content e-modal preview-modal" style="height:90vh;">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-file-pdf" style="color:#0F766E"></i>
                    Preview Notulensi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="pdfLoader" class="preview-loader">
                    <div class="preview-spinner"></div>
                    <p>Memuat dokumen...</p>
                </div>
                <iframe id="previewFrame" src="" style="width:100%;height:100%;border:none;display:none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-close-preview" data-bs-dismiss="modal">Tutup</button>
                <a id="downloadPdfBtn" href="#" class="btn-dl-pdf">
                    <i class="fas fa-download"></i> Download PDF
                </a>
            </div>
        </div>
    </div>
</div>

<script>
{
    const exportBtn = document.getElementById("exportBtn");
    function escapeHtml(text) {
        if (!text) return '';
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(text));
        return div.innerHTML;
    }
    const viewBtn = document.getElementById("viewBtn");
    const deleteBtn = document.getElementById("deleteBtn");
    let selectedID = null;

    function refreshRadioEvents() {
        document.querySelectorAll('input[name="discussion_id"]').forEach(function(radio) {
            radio.addEventListener("change", function() {
                selectedID = radio.value;
                exportBtn.disabled = false;
                viewBtn.disabled = false;
                deleteBtn.disabled = false;

                // Highlight selected row
                document.querySelectorAll('.e-table tbody tr').forEach(function(r) {
                    r.classList.remove('selected-row');
                });
                radio.closest('tr').classList.add('selected-row');
            });
        });

        // Click on row to select radio
        document.querySelectorAll('.e-table tbody tr').forEach(function(row) {
            row.addEventListener('click', function(e) {
                if (e.target.tagName === 'INPUT') return;
                const radio = row.querySelector('input[type="radio"]');
                if (radio) {
                    radio.checked = true;
                    radio.dispatchEvent(new Event('change'));
                }
            });
        });
    }

    refreshRadioEvents();

    // ===== SEARCH WITH DEBOUNCE (300ms) =====
    const searchInput = document.getElementById("search-discussion");
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener("keyup", function() {
            clearTimeout(searchTimeout);
            const keyword = this.value;
            const baseUrl = typeof siteBaseUrl !== 'undefined' ? siteBaseUrl : '<?= base_url() ?>';

            searchTimeout = setTimeout(function() {
                fetch(baseUrl + 'discussion/search?keyword=' + encodeURIComponent(keyword))
                    .then(function(res) { return res.json(); })
                    .then(function(data) {
                        let rows = "";
                        if (data.length === 0) {
                            rows = '<tr><td colspan="4"><div class="empty-state"><div class="empty-icon"><i class="fas fa-search"></i></div><p>Tidak ada data ditemukan</p></div></td></tr>';
                        } else {
                            data.forEach(function(item) {
                                rows += '<tr>' +
                                    '<td><input class="e-radio" type="radio" name="discussion_id" value="' + escapeHtml(String(item.id)) + '" required></td>' +
                                    '<td class="td-topic">' + escapeHtml(item.topik) + '</td>' +
                                    '<td class="td-notulis">' + escapeHtml(item.notulis || item.nama_notulis) + '</td>' +
                                    '<td class="td-date">' + escapeHtml(item.tanggal) + '</td>' +
                                    '</tr>';
                            });
                        }
                        document.getElementById("discussion-table-body").innerHTML = rows;

                        // Reset selection state
                        selectedID = null;
                        exportBtn.disabled = true;
                        viewBtn.disabled = true;
                        deleteBtn.disabled = true;

                        refreshRadioEvents();
                    })
                    .catch(function() {
                        alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
                    });
            }, 300);
        });
    }

    // ===== PREVIEW =====
    if (viewBtn) {
        viewBtn.addEventListener("click", function() {
            if (!selectedID) return;
            const baseUrl = typeof siteBaseUrl !== 'undefined' ? siteBaseUrl : '<?= base_url() ?>';
            const previewUrl = baseUrl + "export/pdf/" + selectedID + "?preview=true";
            const downloadUrl = baseUrl + "export/pdf/" + selectedID;

            const previewModal = new bootstrap.Modal(document.getElementById('previewPdfModal'));
            const loader = document.getElementById('pdfLoader');
            const iframe = document.getElementById('previewFrame');
            const downloadPdfBtn = document.getElementById('downloadPdfBtn');

            loader.style.display = 'flex';
            iframe.style.display = 'none';
            iframe.src = '';

            previewModal.show();
            downloadPdfBtn.href = downloadUrl;

            iframe.src = previewUrl;
            iframe.onload = function() {
                loader.style.display = 'none';
                iframe.style.display = 'block';
            };
        });
    }

    // ===== DELETE =====
    if (deleteBtn) {
        deleteBtn.addEventListener("click", function() {
            document.getElementById("deleteError").classList.add("d-none");
            var modal = new bootstrap.Modal(document.getElementById("deleteModal"));
            modal.show();
        });
    }

    var confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener("click", function() {
            const baseUrl = typeof siteBaseUrl !== 'undefined' ? siteBaseUrl : '<?= base_url() ?>';

            fetch(baseUrl + "discussion/delete", {
                method: "POST",
                headers: getCsrfHeaders({ "Content-Type": "application/x-www-form-urlencoded" }),
                body: appendCsrf("id=" + encodeURIComponent(selectedID))
            })
            .then(function(res) { return res.json(); })
            .then(function(result) {
                if (!result.success) {
                    document.getElementById("deleteError").textContent = "Gagal menghapus data!";
                    document.getElementById("deleteError").classList.remove("d-none");
                } else {
                    var modalEl = document.getElementById("deleteModal");
                    var modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) modal.hide();

                    if (typeof loadContent === 'function') {
                        loadContent('export');
                    } else {
                        location.reload();
                    }
                }
            })
            .catch(function() {
                alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
            });
        });
    }
}
</script>
