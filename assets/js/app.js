import '../scss/app.scss';
import $ from 'jquery';
import CommandLine from './components/command-line';

require('bootstrap');

window.customElements.define('command-line', CommandLine);

$('#aside').on('show.bs.collapse', () => {
  const sticky = $('#aside .sidebar-sticky');
  if (sticky.find('command-line').length === 0) {
    sticky.html('<command-line method="POST" action="/api/command"></command-line>');
  }
});
