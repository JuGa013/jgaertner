<?php

declare(strict_types=1);

namespace App\Domain\Whoami;

use App\Domain\Whoami\Models\Whoami;

final class WhoamiResolver
{
    private WhoamiGateway $gateway;

    public function __construct(WhoamiGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function getWhoami(): ?Whoami
    {
        $whoami = $this->gateway->getWhoami();
        //$this->gateway->store($whoami->me, $whoami->content);

        return $whoami;
    }
}
