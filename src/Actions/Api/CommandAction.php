<?php

declare(strict_types=1);

namespace App\Actions\Api;

use App\Common\Readers\CommandLineReader;
use App\Responders\JsonResponder;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

final class CommandAction
{
    /** @var CommandLineReader */
    private $reader;

    /** @var JsonResponder */
    private $responder;

    public function __construct(CommandLineReader $redisReader, JsonResponder $responder)
    {
        $this->reader = $redisReader;
        $this->responder = $responder;
    }

    /**
     * @Route("/command", name="command_action", methods={"POST"})
     */
    public function __invoke(Request $req)
    {
        $q = $req->request->get('command');

        return $this->responder->response($this->reader->resolve($q));
    }
}
