<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\InMemory;

use App\Domain\Whoami\WhoamiGateway;
use App\Domain\Whoami\Models\Whoami;
use App\Domain\Whoami\Models\Person;
use Symfony\Component\Serializer\SerializerInterface;

final class WhoamiRepository implements WhoamiGateway
{
    private string $path;

    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer, $dbpath)
    {
        $this->path = $dbpath . 'whoami/';
        $this->serializer = $serializer;
    }

    public function getWhoami(): ?Whoami
    {
        // TODO : récupérer via le repo, return 404 si absent
        if (!file_exists($this->path . 'whoami.json') || !file_exists($this->path . 'me.json')) {
            return null;
        }
        $me = $this->serializer->deserialize(file_get_contents($this->path . 'me.json'), Person::class, 'json');
        $content = file_get_contents($this->path . 'whoami.json');

        $whoami = new Whoami($me, $content);

        return $whoami;
    }

    public function store(Person $person, string $content): bool
    {
        if (!file_exists($this->path . 'whoami.json') && !file_exists($this->path . 'me.json')) {
            mkdir($this->path);
        }
        $person->id = uniqid();
        //TODO : check le retour de file_put_contents pour return true/false
        file_put_contents($this->path . 'me.json', $this->serializer->serialize($person, 'json'));
        $whoami = ['person' => $person->id, 'content' => $content];
        file_put_contents($this->path . 'whoami.json', json_encode($whoami));

        return true;
    }
}
