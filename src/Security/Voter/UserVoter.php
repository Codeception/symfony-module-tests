<?php

declare(strict_types=1);

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

use function in_array;

/**
 * Grants USER_EDIT only on the account of the authenticated user.
 *
 * Implements VoterInterface instead of extending Voter, whose abstract
 * voteOnAttribute() signature is not the same across the Symfony versions
 * covered by the branches of this repository.
 */
final class UserVoter implements VoterInterface
{
    public const EDIT = 'USER_EDIT';

    /**
     * @param mixed[] $attributes
     */
    public function vote(TokenInterface $token, mixed $subject, array $attributes, mixed ...$args): int
    {
        if (!in_array(self::EDIT, $attributes, true) || !$subject instanceof User) {
            return self::ACCESS_ABSTAIN;
        }

        $user = $token->getUser();

        return $user instanceof User && $user->getUserIdentifier() === $subject->getUserIdentifier()
            ? self::ACCESS_GRANTED
            : self::ACCESS_DENIED;
    }
}
