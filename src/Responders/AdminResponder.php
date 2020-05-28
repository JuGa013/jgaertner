<?php

/**
 * © Infostrates
 * Par Julien
 * Le 15/05/2020
 */

declare(strict_types=1);

namespace App\Responders;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class AdminResponder
{
    /** @var AuthenticationUtils */
    private $authenticationUtils;

    /** @var TwigResponder */
    private TwigResponder $twigResponder;

    public function __construct(AuthenticationUtils $authenticationUtils, TwigResponder $twigResponder)
    {
        $this->authenticationUtils = $authenticationUtils;
        $this->twigResponder = $twigResponder;
    }

    public function login()
    {
        $error = $this->authenticationUtils->getLastAuthenticationError();
        $lastUsername = $this->authenticationUtils->getLastUsername();

        return $this->twigResponder->__invoke('security/login.html.twig', ['error' => $error, 'last_username' => $lastUsername]);
    }

    public function whoami(FormInterface $form)
    {
        return $this->twigResponder->__invoke('admin/whoami/new.html.twig', ['form' => $form->createView()]);
    }
}
