<?php

/**
 * © Infostrates
 * Par Julien
 * Le 28/05/2020
 */

declare(strict_types=1);

namespace App\Domain\Whoami\Models;

use App\Domain\Whoami\Entities\Whoami;

final class WhoamiModel
{
    public ?PersonModel $person = null;

    public string $content = '';

    public static function fromWhoami(Whoami $whoami): self
    {
        $o = new self();

        $o->person = PersonModel::fromPerson($whoami->me);
        $o->content = $whoami->content;

        return $o;
    }
}
