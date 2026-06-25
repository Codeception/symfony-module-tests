<?php

declare(strict_types=1);

namespace App\Message;

final class SendWelcomeMessage
{
    public function __construct(
        private readonly string $email = '',
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
