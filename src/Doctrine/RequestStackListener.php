<?php

declare(strict_types=1);

namespace App\Doctrine;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Issue #150: the request_stack injected into a Doctrine listener must expose the
 * current request (and therefore its locale and session), instead of returning
 * null as it did when the EntityManager was persisted across kernel reboots.
 * Triggered by the `/create-user` route.
 *
 * @see https://github.com/Codeception/module-symfony/issues/150
 */
#[AsDoctrineListener(event: Events::prePersist)]
final class RequestStackListener
{
    public bool $hasRequest = false;
    public ?string $currentLocale = null;

    public function __construct(private readonly RequestStack $requestStack)
    {
    }

    public function prePersist(PrePersistEventArgs $args): void
    {
        if (!$args->getObject() instanceof User) {
            return;
        }

        $request = $this->requestStack->getCurrentRequest();
        $this->hasRequest = $request !== null;
        $this->currentLocale = $request?->getLocale();
    }
}
