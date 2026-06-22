<?php

declare(strict_types=1);

namespace App\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;

/**
 * Issue #151: when the EntityManager was persisted across kernel reboots, the
 * listener instance held by Doctrine diverged from the one returned by
 * grabService(), so state recorded during the request was invisible to the test.
 * Both must be the same shared instance. Triggered by the `/create-user` route,
 * which performs exactly one flush.
 *
 * @see https://github.com/Codeception/module-symfony/issues/151
 */
#[AsDoctrineListener(event: Events::onFlush)]
final class FlushCounterListener
{
    public int $flushes = 0;

    public function onFlush(OnFlushEventArgs $args): void
    {
        ++$this->flushes;
    }
}
