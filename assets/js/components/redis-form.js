import $ from 'jquery';

const messages = [
  'Linux like command line',
  'Type help for more information'
];

export default class Redis extends HTMLElement {
  constructor() {
    super();
    this.innerHTML = this.html;
  }

  connectedCallback () {
    this.form = this.querySelector('form');
    this.input = this.form.querySelector('input[name="redis_action"]');
    this.result = this.querySelector('#redis-result .result');

    if (!this.hasAttribute('action')) {
      this.setAttribute('action', 'GET');
    }
    this.form.addEventListener('submit', (e) => {
      e.preventDefault();
      this.sendForm();
    });
    this.loopPlaceholder();
    this.interval = setInterval(this.loopPlaceholder.bind(this), 5000);
  }

  get html () {
    return `
      <section class="row">
        <form class="col-6 col-md-12">
          <input type="text" name="redis_action" class="form-control" placeholder="" autofocus="on" autocomplete="off"/>
          <input type="submit" value="Send" class="d-none" />
        </form>

        <section id="redis-result" class="col-6 col-md-12"><article class="result"></article></section>
      </section>
      `;
  }

  get action () {
    return this.getAttribute('action');
  }

  get method () {
    return this.getAttribute('method');
  }

  get search () {
    return this.getAttribute('search');
  }

  set search (value) {
    this.setAttribute('search', value);
  }

  get count () {
    if (!this.input.hasAttribute('count')) {
      this.count = 0;
    }

    return parseInt(this.input.getAttribute('count'));
  }

  set count (value) {
    this.input.setAttribute('count', value);
  }

  sendForm () {
    const data = new URLSearchParams(Array.from(new FormData(this.form))).toString();
    const val = this.input.value.trim()
    this.form.reset();

    if (!val.length > 0) {
      return;
    }
    if (this.search === val) {
      return;
    }
    const options = {
      method: this.method,
      body: JSON.stringify(data)
    }
    fetch(this.action, options).then(res => res.json()).then(json => console.log(json))

    $.ajax({
      url: this.action,
      method: this.method,
      data,
      success: (res) => {
        this.changePlaceholder(val);
        this.search = val;
        this.result.innerHTML += JSON.stringify(res) + `<br>`;
      },
      error: (err) => {
        this.changePlaceholder(`Unknown parameter "${val}". Try help for more information`);
      }
    });
  }

  loopPlaceholder() {
    this.input.setAttribute('placeholder', messages[this.count]);
    this.count = this.count + 1;
    if (this.count === messages.length) {
      this.count = 0;
    }
  }

  changePlaceholder (value) {
    clearInterval(this.interval);
    this.interval = setInterval(this.loopPlaceholder.bind(this), 5000);
    this.input.setAttribute('placeholder', value);
  }
}
