import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    function copyLink(url) {
        navigator.clipboard.writeText(url);
    }