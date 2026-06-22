<?php

declare(strict_types=1);

namespace App\Doctrine;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Bundle\SecurityBundle\Security;

/**
 * Issue #34, event-listener path: a Doctrine event listener registered on the
 * connection's event manager (not the ORM entity-listener resolver) must also
 * see the logged-in user. This is the case the issue thread describes as a
 * Doctrine "subscriber". Triggered by the `/create-user` route.
 *
 * @see https://github.com/Codeception/module-symfony/issues/34
 */
#[AsDoctrineListener(event: Events::prePersist)]
final class CurrentUserEventListener
{
    public ?string $currentUserIdentifier = null;

    public function __construct(private readonly Security $security)
    {
    }

    public function prePersist(PrePersistEventArgs $args): void
    {
        if (!$args->getObject() instanceof User) {
            return;
        }

        $this->currentUserIdentifier = $this->security->getUser()?->getUserIdentifier();
    }
}
