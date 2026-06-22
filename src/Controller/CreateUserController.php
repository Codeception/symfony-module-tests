<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Persists a user (one prePersist + one flush) so the Doctrine listeners under
 * test fire within a real request. Shared trigger for issues #34, #150 and #151.
 */
final class CreateUserController extends AbstractController
{
    public function __invoke(EntityManagerInterface $em): Response
    {
        $em->persist(User::create('jane_doe@gmail.com', '123456'));
        $em->flush();

        return new Response('Created');
    }
}
