<?php

declare(strict_types=1);

namespace App\Utils;

use App\Entity\User;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;

final readonly class Notifier
{
    public function __construct(private NotifierInterface $notifier)
    {
    }

    public function sendConfirmationNotification(User $user): Notification
    {
        $notification = (new Notification('Account created!', ['chat']))
            ->content("Account for {$user->getEmail()} created successfully");

        $recipient = new Recipient($user->getEmail());

        $this->notifier->send($notification, $recipient);

        return $notification;
    }
}
