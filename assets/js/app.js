import '../scss/app.scss';
import $ from 'jquery';
import Redis from './components/redis-form';

require('bootstrap');

window.customElements.define('redis-form', Redis);

$('#aside').on('show.bs.collapse', () => {
  const sticky = $('#aside .sidebar-sticky');
  if (sticky.find('redis-form').length === 0) {
    sticky.html('<redis-form method="POST" action="/api/redis"></redis-form>');
  }
});
