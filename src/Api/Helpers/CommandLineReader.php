<?php

/**
 * © Infostrates
 * Par Julien
 * Le 13/05/2020
 */

declare(strict_types=1);

namespace App\Api\Helpers;

final class CommandLineReader
{
    public function resolve (string $q): ?string
    {
        switch ($q) {
            case 'help':
                return 'You can access redis command line with `redis-cli`';
            default:
                return null;
        }
    }
}
