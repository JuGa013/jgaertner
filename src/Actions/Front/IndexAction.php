<?php

declare(strict_types=1);

namespace App\Actions\Front;

use App\Domain\Resume\ResumeResolver;
use App\Domain\Whoami\WhoamiResolver;
use App\Responders\TwigResponder;
use Symfony\Component\Routing\Annotation\Route;

final class IndexAction
{
    /** @var TwigResponder */
    private $responder;

    /** @var ResumeResolver */
    private $resumeResolver;

    /** @var WhoamiResolver */
    private WhoamiResolver $whoamiResolver;

    public function __construct(ResumeResolver $resumeResolver, WhoamiResolver $whoamiResolver, TwigResponder $responder)
    {
        $this->responder = $responder;
        $this->resumeResolver = $resumeResolver;
        $this->whoamiResolver = $whoamiResolver;
    }

    /**
     * @Route("/", name="index")
     */
    public function __invoke()
    {
        $whoami = $this->whoamiResolver->getWhoami();
        $resume = $this->resumeResolver->getResume();

        return $this->responder->home(compact(['resume', 'whoami']));
    }
}
