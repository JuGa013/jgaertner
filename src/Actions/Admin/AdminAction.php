<?php

/**
 * © Infostrates
 * Par Julien
 * Le 15/05/2020
 */

declare(strict_types=1);

namespace App\Actions\Admin;

use App\Responders\AdminResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


final class AdminAction
{
    /** @var AdminResponder */
    private AdminResponder $responder;

    public function __construct(AdminResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function __invoke()
    {
        return new Response('<h1>Admin</h1>');
    }
}
