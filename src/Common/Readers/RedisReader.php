<?php

declare(strict_types=1);

namespace App\Common\Readers;

final class RedisReader
{
    public function resolve(string $q): ?string
    {
        switch ($q) {
            case 'smembers':
                return 'smembers found';
            case 'hgetall':
                return 'hgetall found';
            case 'hget':
                return 'hget found';
            default:
                return null;
        }
    }
}
