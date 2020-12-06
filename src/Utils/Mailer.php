<?php

declare(strict_types=1);

namespace App\Utils;

use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

final class Mailer
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendConfirmationEmail(User $user): TemplatedEmail
    {
        $email = (new TemplatedEmail())
            ->from('jeison_doe@gmail.com')
            ->to(new Address($user->getEmail()))
            ->subject('Account created successfully')
            ->htmlTemplate('emails/registration.html.twig')
            ->context(['user' => $user]);

        $this->mailer->send($email);

        return $email;
    }
}
