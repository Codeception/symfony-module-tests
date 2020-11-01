<?php

declare(strict_types=1);

namespace App\Doctrine;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserHashPasswordListener
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function prePersist(User $user)
    {
        if (!$this->encoder->needsRehash($user)) {
            return;
        }

        $user->setPassword(
            $this->encoder->encodePassword(
                $user, $user->getPassword()
            )
        );
    }
}
