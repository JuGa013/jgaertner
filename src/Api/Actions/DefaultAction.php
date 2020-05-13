<?php

declare(strict_types=1);

namespace App\Api\Actions;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

final class DefaultAction
{
  /**
  * @Route("/", name="api_default", methods={"GET"})
  */
  public function __invoke()
  {
    return new JsonResponse([
      'version' => '2020-04-26',
    ]);
  }
}
