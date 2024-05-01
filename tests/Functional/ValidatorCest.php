<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\User;
use App\Tests\Support\FunctionalTester;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

final class ValidatorCest
{
    public function dontSeeViolatedConstraint(FunctionalTester $I)
    {
        $user = User::create('test@example.com', 'password', ['ROLE_ADMIN']);
        $I->dontSeeViolatedConstraint($user);
        $I->dontSeeViolatedConstraint($user, 'email');
        $I->dontSeeViolatedConstraint($user, 'email', Email::class);

        $user->setEmail('invalid_email');
        $I->dontSeeViolatedConstraint($user, 'password');

        $user->setEmail('test@example.com');
        $user->setPassword('weak');
        $I->dontSeeViolatedConstraint($user, 'email');
        $I->dontSeeViolatedConstraint($user, 'password', NotBlank::class);
    }

    public function seeViolatedConstraint(FunctionalTester $I)
    {
        $user = User::create('invalid_email', 'password', ['ROLE_ADMIN']);
        $I->seeViolatedConstraint($user);
        $I->seeViolatedConstraint($user, 'email');

        $user->setEmail('test@example.com');
        $user->setPassword('weak');
        $I->seeViolatedConstraint($user);
        $I->seeViolatedConstraint($user, 'password');
        $I->seeViolatedConstraint($user, 'password', Length::class);
    }

    public function seeViolatedConstraintCount(FunctionalTester $I)
    {
        $user = User::create('invalid_email', 'weak', ['ROLE_ADMIN']);
        $I->seeViolatedConstraintsCount(2, $user);
        $I->seeViolatedConstraintsCount(1, $user, 'email');
        $user->setEmail('test@example.com');
        $I->seeViolatedConstraintsCount(1, $user);
        $I->seeViolatedConstraintsCount(0, $user, 'email');
    }

    public function seeViolatedConstraintMessageContains(FunctionalTester $I)
    {
        $user = User::create('invalid_email', 'weak', ['ROLE_ADMIN']);
        $I->seeViolatedConstraintMessage('is not a valid email', $user, 'email');
        $user->setEmail('');
        $I->seeViolatedConstraintMessage('should not be blank', $user, 'email');
        $I->seeViolatedConstraintMessage('This value is too short', $user, 'email');
    }
}
