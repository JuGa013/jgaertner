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
}
