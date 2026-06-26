<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ExternalApiStub;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class ExternalApiController extends AbstractController
{
    public function __construct(
        private readonly ExternalApiStub $externalApi,
    ) {
    }

    public function __invoke(): Response
    {
        return new Response($this->externalApi->getResponse());
    }
}
