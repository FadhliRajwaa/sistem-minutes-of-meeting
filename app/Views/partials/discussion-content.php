<style>
    /* ── Discussion Page Scoped Styles ── */
    .disc-header {
        margin-bottom: 1.75rem;
    }
    .disc-header h2 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #0F172A;
        margin: 0;
        letter-spacing: -0.025em;
    }
    .disc-header p {
        font-size: 0.88rem;
        color: #64748B;
        margin: 4px 0 0;
        line-height: 1.5;
    }

    /* Form Card */
    .disc-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        overflow: hidden;
        max-width: 860px;
        margin: 0 auto;
    }
    .disc-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .disc-card-header .header-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(15, 118, 110, 0.08);
        color: #0F766E;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
    }
    .disc-card-header h6 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.95rem;
        font-weight: 600;
        color: #0F172A;
        margin: 0;
    }
    .disc-card-body {
        padding: 24px;
    }

    /* Form Elements */
    .disc-form-label {
        font-size: 0.82rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 6px;
        display: block;
    }
    .disc-form-control {
        width: 100%;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.88rem;
        color: #0F172A;
        background: #fff;
        transition: border-color 0.2s cubic-bezier(0.22, 1, 0.36, 1),
                    box-shadow 0.2s cubic-bezier(0.22, 1, 0.36, 1);
        font-family: inherit;
        outline: none;
        -webkit-appearance: none;
        appearance: none;
    }
    .disc-form-control:focus {
        border-color: #0F766E;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.08);
    }
    .disc-form-control::placeholder {
        color: #94A3B8;
    }

    select.disc-form-control {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2394A3B8' d='M6 8.825L.35 3.175l.7-.7L6 7.425l4.95-4.95.7.7z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
        cursor: pointer;
    }

    .disc-form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 24px;
    }
    @media (max-width: 768px) {
        .disc-form-row {
            grid-template-columns: 1fr;
            gap: 12px;
        }
    }

    .disc-form-group {
        margin-bottom: 0;
    }

    /* Section Label */
    .disc-section-label {
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #94A3B8;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .disc-section-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #F1F5F9;
    }

    /* Discussion Points Container */
    .disc-container {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 16px;
    }

    .disc-slide {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 16px 18px;
        position: relative;
        transition: border-color 0.2s cubic-bezier(0.22, 1, 0.36, 1),
                    box-shadow 0.2s cubic-bezier(0.22, 1, 0.36, 1),
                    opacity 0.25s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.25s cubic-bezier(0.22, 1, 0.36, 1);
        animation: discSlideIn 0.35s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }
    .disc-slide:focus-within {
        border-color: #0F766E;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.06);
    }

    .disc-slide-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
    .disc-slide-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 8px;
        background: rgba(15, 118, 110, 0.08);
        color: #0F766E;
        font-size: 0.78rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    .disc-slide-remove {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        border: none;
        background: transparent;
        color: #CBD5E1;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.82rem;
        transition: all 0.2s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .disc-slide-remove:hover {
        background: #FEF2F2;
        color: #EF4444;
    }

    .disc-slide textarea {
        width: 100%;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 0.88rem;
        color: #0F172A;
        background: #fff;
        resize: vertical;
        min-height: 80px;
        font-family: inherit;
        outline: none;
        transition: border-color 0.2s cubic-bezier(0.22, 1, 0.36, 1),
                    box-shadow 0.2s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .disc-slide textarea:focus {
        border-color: #0F766E;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.08);
    }
    .disc-slide textarea::placeholder {
        color: #94A3B8;
    }

    /* Add Point Button */
    .btn-add-point {
        width: 100%;
        padding: 12px;
        border: 2px dashed #CBD5E1;
        border-radius: 12px;
        background: transparent;
        color: #64748B;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.25s cubic-bezier(0.22, 1, 0.36, 1);
        margin-bottom: 24px;
    }
    .btn-add-point:hover {
        border-color: #0F766E;
        color: #0F766E;
        background: rgba(15, 118, 110, 0.02);
    }
    .btn-add-point:active {
        background: rgba(15, 118, 110, 0.05);
    }

    /* Action Buttons */
    .disc-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 16px;
        border-top: 1px solid #F1F5F9;
    }
    @media (max-width: 768px) {
        .disc-actions {
            flex-direction: column;
        }
        .disc-actions button {
            width: 100%;
            justify-content: center;
        }
    }

    .btn-disc-reset {
        padding: 10px 20px;
        border-radius: 10px;
        border: 1px solid #E2E8F0;
        background: #fff;
        color: #64748B;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .btn-disc-reset:hover {
        background: #F8FAFC;
        border-color: #CBD5E1;
    }

    .btn-disc-save {
        padding: 10px 28px;
        border-radius: 10px;
        border: none;
        background: #0F766E;
        color: #fff;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.25s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .btn-disc-save:hover {
        background: #0D9488;
        box-shadow: 0 4px 16px rgba(15, 118, 110, 0.25);
        transform: translateY(-1px);
    }
    .btn-disc-save:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(15, 118, 110, 0.2);
    }
    .btn-disc-save:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    /* Toast */
    .toast-disc {
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
        animation: discToastIn 0.35s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }
    .toast-disc.show {
        display: flex;
    }
    .toast-disc.toast-success {
        background: #ECFDF5;
        color: #059669;
        border: 1px solid #A7F3D0;
    }
    .toast-disc.toast-error {
        background: #FEF2F2;
        color: #EF4444;
        border: 1px solid #FECACA;
    }
    .toast-disc .toast-close {
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
    .toast-disc .toast-close:hover {
        opacity: 1;
    }

    @keyframes discSlideIn {
        from {
            opacity: 0;
            transform: translateY(8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes discToastIn {
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
        .disc-card-body {
            padding: 16px;
        }
        .disc-card-header {
            padding: 16px;
        }
        .toast-disc {
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
    <div class="disc-header">
        <h2>Add Discussion</h2>
        <p>Catat poin pembahasan dan notulensi rapat secara terstruktur.</p>
    </div>

    <!-- Form Card -->
    <div style="max-width:860px; margin:0 auto;">
        <div class="disc-card">
            <div class="disc-card-header">
                <div class="header-icon"><i class="fas fa-pen-to-square"></i></div>
                <h6>Formulir Notulensi Rapat</h6>
            </div>
            <div class="disc-card-body">
                <form id="discussion-form">

                    <!-- Row 1: Meeting + Topik -->
                    <div class="disc-form-row">
                        <div class="disc-form-group">
                            <label class="disc-form-label" for="disc-meeting-id">Pilih Meeting</label>
                            <select id="disc-meeting-id" name="meeting_id" class="disc-form-control" required>
                                <option value="">-- Pilih Kegiatan Rapat --</option>
                                <?php if (!empty($meetings)): ?>
                                    <?php foreach ($meetings as $meeting): ?>
                                        <option value="<?= $meeting['id'] ?>"><?= esc($meeting['nama_meeting']) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="disc-form-group">
                            <label class="disc-form-label" for="disc-topik">Topik Pembahasan</label>
                            <input type="text"
                                   id="disc-topik"
                                   name="topik"
                                   class="disc-form-control"
                                   placeholder="Topik utama rapat"
                                   required>
                        </div>
                    </div>

                    <!-- Discussion Points -->
                    <div class="disc-section-label">Detail Pembahasan</div>

                    <div class="disc-container" id="discussion-container">
                        <div class="disc-slide">
                            <div class="disc-slide-header">
                                <span class="disc-slide-badge">1</span>
                                <button type="button" class="disc-slide-remove remove-slide" title="Hapus poin">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <textarea name="pembahasan[]"
                                      rows="3"
                                      placeholder="Tulis detail pembahasan..."
                                      required></textarea>
                        </div>
                    </div>

                    <button type="button" id="add-slide" class="btn-add-point">
                        <i class="fas fa-plus"></i> Tambah Poin Pembahasan
                    </button>

                    <!-- Row 2: Tanggal + Notulis -->
                    <div class="disc-section-label">Informasi Pencatatan</div>

                    <div class="disc-form-row">
                        <div class="disc-form-group">
                            <label class="disc-form-label" for="disc-tanggal">Tanggal</label>
                            <input type="date"
                                   id="disc-tanggal"
                                   name="tanggal"
                                   class="disc-form-control"
                                   required>
                        </div>
                        <div class="disc-form-group">
                            <label class="disc-form-label" for="disc-notulis">Nama Notulis</label>
                            <input type="text"
                                   id="disc-notulis"
                                   name="nama_notulis"
                                   class="disc-form-control"
                                   placeholder="Nama pencatat notulensi"
                                   required>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="disc-actions">
                        <button type="reset" class="btn-disc-reset">Reset</button>
                        <button type="submit" class="btn-disc-save" id="btn-disc-submit">
                            <i class="fas fa-check"></i> Simpan Notulensi
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Toast -->
<div class="toast-disc" id="toastDisc">
    <i id="toastDiscIcon"></i>
    <span id="toastDiscMsg"></span>
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
    function showDiscToast(message, type) {
        var toast = document.getElementById('toastDisc');
        var icon = document.getElementById('toastDiscIcon');
        var msg = document.getElementById('toastDiscMsg');
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

    /**
     * Renumber all discussion point badges sequentially
     */
    function renumberSlides() {
        var slides = document.querySelectorAll('#discussion-container .disc-slide');
        slides.forEach(function(slide, index) {
            var badge = slide.querySelector('.disc-slide-badge');
            if (badge) badge.textContent = index + 1;
        });
    }

    // ── Add Discussion Point ──
    var addSlideBtn = document.getElementById('add-slide');
    if (addSlideBtn) {
        addSlideBtn.addEventListener('click', function() {
            var count = document.querySelectorAll('#discussion-container .disc-slide').length + 1;
            var slide = document.createElement('div');
            slide.className = 'disc-slide';
            slide.innerHTML =
                '<div class="disc-slide-header">' +
                    '<span class="disc-slide-badge">' + count + '</span>' +
                    '<button type="button" class="disc-slide-remove remove-slide" title="Hapus poin">' +
                        '<i class="fas fa-times"></i>' +
                    '</button>' +
                '</div>' +
                '<textarea name="pembahasan[]" rows="3" placeholder="Tulis detail pembahasan..." required></textarea>';
            document.getElementById('discussion-container').appendChild(slide);

            // Focus the new textarea
            var newTextarea = slide.querySelector('textarea');
            if (newTextarea) {
                setTimeout(function() { newTextarea.focus(); }, 50);
            }
        });
    }

    // ── Remove Discussion Point (Event Delegation) ──
    var container = document.getElementById('discussion-container');
    if (container) {
        container.addEventListener('click', function(e) {
            var removeBtn = e.target.closest('.remove-slide');
            if (!removeBtn) return;

            var slide = removeBtn.closest('.disc-slide');
            if (!slide) return;

            // Prevent removing the last slide
            var totalSlides = container.querySelectorAll('.disc-slide').length;
            if (totalSlides <= 1) {
                showDiscToast('Minimal harus ada 1 poin pembahasan', 'error');
                return;
            }

            // Animate out then remove
            slide.style.opacity = '0';
            slide.style.transform = 'translateY(-8px)';
            setTimeout(function() {
                slide.remove();
                renumberSlides();
            }, 250);
        });
    }

    // ── Form Submit ──
    var form = document.getElementById('discussion-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            var submitBtn = document.getElementById('btn-disc-submit');
            var originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';

            var formData = new FormData(this);

            fetch(baseUrl + 'discussion/save', {
                method: 'POST',
                body: formData
            })
            .then(function(response) {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(function(result) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;

                if (result.success !== false) {
                    showDiscToast(result.message || 'Notulensi berhasil disimpan!', 'success');

                    // Reset form
                    form.reset();

                    // Reset discussion container to single empty point
                    var discContainer = document.getElementById('discussion-container');
                    discContainer.innerHTML =
                        '<div class="disc-slide">' +
                            '<div class="disc-slide-header">' +
                                '<span class="disc-slide-badge">1</span>' +
                                '<button type="button" class="disc-slide-remove remove-slide" title="Hapus poin">' +
                                    '<i class="fas fa-times"></i>' +
                                '</button>' +
                            '</div>' +
                            '<textarea name="pembahasan[]" rows="3" placeholder="Tulis detail pembahasan..." required></textarea>' +
                        '</div>';
                } else {
                    showDiscToast(result.message || 'Gagal menyimpan notulensi', 'error');
                }
            })
            .catch(function(error) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
                showDiscToast('Gagal menyimpan notulensi. Periksa koneksi Anda.', 'error');
                console.error('Discussion save error:', error);
            });
        });
    }

    // ── Auto-set today's date ──
    var tanggalInput = document.getElementById('disc-tanggal');
    if (tanggalInput && !tanggalInput.value) {
        var today = new Date();
        var yyyy = today.getFullYear();
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var dd = String(today.getDate()).padStart(2, '0');
        tanggalInput.value = yyyy + '-' + mm + '-' + dd;
    }
}
</script>
