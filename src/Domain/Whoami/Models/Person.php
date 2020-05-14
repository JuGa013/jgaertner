<?php

/**
 * © Infostrates
 * Par Julien
 * Le 14/05/2020
 */

declare(strict_types=1);

namespace App\Domain\Whoami\Models;

final class Person
{
    public string $lastname;

    public string $firstname;

    public string $email;

    public ?string $address;

    public ?string $phone;

    public function __construct(string $lastname, string $firstname, string $email, ?string $address, ?string $phone)
    {
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->address = $address;
        $this->phone = $phone;
    }
}
