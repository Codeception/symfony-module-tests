<?php

declare(strict_types=1);

namespace App\Controller;

use App\Message\SendWelcomeMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

final class DispatchMessageController extends AbstractController
{
    public function __construct(
        private readonly MessageBusInterface $bus,
    ) {
    }

    public function __invoke(): Response
    {
        $this->bus->dispatch(new SendWelcomeMessage('jane_doe@example.com'));

        return $this->json(['message' => 'Message dispatched']);
    }
}
