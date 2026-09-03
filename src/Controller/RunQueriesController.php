<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class RunQueriesController extends AbstractController
{
    public function __construct(
        private readonly UserRepository $users,
    ) {
    }

    public function __invoke(): Response
    {
        $this->users->findAll();
        $this->users->getByEmail('john_doe@gmail.com');

        return new Response('Queries executed.');
    }
}
