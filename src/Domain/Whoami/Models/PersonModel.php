<?php

/**
 * © Infostrates
 * Par Julien
 * Le 28/05/2020
 */

declare(strict_types=1);

namespace App\Domain\Whoami\Models;

use App\Domain\Whoami\Entities\Person;

final class PersonModel
{
    public string $lastname = '';

    public string $firstname = '';

    public ?\DateTimeInterface $birthday = null;

    public string $email = '';

    public ?string $address = null;

    public ?string $phone = null;

    public static function fromPerson(Person $person): self
    {
        $o = new self();

        $o->lastname = $person->lastname;
        $o->firstname = $person->firstname;
        $o->birthday = $person->birthday;
        $o->email = $person->email;
        $o->address = $person->address;
        $o->phone = $person->phone;

        return $o;
    }
}
