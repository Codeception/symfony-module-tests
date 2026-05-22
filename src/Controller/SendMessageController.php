<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Utils\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class SendMessageController extends AbstractController
{
    public function __construct(
        private readonly Mailer $mailer,
    ) {
    }

    public function __invoke(): Response
    {
        $this->mailer->sendMessage((new User())->setEmail('jane_doe@example.com'));

        return $this->json(['message' => 'Message sent successfully']);
    }
}
