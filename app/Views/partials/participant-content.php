<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-bold text-dark">Participant Input</h1>
        <button id="btnScan" class="btn btn-success shadow-sm rounded-pill px-4">
            <i class="fas fa-qrcode me-2"></i> Scan Barcode
        </button>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
             <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pilih Meeting</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">MEETING AKTIF</label>
                        <select id="meetingSelect" class="form-select shadow-sm border-0 bg-light p-3"></select>
                    </div>
                    <div class="d-grid">
                        <button id="addParticipantBtn" class="btn btn-primary py-2 rounded-3 shadow-sm">
                            <i class="fas fa-plus me-2"></i> Tambah Manual
                        </button>
                    </div>
                </div>
             </div>
        </div>

        <div class="col-md-8 mb-4">
             <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Peserta</h6>
                    <span class="badge bg-primary bg-opacity-10 text-primary" id="participantCount">0 Peserta</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-secondary">
                                <tr>
                                    <th class="ps-4 py-3 border-0 rounded-start">No</th>
                                    <th class="py-3 border-0">Nama Peserta</th>
                                    <th class="py-3 border-0">Barcode ID</th>
                                    <th class="pe-4 py-3 border-0 rounded-end">Status</th>
                                </tr>
                            </thead>
                            <tbody id="participantTable"></tbody>
                        </table>
                    </div>
                </div>
             </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Peserta -->
<div class="modal fade" id="addParticipantModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold text-primary">Tambah Peserta Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="p-3 bg-light rounded-3">
            <input type="hidden" id="meeting_id">
            <div class="mb-3">
              <label class="form-label fw-bold text-dark small">Nama Peserta</label>
              <input type="text" id="nama" class="form-control border-0 shadow-sm" placeholder="Masukkan nama lengkap">
            </div>
            <div class="mb-2">
              <label class="form-label fw-bold text-dark small">Barcode ID / NIP</label>
              <input type="text" id="barcode" class="form-control border-0 shadow-sm" placeholder="Scan atau ketik ID">
            </div>
        </div>
      </div>
      <div class="modal-footer border-0 pt-0">
        <button class="btn btn-light text-muted" data-bs-dismiss="modal">Batal</button>
        <button id="saveParticipant" class="btn btn-primary px-4 rounded-pill">Simpan Peserta</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Scanner -->
<div class="modal fade" id="modalScan" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold text-dark">Scan Barcode Kehadiran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-0">
        <div id="reader" style="width: 100%; border-radius: 0 0 1rem 1rem; overflow: hidden;"></div>
      </div>
      <div class="modal-footer border-0 justify-content-center">
          <p class="text-muted small mb-0">Arahkan kamera ke QR Code / Barcode peserta</p>
      </div>
    </div>
  </div>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
{
    // Gunakan block scope dan global siteBaseUrl
    const baseUrl = typeof siteBaseUrl !== 'undefined' ? siteBaseUrl : '<?= base_url() ?>';
    
    function loadMeetings() {
        // Tampilkan loading state
        $('#meetingSelect').html('<option>Memuat data...</option>');

        $.get(baseUrl + 'api/meetings')
            .done(function(data){
                $('#meetingSelect').empty();
                
                if(Array.isArray(data) && data.length === 0) {
                     $('#meetingSelect').append('<option value="">Tidak ada meeting aktif</option>');
                     $('#addParticipantBtn').prop('disabled', true);
                     return;
                }
                
                // Jika data bukan array (misal error object), handle gracefully
                if (!Array.isArray(data)) {
                    console.error("Invalid data format:", data);
                    $('#meetingSelect').html('<option value="">Error memuat data</option>');
                    return;
                }

                $.each(data, function(i, meeting){
                    $('#meetingSelect').append(`<option value="${meeting.id}">${meeting.nama_meeting}</option>`);
                });
                
                $('#addParticipantBtn').prop('disabled', false);
                // Load participant untuk meeting pertama
                loadParticipants();
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown);
                $('#meetingSelect').html('<option value="">Gagal memuat data (Cek Koneksi)</option>');
            });
    }

    function loadParticipants() {
        const meetingId = $('#meetingSelect').val();
        if (!meetingId) return;
        
        $.get(baseUrl + 'api/participants/' + meetingId, function(data){
            $('#participantTable').empty();
            $('#participantCount').text(data.length + ' Peserta');
            
            if(data.length === 0) {
                $('#participantTable').append('<tr><td colspan="4" class="text-center py-4 text-muted">Belum ada peserta terdaftar</td></tr>');
                return;
            }
            $.each(data, function(i, participant){
                const statusBadge = participant.status === 'Hadir' 
                    ? '<span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded">Hadir</span>'
                    : '<span class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-1 rounded">Belum Hadir</span>';
                    
                $('#participantTable').append(`
                    <tr>
                        <td class="ps-4 text-muted fw-bold">${i+1}</td>
                        <td class="fw-bold text-dark">${participant.name}</td>
                        <td class="font-monospace text-muted">${participant.barcode_id}</td>
                        <td class="pe-4">${statusBadge}</td>
                    </tr>
                `);
            });
        });
    }

    $('#meetingSelect').off('change').on('change', loadParticipants);
    
    $('#addParticipantBtn').off('click').click(function(){
        const mId = $('#meetingSelect').val();
        if(!mId) {
            alert('Silakan buat atau pilih meeting terlebih dahulu!');
            return;
        }
        $('#meeting_id').val(mId);
        $('#addParticipantModal').modal('show');
    });

    $('#saveParticipant').off('click').click(function(){
        const nameVal = $('#nama').val();
        const barcodeVal = $('#barcode').val();
        
        if(!nameVal || !barcodeVal) {
            alert("Nama dan Barcode harus diisi!");
            return;
        }

        $.post(baseUrl + 'api/participants', {
            meeting_id: $('#meeting_id').val(),
            name: nameVal,
            barcode_id: barcodeVal
        }, function(){
            $('#addParticipantModal').modal('hide');
            $('#nama').val('');
            $('#barcode').val('');
            loadParticipants();
        });
    });

    // Scanner Logic
    let html5QrCode;
    
    $('#btnScan').off('click').click(function () {
        $('#modalScan').modal('show');
        startScanner();
    });

    $('#modalScan').on('hidden.bs.modal', function () {
        if (html5QrCode) {
            html5QrCode.stop().then(() => {
                html5QrCode.clear();
            }).catch(err => console.error("Stop error", err));
        }
    });

    function startScanner() {
        html5QrCode = new Html5Qrcode("reader");
        const config = { fps: 10, qrbox: 250 };

        html5QrCode.start(
            { facingMode: "environment" },
            config,
            function (decodedText) {
                html5QrCode.stop().then(() => {
                    $('#modalScan').modal('hide');
                    submitAbsen(decodedText);
                });
            }
        ).catch(err => {
             console.log("Scanner start error: ", err);
        });
    }

    function submitAbsen(barcode) {
        const selectedMeetingId = $('#meetingSelect').val();
        if (!selectedMeetingId) {
            alert("Pilih meeting terlebih dahulu!");
            return;
        }

        $.post(baseUrl + 'participant/absen', {
            barcode: barcode,
            meeting_id: selectedMeetingId
        }, function (response) {
            if (response.success) {
                alert("✅ Absen berhasil untuk: " + response.message); 
                loadParticipants();
            } else {
                alert("❌ Gagal: " + (response.message || "Barcode tidak ditemukan!"));
            }
        }, 'json')
        .fail(function() {
            alert("Terjadi kesalahan server saat absen.");
        });
    }

    // Initialize
    loadMeetings();
}
</script>
