<?php

declare(strict_types=1);

namespace App\Utils;

use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Header\Headers;
use Symfony\Component\Mime\Message;
use Symfony\Component\Mime\Part\TextPart;

final readonly class Mailer
{
    public function __construct(private MailerInterface $mailer)
    {
    }

    public function sendConfirmationEmail(User $user): TemplatedEmail
    {
        $email = (new TemplatedEmail())
            ->from(new Address('jeison_doe@gmail.com', 'No Reply'))
            ->to(new Address($user->getEmail()))
            ->subject('Account created successfully')
            ->attach('Example attachment')
            ->text('Example text body')
            ->htmlTemplate('emails/registration.html.twig')
            ->context(['user' => $user]);

        $this->mailer->send($email);

        return $email;
    }

    public function sendMessage(User $user): Message
    {
        $message = new Message(
            (new Headers())
                ->addMailboxListHeader('From', [new Address('jeison_doe@gmail.com', 'No Reply')])
                ->addMailboxListHeader('To', [new Address($user->getEmail())])
                ->addTextHeader('Subject', 'Text message'),
            new TextPart('Message body content'),
        );

        $this->mailer->send($message);

        return $message;
    }
}
