<?php

/**
 * © Infostrates
 * Par Julien
 * Le 29/01/2020
 */

declare(strict_types=1);

namespace App\Actions\Admin;

use App\Responders\AdminResponder;
use Symfony\Component\Routing\Annotation\Route;

final class AuthenticateAction
{
    /** @var AdminResponder */
    private AdminResponder $responder;

    public function __construct(AdminResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * @Route("/login", name="user_login")
     */
    public function __invoke()
    {
        return $this->responder->login();
    }
}
