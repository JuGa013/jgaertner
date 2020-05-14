<?php

/**
 * © Infostrates
 * Par Julien
 * Le 14/05/2020
 */

declare(strict_types=1);

namespace App\Domain\Resume\Models;

final class Experience
{
    public string $jobTitle;

    public string $description;

    public string $location;

    public ?string $website;

    public \DateTimeInterface $start;

    public ?\DateTimeInterface $end;

    public function __construct(string $jobTitle, string $description, string $location, ?string $website, \DateTimeInterface $start, ?\DateTimeInterface $end = null)
    {
        $this->jobTitle = $jobTitle;
        $this->description = $description;
        $this->location = $location;
        $this->website = $website;
        $this->start = $start;
        $this->end = $end;
    }
}
