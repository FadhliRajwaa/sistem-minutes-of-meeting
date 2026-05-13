<style>
    /* ===== Profile Page Scoped Styles ===== */
    .profile-page {
        --color-primary: #0F766E;
        --color-accent: #0D9488;
        --color-surface: #F8FAFC;
        --color-border: #E2E8F0;
        --color-text: #0F172A;
        --color-muted: #64748B;
        --color-success: #059669;
        --color-danger: #DC2626;
    }

    .profile-page .page-header {
        margin-bottom: 28px;
    }
    .profile-page .page-header h2 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--color-text);
        margin: 0 0 4px;
        letter-spacing: -0.025em;
    }
    .profile-page .page-header p {
        color: var(--color-muted);
        font-size: 0.9rem;
        margin: 0;
    }

    /* Grid 2 columns desktop, 1 column mobile */
    .profile-grid {
        display: grid;
        grid-template-columns: 360px 1fr;
        gap: 24px;
        align-items: start;
    }
    @media (max-width: 992px) {
        .profile-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
    }

    /* Card base */
    .profile-card {
        background: #fff;
        border: 1px solid var(--color-border);
        border-radius: 14px;
        padding: 24px;
        overflow: hidden;
    }
    .profile-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--color-border);
    }
    .profile-card-header .card-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: rgba(15, 118, 110, 0.08);
        color: var(--color-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
    }
    .profile-card-header h6 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--color-text);
        margin: 0;
    }
    .profile-card-header small {
        display: block;
        color: var(--color-muted);
        font-size: 0.78rem;
        margin-top: 2px;
    }

    /* Avatar Card */
    .avatar-card {
        text-align: center;
    }
    .avatar-wrapper {
        position: relative;
        width: 140px;
        height: 140px;
        margin: 8px auto 20px;
    }
    .avatar-display {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        overflow: hidden;
        background: linear-gradient(135deg, #0F766E, #14B8A6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 3rem;
        font-weight: 700;
        border: 4px solid #fff;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.1);
    }
    .avatar-display img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .avatar-edit-btn {
        position: absolute;
        bottom: 4px;
        right: 4px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--color-primary);
        color: #fff;
        border: 3px solid #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 0.95rem;
        transition: all 0.2s cubic-bezier(0.22, 1, 0.36, 1);
        box-shadow: 0 3px 10px rgba(15, 118, 110, 0.3);
    }
    .avatar-edit-btn:hover {
        background: var(--color-accent);
        transform: scale(1.08);
    }
    .avatar-input { display: none; }

    .avatar-name {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--color-text);
        margin: 0 0 4px;
    }
    .avatar-email {
        color: var(--color-muted);
        font-size: 0.85rem;
        margin: 0 0 16px;
        word-break: break-all;
    }
    .avatar-role {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 20px;
        background: rgba(15, 118, 110, 0.08);
        color: var(--color-primary);
        font-size: 0.76rem;
        font-weight: 600;
        text-transform: capitalize;
    }
    .avatar-role i { font-size: 0.65rem; }

    .avatar-info-list {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid var(--color-border);
        text-align: left;
    }
    .avatar-info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        font-size: 0.82rem;
    }
    .avatar-info-item .label {
        color: var(--color-muted);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .avatar-info-item .label i { width: 14px; text-align: center; font-size: 0.75rem; }
    .avatar-info-item .value {
        color: var(--color-text);
        font-weight: 500;
    }

    /* Form */
    .profile-form .form-row {
        margin-bottom: 18px;
    }
    .profile-form label {
        display: block;
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--color-text);
        margin-bottom: 6px;
        letter-spacing: 0.01em;
    }
    .profile-form .form-control {
        width: 100%;
        padding: 11px 14px;
        border: 1px solid var(--color-border);
        border-radius: 8px;
        background: var(--color-surface);
        color: var(--color-text);
        font-size: 0.9rem;
        font-family: inherit;
        transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
    }
    .profile-form .form-control:focus {
        outline: none;
        border-color: var(--color-primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.12);
    }
    .profile-form .form-help {
        font-size: 0.75rem;
        color: var(--color-muted);
        margin-top: 4px;
    }

    .form-divider {
        height: 1px;
        background: var(--color-border);
        margin: 24px 0;
    }

    /* Buttons */
    .btn-profile {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 0.86rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .btn-profile-primary {
        background: var(--color-primary);
        color: #fff;
    }
    .btn-profile-primary:hover {
        background: var(--color-accent);
        box-shadow: 0 4px 12px rgba(15, 118, 110, 0.25);
        transform: translateY(-1px);
    }
    .btn-profile-primary:disabled {
        opacity: 0.65;
        cursor: not-allowed;
        transform: none;
    }
    .btn-profile-secondary {
        background: transparent;
        color: var(--color-text);
        border: 1px solid var(--color-border);
    }
    .btn-profile-secondary:hover {
        background: var(--color-surface);
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 8px;
    }
    @media (max-width: 576px) {
        .form-actions {
            flex-direction: column-reverse;
        }
        .form-actions .btn-profile { width: 100%; }
    }

    /* Toast */
    .toast-profile {
        position: fixed;
        top: 84px;
        right: 24px;
        z-index: 1090;
        min-width: 300px;
        max-width: 420px;
        padding: 14px 18px;
        border-radius: 12px;
        font-size: 0.88rem;
        font-weight: 600;
        display: none;
        align-items: center;
        gap: 10px;
        box-shadow: 0 10px 40px rgba(15, 23, 42, 0.15);
        animation: profToastIn 0.3s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }
    .toast-profile.show { display: flex; }
    .toast-profile.success {
        background: #ECFDF5;
        color: #059669;
        border: 1px solid #A7F3D0;
    }
    .toast-profile.error {
        background: #FEF2F2;
        color: #EF4444;
        border: 1px solid #FECACA;
    }
    @keyframes profToastIn {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @media (max-width: 768px) {
        .toast-profile {
            top: 72px;
            left: 12px;
            right: 12px;
            min-width: auto;
            max-width: none;
        }
        .profile-card { padding: 18px; }
        .avatar-wrapper,
        .avatar-display { width: 120px; height: 120px; font-size: 2.6rem; }
    }
</style>

<!-- Toast -->
<div class="toast-profile" id="toastProfile">
    <i id="toastProfileIcon"></i>
    <span id="toastProfileMsg"></span>
</div>

<div class="profile-page">
    <div class="page-header">
        <h2>Pengaturan Profil</h2>
        <p>Kelola informasi akun, foto, dan kata sandi Anda.</p>
    </div>

    <div class="profile-grid">
        <!-- Left: Avatar Card -->
        <div class="profile-card avatar-card">
            <div class="avatar-wrapper">
                <div class="avatar-display" id="avatarDisplay">
                    <?php
                    $foto = $user['foto'] ?? 'default.png';
                    $initial = strtoupper(substr($user['username'] ?? 'U', 0, 1));
                    
                    if (!empty($foto) && $foto !== 'default.png'):
                        if (strpos($foto, 'data:image/') === 0):
                    ?>
                        <img src="<?= $foto ?>" alt="Foto profil" id="avatarImg">
                    <?php elseif (filter_var($foto, FILTER_VALIDATE_URL)):
                    ?>
                        <img src="<?= esc($foto) ?>" alt="Foto profil" id="avatarImg">
                    <?php else: ?>
                        <img src="<?= base_url('uploads/foto/' . $foto) ?>" alt="Foto profil" id="avatarImg">
                    <?php endif;
                    else: ?>
                        <span id="avatarInitial"><?= $initial ?></span>
                    <?php endif; ?>
                </div>
                <label for="avatarInput" class="avatar-edit-btn" title="Ganti foto">
                    <i class="fas fa-camera"></i>
                </label>
                <input type="file" id="avatarInput" class="avatar-input" accept="image/jpeg,image/png,image/gif,image/webp">
            </div>

            <h5 class="avatar-name" id="displayName"><?= esc($user['username'] ?? 'User') ?></h5>
            <p class="avatar-email"><?= esc($user['email'] ?? '') ?></p>
            <span class="avatar-role">
                <i class="fas fa-circle"></i>
                <?= esc(ucfirst($user['role'] ?? 'peserta')) ?>
            </span>

            <div class="avatar-info-list">
                <div class="avatar-info-item">
                    <span class="label"><i class="fas fa-id-badge"></i> ID Akun</span>
                    <span class="value">#<?= (int) ($user['id'] ?? 0) ?></span>
                </div>
                <div class="avatar-info-item">
                    <span class="label"><i class="fas fa-calendar-day"></i> Bergabung</span>
                    <span class="value">
                        <?= !empty($user['created_at']) ? date('d M Y', strtotime($user['created_at'])) : '-' ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Right: Forms -->
        <div>
            <!-- Info Akun Form -->
            <div class="profile-card" style="margin-bottom:16px;">
                <div class="profile-card-header">
                    <div class="card-icon"><i class="fas fa-user-pen"></i></div>
                    <div>
                        <h6>Informasi Akun</h6>
                        <small>Perbarui nama tampilan dan email Anda</small>
                    </div>
                </div>
                <form id="profileInfoForm" class="profile-form" enctype="multipart/form-data">
                    <div class="form-row">
                        <label for="input-username">Nama Tampilan</label>
                        <input type="text" id="input-username" name="username" class="form-control" value="<?= esc($user['username'] ?? '') ?>" placeholder="Nama lengkap Anda" required>
                        <div class="form-help">Nama yang ditampilkan di aplikasi.</div>
                    </div>
                    <div class="form-row">
                        <label for="input-email">Alamat Email</label>
                        <input type="email" id="input-email" name="email" class="form-control" value="<?= esc($user['email'] ?? '') ?>" placeholder="email@example.com" required>
                        <div class="form-help">Email digunakan untuk login dan notifikasi.</div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-profile btn-profile-primary" id="btnSaveInfo">
                            <i class="fas fa-check"></i>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Password Form -->
            <div class="profile-card">
                <div class="profile-card-header">
                    <div class="card-icon" style="background:rgba(217,119,6,0.08); color:#D97706;">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h6>Kata Sandi</h6>
                        <small>Ubah password secara berkala untuk keamanan</small>
                    </div>
                </div>
                <form id="profilePasswordForm" class="profile-form">
                    <div class="form-row">
                        <label for="input-current-pwd">Password Saat Ini</label>
                        <input type="password" id="input-current-pwd" name="current_password" class="form-control" placeholder="Masukan password lama" required autocomplete="current-password">
                    </div>
                    <div class="form-row">
                        <label for="input-new-pwd">Password Baru</label>
                        <input type="password" id="input-new-pwd" name="new_password" class="form-control" placeholder="Minimal 6 karakter" required autocomplete="new-password">
                    </div>
                    <div class="form-row">
                        <label for="input-confirm-pwd">Konfirmasi Password Baru</label>
                        <input type="password" id="input-confirm-pwd" name="confirm_password" class="form-control" placeholder="Ulangi password baru" required autocomplete="new-password">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-profile btn-profile-primary" id="btnSavePwd">
                            <i class="fas fa-key"></i>
                            <span>Ubah Password</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    'use strict';
    const baseUrl = typeof siteBaseUrl !== 'undefined' ? siteBaseUrl : '<?= base_url() ?>';

    function showToast(message, type) {
        type = type || 'success';
        var toast = document.getElementById('toastProfile');
        var icon = document.getElementById('toastProfileIcon');
        var msg = document.getElementById('toastProfileMsg');
        if (!toast) return;

        toast.classList.remove('success', 'error', 'show');
        void toast.offsetWidth;
        toast.classList.add(type);
        icon.className = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';
        msg.textContent = message;
        toast.classList.add('show');

        setTimeout(function () { toast.classList.remove('show'); }, 3500);
    }

    // === Avatar upload with client-side resize ===
    var avatarInput = document.getElementById('avatarInput');
    var avatarDisplay = document.getElementById('avatarDisplay');
    var selectedBase64 = null;

    function resizeImage(file, maxSize, quality, callback) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = new Image();
            img.onload = function() {
                var canvas = document.createElement('canvas');
                var size = Math.min(img.width, img.height);
                var sx = (img.width - size) / 2;
                var sy = (img.height - size) / 2;
                canvas.width = maxSize;
                canvas.height = maxSize;
                var ctx = canvas.getContext('2d');
                ctx.drawImage(img, sx, sy, size, size, 0, 0, maxSize, maxSize);
                callback(canvas.toDataURL('image/jpeg', quality));
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    if (avatarInput) {
        avatarInput.addEventListener('change', function(e) {
            var file = e.target.files[0];
            if (!file) return;

            var allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (allowed.indexOf(file.type) === -1) {
                showToast('Format foto harus JPG, PNG, GIF, atau WEBP', 'error');
                avatarInput.value = '';
                return;
            }
            if (file.size > 5 * 1024 * 1024) {
                showToast('Ukuran foto maksimal 5MB', 'error');
                avatarInput.value = '';
                return;
            }

            resizeImage(file, 200, 0.8, function(base64) {
                selectedBase64 = base64;
                avatarDisplay.innerHTML = '<img src="' + base64 + '" alt="Preview" id="avatarImg">';
                showToast('Foto dipilih. Klik "Simpan Perubahan" untuk menyimpan.', 'success');
            });
        });
    }

    // === Info form submit ===
    var infoForm = document.getElementById('profileInfoForm');
    if (infoForm) {
        infoForm.addEventListener('submit', function (e) {
            e.preventDefault();
            var btn = document.getElementById('btnSaveInfo');
            var originalHTML = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status"></span> Menyimpan...';

            var formData = new FormData(infoForm);
            if (selectedBase64) {
                formData.append('foto_base64', selectedBase64);
            }

            fetch(baseUrl + 'profile/update', {
                method: 'POST',
                headers: getCsrfHeaders(),
                body: appendCsrf(formData)
            })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (data.success) {
                    showToast(data.message || 'Profil berhasil diperbarui', 'success');
                    // Update display name
                    var displayName = document.getElementById('displayName');
                    if (displayName && data.user) displayName.textContent = data.user.username;

                    selectedBase64 = null;

                    // Reload sidebar avatar dengan update foto
                    setTimeout(function() {
                        if (typeof window.refreshLayoutAvatar === 'function') {
                            window.refreshLayoutAvatar();
                        }
                    }, 500);
                } else {
                    showToast(data.message || 'Gagal memperbarui profil', 'error');
                }
            })
            .catch(function () {
                showToast('Terjadi kesalahan koneksi', 'error');
            })
            .finally(function () {
                btn.disabled = false;
                btn.innerHTML = originalHTML;
            });
        });
    }

    // === Password form submit ===
    var pwdForm = document.getElementById('profilePasswordForm');
    if (pwdForm) {
        pwdForm.addEventListener('submit', function (e) {
            e.preventDefault();
            var btn = document.getElementById('btnSavePwd');
            var originalHTML = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status"></span> Menyimpan...';

            var formData = new FormData(pwdForm);

            fetch(baseUrl + 'profile/change-password', {
                method: 'POST',
                headers: getCsrfHeaders(),
                body: appendCsrf(formData)
            })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (data.success) {
                    showToast(data.message || 'Password berhasil diubah', 'success');
                    pwdForm.reset();
                } else {
                    showToast(data.message || 'Gagal mengubah password', 'error');
                }
            })
            .catch(function () {
                showToast('Terjadi kesalahan koneksi', 'error');
            })
            .finally(function () {
                btn.disabled = false;
                btn.innerHTML = originalHTML;
            });
        });
    }
})();
</script>
