<?php

/**
 * © Infostrates
 * Par Julien
 * Le 14/05/2020
 */

declare(strict_types=1);

namespace App\Domain\Resume\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class Resume
{
    /** @var Collection<Experience> */
    public Collection $experiences;

    /** @var Collection<Education> */
    public Collection $educations;

    public function __construct()
    {
        $this->experiences = new ArrayCollection();
        $this->educations = new ArrayCollection();
    }
}
