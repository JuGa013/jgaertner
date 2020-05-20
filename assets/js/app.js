import '../scss/app.scss';
import '@fortawesome/fontawesome-free/js/fontawesome'
import '@fortawesome/fontawesome-free/js/solid'
import '@fortawesome/fontawesome-free/js/regular'
import '@fortawesome/fontawesome-free/js/brands'
import $ from 'jquery';
import CommandLine from './components/command-line';

require('bootstrap');

window.customElements.define('command-line', CommandLine);

$('#aside').on('show.bs.collapse', () => {
    const sticky = $('#aside .sidebar-sticky');
    if (sticky.find('command-line').length === 0) {
        sticky.html('<command-line id="stdin" method="POST" action="/api/command"></command-line>');
    }
}).on('shown.bs.collapse', () => {
    const el = $('#command_line_text');
    el.focus();
});

$(document).on('command-line:exit', () => {
    $('#aside').collapse('hide');
});
