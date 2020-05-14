<?php

/**
 * © Infostrates
 * Par Julien
 * Le 14/05/2020
 */

declare(strict_types=1);

namespace App\Responders;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class TwigResponder
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke(string $template, array $params = [])
    {
        return new Response($this->twig->render($template, $params));
    }

    public function home(array $params)
    {
        return $this('default.html.twig', $params);
    }
}
