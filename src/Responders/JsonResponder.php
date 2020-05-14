<?php

/**
 * © Infostrates
 * Par Julien
 * Le 14/05/2020
 */

declare(strict_types=1);

namespace App\Responders;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class JsonResponder
{
    public function __invoke($data = null, $status = Response::HTTP_OK)
    {
        return new JsonResponse($data, $status);
    }

    public function response($data = null)
    {
        $status = $data ? Response::HTTP_OK : Response::HTTP_NOT_FOUND;

        return $this($data, $status);
    }
}
