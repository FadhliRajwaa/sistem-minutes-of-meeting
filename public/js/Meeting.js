function loadMeetings() {
    $.get('/meetings/list', function(res) {
        let rows = '';
        res.forEach(m => {
            rows += `<tr>
                <td>${m.kegiatan}</td>
                <td>${m.waktu}</td>
                <td>${m.tempat}</td>
                <td>${m.status}</td>
            </tr>`;
        });
        $('#meetingTable').html(rows);
    });
}

$(document).ready(function() {
    loadMeetings();

    $(document).on('click', '#btnTambahRapat', function() {
        $('#modalTambah').modal('show');
    });

    $(document).on('click', '#simpanRapat', function() {
        let data = {
            kegiatan: $('#kegiatan').val(),
            waktu: $('#waktu').val(),
            tempat: $('#tempat').val()
        };
        $.post('/meetings/save', data, function() {
            $('#modalTambah').modal('hide');
            loadMeetings();
        });
    });
});
