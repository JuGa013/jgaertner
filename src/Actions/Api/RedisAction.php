<?php

declare(strict_types=1);

namespace App\Actions\Api;

use App\Responders\JsonResponder;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Common\Readers\RedisReader;

final class RedisAction
{
    /** @var RedisReader */
    private $reader;

    /** @var JsonResponder */
    private $responder;

    public function __construct(RedisReader $redisReader, JsonResponder $responder)
    {
        $this->reader = $redisReader;
        $this->responder = $responder;
    }

    /**
     * @Route("/redis", name="redis_action", methods={"POST"})
     */
    public function __invoke(Request $req)
    {
        $q = $req->request->get('command');

        return $this->responder->response($this->reader->resolve($q));
    }
}
