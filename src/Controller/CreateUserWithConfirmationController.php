<?php

declare(strict_types=1);

namespace App\Controller;

use App\Doctrine\SendConfirmationListener;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Persists the marker user that makes App\Doctrine\SendConfirmationListener send
 * a confirmation email from inside a Doctrine entity listener. Trigger for #90.
 */
final class CreateUserWithConfirmationController extends AbstractController
{
    public function __invoke(EntityManagerInterface $em): Response
    {
        $em->persist(User::create(SendConfirmationListener::TRIGGER_EMAIL, '123456'));
        $em->flush();

        return new Response('Created');
    }
}
