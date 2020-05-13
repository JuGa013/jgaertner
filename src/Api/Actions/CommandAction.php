<?php

declare(strict_types=1);

namespace App\Api\Actions;

use App\Api\Helpers\CommandLineReader;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\{Request, Response, JsonResponse};

final class CommandAction
{
    private $reader;

    public function __construct(CommandLineReader $redisReader)
    {
        $this->reader = $redisReader;
    }

    /**
     * @Route("/command", name="command_action", methods={"POST"})
     */
    public function __invoke(Request $req)
    {
        $q = $req->request->get('command');
        $res = $this->reader->resolve($q);
        $status = $res ? Response::HTTP_OK : Response::HTTP_NOT_FOUND;

        return new JsonResponse($res, $status);
    }
}
