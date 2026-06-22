<?php

declare(strict_types=1);

namespace App\Doctrine;

use App\Entity\User;
use App\Utils\Mailer;

/**
 * Issue #90: an email sent from a Doctrine entity listener must be collected by
 * the profiler so that seeEmailIsSent() works. Registered as a lazy
 * `doctrine.orm.entity_listener` and triggered by the dedicated
 * `/create-user-with-confirmation` route.
 *
 * @see https://github.com/Codeception/module-symfony/issues/90
 */
final class SendConfirmationListener
{
    /**
     * Marker address: only this user triggers the mail, so the listener
     * does not interfere with the email counts asserted in MailerCest.
     */
    public const TRIGGER_EMAIL = 'issue90-listener@example.com';

    public function __construct(private readonly Mailer $mailer)
    {
    }

    public function postPersist(User $user): void
    {
        if ($user->getEmail() === self::TRIGGER_EMAIL) {
            $this->mailer->sendConfirmationEmail($user);
        }
    }
}
