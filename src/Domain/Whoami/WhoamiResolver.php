<?php

declare(strict_types=1);

namespace App\Domain\Whoami;

use App\Domain\Whoami\Entities\Person;
use App\Domain\Whoami\Entities\Whoami;
use App\Domain\Whoami\Forms\WhoamiType;
use App\Domain\Whoami\Models\WhoamiModel;
use Symfony\Component\Form\FormFactoryInterface;

final class WhoamiResolver
{
    private WhoamiGateway $gateway;

    private FormFactoryInterface $formFactory;

    public function __construct(WhoamiGateway $gateway, FormFactoryInterface $formFactory)
    {
        $this->gateway = $gateway;
        $this->formFactory = $formFactory;
    }

    public function getForm()
    {
        return $this->formFactory->create(WhoamiType::class, new WhoamiModel());
    }

    public function getWhoami(): ?Whoami
    {
        $whoami = $this->gateway->getWhoami();

        return $whoami;
    }

    public function save(WhoamiModel $model)
    {
        $person = $model->person;
        $me = new Person($person->lastname, $person->firstname, $person->birthday, $person->email, $person->address, $person->phone);
        $whoami = new Whoami($me, $model->content);
        $this->gateway->store($whoami->me, $whoami->content);
    }
}
