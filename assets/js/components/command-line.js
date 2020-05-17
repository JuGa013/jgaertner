import Redis from "./redis";

const messages = [
    'Linux like command line',
    'Type `help` for more information'
];

export default class CommandLine extends HTMLElement {
    constructor() {
        super();
        this.form = null;
        this.state = null;
        this.input = null;
        this.result = null;

    }

    connectedCallback() {
        this.render();

        if (!this.hasAttribute('method')) {
            this.setAttribute('method', 'GET');
        }
    }

    get html() {
        let res = '';
        if (this.result !== null) {
            res = this.result.innerHTML;
        }
        let out = `
          <section class="m-0">
              <form>
                <div class="form-group d-flex">`;
        if (this.state !== null) {
            out += `
                        <label for="name" class="col-form-label col-3 pr-0">${this.state.label}</label>
                        <input id="command_line_text" type="text" name="command" class="form-control col-9 pl-0" placeholder="" autofocus="autofocus" autocomplete="off"/>
                    `;
        } else {
            out += `<input id="command_line_text" type="text" name="command" class="form-control col-12" placeholder="" autofocus="autofocus" autocomplete="off"/>`;
        }
        out += `
              </div>
                  <input type="submit" value="Send" class="d-none" />
                </form>
              <section id="redis-result" class=""><article class="result">${res}</article></section>
          </section>
      `;

        return out
    }

    get action() {
        if (this.state !== null) {
            return this.state.action;
        }
        return this.getAttribute('action');
    }

    get method() {
        return this.getAttribute('method');
    }

    get search() {
        return this.getAttribute('search');
    }

    set search(value) {
        this.setAttribute('search', value);
    }

    get count() {
        if (!this.input.hasAttribute('count')) {
            this.count = 0;
        }

        return parseInt(this.input.getAttribute('count'));
    }

    set count(value) {
        this.input.setAttribute('count', value);
    }

    render() {
        if (this.form !== null) {
            this.form.reset();
        }
        this.innerHTML = this.html;
        this.form = this.querySelector('form');
        this.input = this.form.querySelector('input[name="command"]');
        this.result = this.querySelector('#redis-result .result');
        this.loopPlaceholder();
        this.changePlaceholder('');

        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            switch (this.input.value.trim().toLowerCase()) {
                case 'exit':
                    this.exit();
                    break;
                case 'redis-cli':
                    this.state = new Redis();
                    this.render();
                    break;
                default :
                    this.submitForm();
                    break;
            }
        });
        setTimeout(() => {
            document.getElementById('command_line_text').focus();
        }, 250);
    }

    submitForm() {
        const fetchData = new FormData(this.form);
        const val = this.input.value.trim().toLowerCase();
        this.form.reset();

        if (!val.length > 0) {
            return;
        }
        if (this.search === val) {
            return;
        }
        const options = {
            method: this.method,
            body: fetchData
        }
        this.fetchForm(val, options);
    }

    async fetchForm(val, options) {
        this.changePlaceholder(val)

        fetch(this.action, options)
            .then(res => {
                if (res.status === 200) {
                    return res.json();
                } else {
                    return Promise.reject(new Error(val));
                }
            })
            .then(res => {
                    this.search = val;
                    if (res.startsWith('#') && document.getElementById(res.substr(1))) {
                        document.getElementById(res.substr(1)).scrollIntoView({behavior: "smooth", inline: "nearest"});
                    } else {
                        this.result.innerHTML += res + `<br>`
                    }
                }
            )
            .catch(err => this.changePlaceholder(`Unknown parameter "${err.message}". Try help for more information`));
    }

    loopPlaceholder() {
        let mess = messages;
        if (this.state !== null) {
            mess = this.state.messages;
        }
        this.input.setAttribute('placeholder', mess[this.count]);
        this.count = this.count + 1;
        if (this.count === mess.length) {
            this.count = 0;
        }
    }

    changePlaceholder(value) {
        if (this.interval) {
            clearInterval(this.interval);
        }
        this.interval = setInterval(this.loopPlaceholder.bind(this), 5000);
        if (value.length > 0) {
            this.input.setAttribute('placeholder', value);
        }
    }

    exit() {
        if (this.state !== null) {
            this.state = null;
            this.render();
        } else {
            document.querySelector('[data-target="#aside"]').click();
            this.form.reset();
        }
    }
}
