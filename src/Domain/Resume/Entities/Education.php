<?php

/**
 * © Infostrates
 * Par Julien
 * Le 14/05/2020
 */

declare(strict_types=1);

namespace App\Domain\Resume\Entities;

final class Education
{
    public string $course;

    public string $description;

    public string $location;

    public \DateTimeInterface $start;

    public ?\DateTimeInterface $end;

    public function __construct(string $course, string $description, string $location, \DateTimeInterface $start, ?\DateTimeInterface $end)
    {
        $this->course = $course;
        $this->description = $description;
        $this->location = $location;
        $this->start = $start;
        $this->end = $end;
    }
}
