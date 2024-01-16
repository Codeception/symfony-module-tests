<?php

declare(strict_types=1);

namespace App\Doctrine;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserHashPasswordListener
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function prePersist(User $user): void
    {
        if (!$this->hasher->needsRehash($user)) {
            return;
        }

        $user->setPassword(
            $this->hasher->hashPassword(
                $user, $user->getPassword()
            )
        );
    }
}
