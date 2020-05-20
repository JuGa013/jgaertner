const commands = [
    'hgetall',
    'hget',
    'smembers',
    'exit',
];

const messages = [
    'Redis command line',
    'Try `smembers {key}`',
    'Try `hgetall {hash}`',
    'Try `hget {hash} {key}`',
    'Exit to leave',
];

export default class Redis {
    get commands() {
        return commands;
    }

    get label() {
        return 'redis-cli >';
    }

    get messages() {
        return messages;
    }

    get action() {
        return '/api/redis';
    }

    get stdin() {
        return `
            <label for="name" class="col-form-label col-3 pr-0">${this.label}</label>
            <input id="command_line_text" type="text" name="command" class="form-control col-9 pl-0" placeholder="" autofocus="autofocus" autocomplete="off"/>
        `;
    }
}
