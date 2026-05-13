<style>
    /* ── Dashboard Scoped Styles ── */
    .dash-welcome {
        margin-bottom: 2rem;
    }
    .dash-welcome h2 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 4px;
        letter-spacing: -0.025em;
    }
    .dash-welcome p {
        color: #64748B;
        font-size: 0.9rem;
        margin: 0;
        line-height: 1.5;
    }

    /* Feature Cards Grid */
    .feature-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-bottom: 32px;
    }
    @media (max-width: 768px) {
        .feature-grid {
            grid-template-columns: 1fr !important;
            gap: 12px;
        }
    }

    .feature-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 20px;
        cursor: pointer;
        transition: transform 0.3s cubic-bezier(0.22, 1, 0.36, 1),
                    box-shadow 0.3s cubic-bezier(0.22, 1, 0.36, 1),
                    border-color 0.3s cubic-bezier(0.22, 1, 0.36, 1);
        display: flex;
        align-items: flex-start;
        gap: 14px;
        position: relative;
        overflow: hidden;
    }
    .feature-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--card-accent, #0F766E);
        opacity: 0;
        transition: opacity 0.3s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .feature-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        border-color: transparent;
    }
    .feature-card:hover::after {
        opacity: 1;
    }
    .feature-card:active {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    }

    .feature-card .card-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
        transition: transform 0.3s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .feature-card:hover .card-icon {
        transform: scale(1.1);
    }

    .feature-card .card-text h6 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.92rem;
        font-weight: 600;
        color: #0F172A;
        margin-bottom: 3px;
    }
    .feature-card .card-text p {
        font-size: 0.8rem;
        color: #64748B;
        margin: 0;
        line-height: 1.45;
    }

    /* Card accent colors */
    .feature-card.card-meeting    { --card-accent: #0F766E; }
    .feature-card.card-participant { --card-accent: #059669; }
    .feature-card.card-discussion { --card-accent: #0369A1; }
    .feature-card.card-export     { --card-accent: #D97706; }

    .icon-meeting     { background: rgba(15, 118, 110, 0.08); color: #0F766E; }
    .icon-participant { background: rgba(5, 150, 105, 0.08);  color: #059669; }
    .icon-discussion  { background: rgba(3, 105, 161, 0.08);  color: #0369A1; }
    .icon-export      { background: rgba(217, 119, 6, 0.08);  color: #D97706; }

    /* Upcoming Meeting Section */
    .upcoming-section {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-left: 3px solid #0F766E;
        border-radius: 12px;
        padding: 24px;
        display: none;
        animation: dashSlideUp 0.45s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }
    .upcoming-section.show {
        display: block;
    }

    .upcoming-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid #F1F5F9;
    }
    .upcoming-header .icon-bell {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(15, 118, 110, 0.08);
        color: #0F766E;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
    }
    .upcoming-header h5 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        color: #0F172A;
        margin: 0;
    }

    .upcoming-body {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
    }
    @media (max-width: 768px) {
        .upcoming-body {
            flex-direction: column;
        }
    }

    .upcoming-info h4 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.1rem;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 8px;
    }
    .upcoming-meta {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .upcoming-meta span {
        font-size: 0.85rem;
        color: #64748B;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .upcoming-meta span i {
        width: 16px;
        text-align: center;
        color: #94A3B8;
        font-size: 0.82rem;
    }

    .upcoming-actions {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 12px;
        flex-shrink: 0;
    }
    @media (max-width: 768px) {
        .upcoming-actions {
            align-items: flex-start;
            width: 100%;
        }
    }

    .countdown-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
        white-space: nowrap;
    }
    .countdown-badge.live {
        background: rgba(15, 118, 110, 0.08);
        color: #0F766E;
    }
    .countdown-badge.done {
        background: rgba(100, 116, 139, 0.08);
        color: #64748B;
    }

    .upcoming-btns {
        display: flex;
        gap: 8px;
    }
    @media (max-width: 768px) {
        .upcoming-btns {
            width: 100%;
        }
        .upcoming-btns .btn-upcoming {
            flex: 1;
            justify-content: center;
        }
    }

    .btn-upcoming {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.25s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .btn-upcoming.btn-absensi {
        background: #0F766E;
        color: #fff;
    }
    .btn-upcoming.btn-absensi:hover {
        background: #0D9488;
        box-shadow: 0 4px 12px rgba(15, 118, 110, 0.25);
        transform: translateY(-1px);
    }
    .btn-upcoming.btn-notulensi {
        background: rgba(3, 105, 161, 0.1);
        color: #0369A1;
    }
    .btn-upcoming.btn-notulensi:hover {
        background: rgba(3, 105, 161, 0.18);
        transform: translateY(-1px);
    }

    /* Extra spacing at bottom of dashboard to prevent content overlap */
    .feature-grid + .upcoming-section,
    .feature-grid:last-child {
        margin-bottom: 24px;
    }

    @keyframes dashSlideUp {
        from {
            opacity: 0;
            transform: translateY(12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<!-- Welcome Section -->
<div class="container-fluid p-0">
    <div class="dash-welcome mb-5">
        <h2>Selamat Datang, <?= esc(session()->get('user')['username'] ?? 'User') ?></h2>
        <p>Kelola rapat, absensi, dan notulensi dalam satu platform.</p>
    </div>

    <!-- Feature Cards Grid -->
    <div class="feature-grid">
        <!-- Card: Meeting -->
        <div class="feature-card card-meeting"
             onclick="loadContent('meeting'); setActive(document.querySelector('a[onclick*=meeting]'))">
            <div class="card-icon icon-meeting">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="card-text">
                <h6>Manage Meeting</h6>
                <p>Buat dan atur jadwal rapat dengan mudah</p>
            </div>
        </div>

        <!-- Card: Participant -->
        <div class="feature-card card-participant"
             onclick="loadContent('participant'); setActive(document.querySelector('a[onclick*=participant]'))">
            <div class="card-icon icon-participant">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-text">
                <h6>Participant</h6>
                <p>Scan dan input kehadiran peserta rapat</p>
            </div>
        </div>

        <!-- Card: Discussion -->
        <div class="feature-card card-discussion"
             onclick="loadContent('discussion'); setActive(document.querySelector('a[onclick*=discussion]'))">
            <div class="card-icon icon-discussion">
                <i class="fas fa-comments"></i>
            </div>
            <div class="card-text">
                <h6>Discussion</h6>
                <p>Catat poin pembahasan dan notulensi rapat</p>
            </div>
        </div>

        <!-- Card: Export -->
        <div class="feature-card card-export"
             onclick="loadContent('export'); setActive(document.querySelector('a[onclick*=export]'))">
            <div class="card-icon icon-export">
                <i class="fas fa-file-pdf"></i>
            </div>
            <div class="card-text">
                <h6>Export PDF</h6>
                <p>Unduh laporan hasil rapat dalam format PDF</p>
            </div>
        </div>
    </div>

    <!-- Upcoming Meeting Section -->
    <div class="upcoming-section" id="upcoming-meeting">
        <div class="upcoming-header">
            <div class="icon-bell"><i class="fas fa-bell"></i></div>
            <h5>Meeting Akan Datang</h5>
        </div>
        <div class="upcoming-body" id="meeting-detail"></div>
    </div>
</div>

<script>
{
    const baseUrl = typeof siteBaseUrl !== 'undefined' ? siteBaseUrl : '<?= base_url() ?>';

    function escapeHtml(text) {
        if (!text) return '';
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(text));
        return div.innerHTML;
    }

    /**
     * Calculate time remaining until meeting and return formatted badge HTML
     * @param {string} meetingTime - ISO datetime string of the meeting
     * @returns {string} HTML string for countdown badge
     */
    function getTimeRemaining(meetingTime) {
        const now = new Date().getTime();
        const target = new Date(meetingTime).getTime();
        const diff = target - now;

        if (diff <= 0) {
            return '<span class="countdown-badge done"><i class="fas fa-check-circle"></i> Sedang berlangsung / Selesai</span>';
        }

        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));

        let text = '';
        if (days > 0) text += days + ' hari ';
        text += hours + ' jam ' + minutes + ' menit';

        return '<span class="countdown-badge live"><i class="fas fa-clock"></i> Dimulai dalam ' + text + '</span>';
    }

    /**
     * Fetch upcoming meeting reminder from API and render if available
     */
    fetch(baseUrl + 'v1/reminder')
        .then(function(res) {
            if (!res.ok) throw new Error('Network response was not ok');
            return res.json();
        })
        .then(function(data) {
            if (data.length > 0) {
                var meeting = data[0];
                var dateObj = new Date(meeting.tanggal);
                var formattedDate = dateObj.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                var formattedTime = dateObj.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit'
                }) + ' WIB';

                var detail = '' +
                    '<div class="upcoming-info">' +
                        '<h4>' + escapeHtml(meeting.nama_meeting) + '</h4>' +
                        '<div class="upcoming-meta">' +
                            '<span><i class="fas fa-map-marker-alt"></i> ' + escapeHtml(meeting.tempat) + '</span>' +
                            '<span><i class="fas fa-calendar-day"></i> ' + formattedDate + '</span>' +
                            '<span><i class="fas fa-clock"></i> ' + formattedTime + '</span>' +
                        '</div>' +
                    '</div>' +
                    '<div class="upcoming-actions">' +
                        '<div>' + getTimeRemaining(meeting.tanggal) + '</div>' +
                        '<div class="upcoming-btns">' +
                            '<button class="btn-upcoming btn-absensi" onclick="loadContent(\'participant\'); setActive(document.querySelector(\'a[onclick*=participant]\'))">' +
                                '<i class="fas fa-user-check"></i> Absensi' +
                            '</button>' +
                            '<button class="btn-upcoming btn-notulensi" onclick="loadContent(\'discussion\'); setActive(document.querySelector(\'a[onclick*=discussion]\'))">' +
                                '<i class="fas fa-edit"></i> Notulensi' +
                            '</button>' +
                        '</div>' +
                    '</div>';

                document.getElementById('meeting-detail').innerHTML = detail;
                document.getElementById('upcoming-meeting').classList.add('show');
            }
        })
        .catch(function(err) {
        });
}
</script>
