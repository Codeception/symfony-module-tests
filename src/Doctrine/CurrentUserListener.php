<?php

declare(strict_types=1);

namespace App\Doctrine;

use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;

/**
 * Issue #34, entity-listener path: the security token must be available inside a
 * Doctrine entity listener, exactly as it is inside a controller. Registered as a
 * lazy `doctrine.orm.entity_listener` in config/services.php and triggered by the
 * `/create-user` route (App\Controller\CreateUserController).
 *
 * @see https://github.com/Codeception/module-symfony/issues/34
 */
final class CurrentUserListener
{
    public ?string $currentUserIdentifier = null;

    public function __construct(private readonly Security $security)
    {
    }

    public function prePersist(User $user): void
    {
        $this->currentUserIdentifier = $this->security->getUser()?->getUserIdentifier();
    }
}
