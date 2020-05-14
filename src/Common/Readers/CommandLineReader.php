<?php

/**
 * © Infostrates
 * Par Julien
 * Le 13/05/2020
 */

declare(strict_types=1);

namespace App\Common\Readers;

final class CommandLineReader
{
    public function resolve (string $q): ?string
    {
        switch ($q) {
            case 'date':
                return (new \DateTimeImmutable())->format('Y-m-d H:i:s');
            case 'help':
                return 'You can access redis command line with `redis-cli`';
            case 'whoami':
            case 'resume':
            case 'fun':
            case 'projects':
                return '#'.$q;
            default:
                return null;
        }
    }
}
