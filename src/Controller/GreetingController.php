<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Greeting;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class GreetingController extends AbstractController
{
    public function __construct(
        private readonly Greeting $greeting,
    ) {
    }

    public function __invoke(): Response
    {
        return new Response($this->greeting->greet());
    }
}
