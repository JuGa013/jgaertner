<?php

declare(strict_types=1);

namespace App\Domain\Whoami;

use App\Common\MediaPersister;
use App\Domain\Whoami\Entities\Person;
use App\Domain\Whoami\Entities\Whoami;
use App\Domain\Whoami\Forms\WhoamiType;
use App\Domain\Whoami\Models\WhoamiModel;
use Symfony\Component\Form\FormFactoryInterface;

final class WhoamiResolver
{
    private WhoamiGateway $gateway;

    private FormFactoryInterface $formFactory;

    private MediaPersister $mediaPersister;

    public function __construct(WhoamiGateway $gateway, FormFactoryInterface $formFactory, MediaPersister $mediaPersister)
    {
        $this->gateway = $gateway;
        $this->formFactory = $formFactory;
        $this->mediaPersister = $mediaPersister;
    }

    public function getForm()
    {
        $model = new WhoamiModel();

        $whoami = $this->getWhoami();
        if ($whoami instanceof Whoami) {
            $model = WhoamiModel::fromWhoami($whoami);
        }

        return $this->formFactory->create(WhoamiType::class, $model);
    }

    public function getWhoami(): ?Whoami
    {
        $whoami = $this->gateway->getWhoami();
        $whoami->image = $this->mediaPersister->getPersonImage($whoami->me);

        return $whoami;
    }

    public function save(WhoamiModel $model)
    {
        $person = $model->person;
        $me = new Person($person->lastname, $person->firstname, $person->birthday, $person->email, $person->address, $person->phone);
        $whoami = new Whoami($me, $model->content);
        $this->gateway->store($whoami->me, $whoami->content);
        $this->mediaPersister->storePersonImage($me, $person->image);
    }
}
