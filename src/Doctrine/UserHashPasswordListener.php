<?php

declare(strict_types=1);

namespace App\Doctrine;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserHashPasswordListener
{
    /** @var UserPasswordEncoderInterface */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->encoder = $userPasswordEncoder;
    }

    public function prePersist(User $user): void
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
