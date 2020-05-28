<?php

/**
 * © Infostrates
 * Par Julien
 * Le 14/05/2020
 */

declare(strict_types=1);

namespace App\Domain\Whoami\Entities;

final class Whoami
{
    public Person $me;

    public string $content;

    public function __construct(Person $me, string $content)
    {
        $this->me = $me;
        $this->content = $content;
    }
}
