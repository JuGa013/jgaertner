<?php

declare(strict_types=1);

namespace App\Api\Actions;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\{Request, Response, JsonResponse};
use App\Api\Helpers\RedisReader;

final class RedisAction
{
  private $reader;

  public function __construct(RedisReader $redisReader)
  {
    $this->reader = $redisReader;
  }

  /**
  * @Route("/redis", name="redis_action", methods={"POST"})
  */
  public function __invoke(Request $req)
  {
    $q = $req->request->get('redis_action');
    $res = $this->reader->resolve($q);
    $status = $res ? Response::HTTP_OK : Response::HTTP_NOT_FOUND;

    return new JsonResponse($res, $status);
  }
}
