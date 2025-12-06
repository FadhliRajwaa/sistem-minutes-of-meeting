function loadContent(target) {
    let url = '';
    if (target === 'dashboard') url = '/partials/dashboard-content';
    if (target === 'meeting') url = '/partials/meeting-content';
    $('#content').load(url);
}

$(document).ready(function() {
    loadContent('dashboard');
    $('.menu').click(function(e) {
        e.preventDefault();
        let target = $(this).data('target');
        loadContent(target);
    });
});
