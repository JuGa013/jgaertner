<?php

declare(strict_types=1);

namespace App\Domain\Whoami;

use App\Domain\Whoami\Models\Whoami;
use App\Domain\Whoami\Models\Person;

interface WhoamiGateway
{
    public function getWhoami(): ?Whoami;

    public function store(Person $person, string $content): bool;
}
