<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\User;
use App\Tests\Support\FunctionalTester;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class SessionCest
{
    public function amLoggedInAs(FunctionalTester $I)
    {
        $user = $I->grabEntityFromRepository(User::class, [
            'email' => 'john_doe@gmail.com'
        ]);
        $I->amLoggedInAs($user);
        $I->amOnPage('/dashboard');
        $I->seeAuthentication();
        /** @var TokenStorageInterface $tokenStorage */
        $tokenStorage = $I->grabService('security.token_storage');
        $I->assertNotNull($tokenStorage->getToken());
        $I->see('You are in the Dashboard!');
    }

    public function dontSeeInSession(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->dontSeeInSession('_security_main');
    }

    public function goToLogoutPath(FunctionalTester $I)
    {
        $user = $I->grabEntityFromRepository(User::class, [
            'email' => 'john_doe@gmail.com'
        ]);
        $I->amLoggedInAs($user);
        $I->amOnPage('/dashboard');
        $I->see('You are in the Dashboard!');

        $I->goToLogoutPath();
        $I->seeCurrentRouteIs('index');
        $I->dontSeeAuthentication();
    }

    public function logoutProgrammatically(FunctionalTester $I)
    {
        $user = $I->grabEntityFromRepository(User::class, [
            'email' => 'john_doe@gmail.com'
        ]);
        $I->amLoggedInAs($user);
        $I->amOnPage('/dashboard');
        $I->see('You are in the Dashboard!');

        $I->logoutProgrammatically();
        $I->amOnPage('/dashboard');
        $I->seeInCurrentUrl('login');
        $I->dontSeeAuthentication();
    }

    public function seeInSession(FunctionalTester $I)
    {
        $user = $I->grabEntityFromRepository(User::class, [
            'email' => 'john_doe@gmail.com'
        ]);
        $I->amLoggedInAs($user);
        $I->amOnPage('/');

        $I->seeInSession('_security_main');
    }

    public function seeSessionHasValues(FunctionalTester $I)
    {
        $user = $I->grabEntityFromRepository(User::class, [
            'email' => 'john_doe@gmail.com'
        ]);
        $I->amLoggedInAs($user);
        $I->amOnPage('/');

        $I->seeSessionHasValues(['_security_main', '_security_main']);
    }
}
