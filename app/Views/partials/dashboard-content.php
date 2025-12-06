<div class="container-fluid p-0">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-bold text-dark">Dashboard</h1>
    </div>

    <!-- Welcome Banner -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-left-primary shadow h-100 py-2 border-0 rounded-3" style="background: linear-gradient(45deg, #4e73df, #224abe);">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2 text-white">
                            <div class="h5 font-weight-bold text-uppercase mb-1">Selamat Datang di Minutes of Meeting</div>
                            <div class="mb-0">Kelola rapat, absensi, dan notulensi dengan mudah dan efisien dalam satu platform.</div>
                        </div>
                        <div class="col-auto text-white-50">
                            <i class="fas fa-clipboard-list fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards Row -->
    <div class="row">
        <!-- Manage Meeting -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 py-2 hover-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Manage Meeting</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Jadwal & Rapat</div>
                            <small class="text-muted">Buat dan atur jadwal</small>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-primary bg-opacity-10 text-primary p-3 rounded-circle">
                                <i class="fas fa-calendar-alt fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Participant Input -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 py-2 hover-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Participant</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Absensi Peserta</div>
                            <small class="text-muted">Scan & Input kehadiran</small>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-success bg-opacity-10 text-success p-3 rounded-circle">
                                <i class="fas fa-users fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Discussion -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 py-2 hover-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Discussion</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Notulensi</div>
                            <small class="text-muted">Catat poin pembahasan</small>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-info bg-opacity-10 text-info p-3 rounded-circle">
                                <i class="fas fa-comments fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Export PDF -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 py-2 hover-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Export</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Laporan PDF</div>
                            <small class="text-muted">Unduh hasil rapat</small>
                        </div>
                        <div class="col-auto">
                             <div class="icon-circle bg-warning bg-opacity-10 text-warning p-3 rounded-circle">
                                <i class="fas fa-file-pdf fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Meeting Alert -->
    <div class="row" id="upcoming-meeting" style="display:none;">
        <div class="col-12">
             <div class="card shadow-sm border-0 border-start border-4 border-info">
                <div class="card-body">
                    <h5 class="card-title text-info"><i class="fas fa-bell me-2"></i> Meeting Akan Datang</h5>
                    <div id="meeting-detail" class="text-dark"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Help Button -->
<a href="https://wa.me/6285702444966" target="_blank" class="btn btn-success rounded-circle shadow-lg d-flex align-items-center justify-content-center whatsapp-float" 
   title="Hubungi CS via WhatsApp">
  <i class="fab fa-whatsapp fa-2x"></i>
</a>

<style>
    .hover-card {
        transition: transform 0.2s;
        cursor: pointer;
    }
    .hover-card:hover {
        transform: translateY(-5px);
    }

    .whatsapp-float {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        z-index: 999;
        background-color: #25d366;
        border: none;
        animation: pulse-green 2s infinite;
    }

    .whatsapp-float:hover {
        background-color: #128c7e;
        transform: scale(1.1);
        transition: all 0.3s ease;
    }

    @keyframes pulse-green {
        0% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
        }
        70% {
            box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
        }
    }
</style>

<script>
{
  const baseUrl = typeof siteBaseUrl !== 'undefined' ? siteBaseUrl : '<?= base_url() ?>';

  function getTimeRemaining(meetingTime) {
    const now = new Date().getTime();
    const target = new Date(meetingTime).getTime();
    const diff = target - now;

    if (diff <= 0) return '<span class="badge bg-secondary">Sedang berlangsung / Selesai</span>';

    const hours = Math.floor(diff / (1000 * 60 * 60));
    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));

    return `<span class="badge bg-info text-white">Dimulai dalam ${hours} jam ${minutes} menit</span>`;
  }

  fetch(baseUrl + 'v1/reminder')
    .then(res => res.json())
    .then(data => {
      if (data.length > 0) {
        const meeting = data[0]; 
        const detail = `
          <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
              <div>
                  <h4 class="fw-bold mb-1">${meeting.nama_meeting}</h4>
                  <p class="mb-1 text-muted"><i class="fas fa-map-marker-alt me-2"></i>${meeting.tempat}</p>
                  <p class="mb-0 text-muted"><i class="far fa-clock me-2"></i>${new Date(meeting.tanggal).toLocaleString()}</p>
              </div>
              <div class="mt-3 mt-md-0 text-md-end">
                  <div class="mb-2">${getTimeRemaining(meeting.tanggal)}</div>
                  <div class="d-flex gap-2 justify-content-md-end">
                      <button onclick="location.hash='#participant-content'" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm">
                        <i class="fas fa-user-check me-1"></i> Absensi
                      </button>
                      <button onclick="location.hash='#discussion-content'" class="btn btn-sm btn-info text-white rounded-pill px-3 shadow-sm">
                        <i class="fas fa-edit me-1"></i> Notulensi
                      </button>
                  </div>
              </div>
          </div>
        `;
        document.getElementById('meeting-detail').innerHTML = detail;
        document.getElementById('upcoming-meeting').style.display = 'block';
      }
    })
    .catch(err => console.error('Error loading reminder:', err));
}
</script>
