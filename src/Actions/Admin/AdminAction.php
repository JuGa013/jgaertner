<?php

declare(strict_types=1);

namespace App\Actions\Admin;

use App\Domain\Whoami\WhoamiResolver;
use App\Responders\AdminResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


final class AdminAction
{
    /** @var AdminResponder */
    private AdminResponder $responder;

    /** @var WhoamiResolver */
    private WhoamiResolver $whoamiResolver;

    public function __construct(AdminResponder $responder, WhoamiResolver $whoamiResolver)
    {
        $this->responder = $responder;
        $this->whoamiResolver = $whoamiResolver;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function __invoke(Request $request)
    {
        $form = $this->whoamiResolver->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->whoamiResolver->save($form->getData());
        }

        return $this->responder->whoami($form);
    }
}
