<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\InMemory;

use App\Domain\Whoami\WhoamiGateway;
use App\Domain\Whoami\Entities\Whoami;
use App\Domain\Whoami\Entities\Person;
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
        if (!file_exists($this->path)) {
            return null;
        }
        try {
            $me = $this->serializer->deserialize(file_get_contents($this->path . 'me.json'), Person::class, 'json');
            if (!$me instanceof Person) {
                return null;
            }
            $content = json_decode(file_get_contents($this->path . 'whoami.json'));
            if ($content->person !== $me->id) {
                return null;
            }

            return new Whoami($me, $content->content);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function store(Person $person, string $content): bool
    {
        if (!file_exists($this->path)) {
            mkdir($this->path, 0755, true);
        }
        $person->id = uniqid();
        //TODO : check le retour de file_put_contents pour return true/false
        file_put_contents($this->path . 'me.json', $this->serializer->serialize($person, 'json'));
        $whoami = ['person' => $person->id, 'content' => $content];
        file_put_contents($this->path . 'whoami.json', json_encode($whoami));

        return true;
    }
}
