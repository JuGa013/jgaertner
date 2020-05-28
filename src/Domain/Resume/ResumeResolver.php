<?php

/**
 * © Infostrates
 * Par Julien
 * Le 14/05/2020
 */

declare(strict_types=1);

namespace App\Domain\Resume;

use App\Domain\Resume\Entities\Education;
use App\Domain\Resume\Entities\Experience;
use App\Domain\Resume\Entities\Resume;

final class ResumeResolver
{
    public function getResume(): Resume
    {
        $resume = new Resume();
        $resume->educations->add(new Education('RNCP développeur web', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum labore, maiores nisi rerum unde voluptatum. Consectetur, nihil totam? Ab aliquam dolorem explicabo iste nemo nesciunt, nihil placeat quis saepe ut!', 'CNAM PACA', new \DateTimeImmutable('2015-02-20'), new \DateTimeImmutable('2018-06-31')));
        $resume->experiences->add(new Experience('Développeur Symfony', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum labore, maiores nisi rerum unde voluptatum. Consectetur, nihil totam? Ab aliquam dolorem explicabo iste nemo nesciunt, nihil placeat quis saepe ut!', 'Infostrates - Marseille', 'https://www.infostrates.fr', new \DateTimeImmutable('2019-09-02')));

        return $resume;
    }
}
