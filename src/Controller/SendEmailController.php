<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Utils\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class SendEmailController extends AbstractController
{
    public function __construct(
        private readonly Mailer $mailer,
    ) {
    }

    public function __invoke(): Response
    {
        $user = new User();
        $user->setEmail('jane_doe@example.com');

        $this->mailer->sendConfirmationEmail($user);

        return new JsonResponse(['message' => 'Email sent successfully'], Response::HTTP_OK);
    }
}
