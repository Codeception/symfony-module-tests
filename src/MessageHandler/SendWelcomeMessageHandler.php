<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\SendWelcomeMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class SendWelcomeMessageHandler
{
    public function __invoke(SendWelcomeMessage $message): void
    {
    }
}
