<?php

declare(strict_types=1);

namespace App\Front\Actions;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\HttpClient\HttpClient;
use Twig\Environment;

final class IndexAction extends AbstractAction
{
  private $twig;

  public function __construct(Environment $twig)
  {
    $this->twig = $twig;
  }

  /**
  * @Route("/", name="default")
  */
  public function __invoke(Request $req)
  {
    return new Response($this->twig->render('default.html.twig'));
  }
}
