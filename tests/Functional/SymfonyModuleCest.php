<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Command\ExampleCommand;
use App\Entity\User;
use App\Repository\Model\UserRepositoryInterface;
use App\Repository\UserRepository;
use App\Tests\FunctionalTester;
use Symfony\Component\Security\Core\Security;

final class SymfonyModuleCest
{
    public function amLoggedInAs(FunctionalTester $I)
    {
        $user = $I->grabEntityFromRepository(User::class, [
            'email' => 'john_doe@gmail.com'
        ]);
        $I->amLoggedInAs($user);
        $I->amOnPage('/dashboard');
        $I->see('You are in the Dashboard!');
    }

    public function amOnAction(FunctionalTester $I)
    {
        $I->amOnAction('HomeController');
        $I->see('Hello World!');
    }

    public function amOnRoute(FunctionalTester $I)
    {
        $I->amOnRoute('index');
        $I->see('Hello World!');
    }

    public function dontSeeAuthentication(FunctionalTester $I)
    {
        $I->amOnPage('/dashboard');
        $I->dontSeeAuthentication();
    }

    public function dontSeeEmailIsSent(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->submitSymfonyForm('registration_form', [
            '[email]' => 'john_doe@gmail.com',
            '[plainPassword]' => '123456',
            '[agreeTerms]' => true
        ]);
        //There is already an account with this email
        $I->dontSeeEmailIsSent();
    }

    public function dontSeeFormErrors(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->submitSymfonyForm('registration_form', [
            '[email]' => 'jane_doe@gmail.com',
            '[plainPassword]' => '123456',
            '[agreeTerms]' => true
        ]);
        $I->dontSeeFormErrors();
    }

    public function grabParameter(FunctionalTester $I)
    {
        $locale = (string) $I->grabParameter('locale');
        $I->assertSame('es', $locale);
    }

    public function grabRepository(FunctionalTester $I)
    {
        //With classes
        $repository = $I->grabRepository(User::class);
        $I->assertInstanceOf(UserRepository::class, $repository);

        //With Repository classes
        $repository = $I->grabRepository(UserRepository::class);
        $I->assertInstanceOf(UserRepository::class, $repository);

        //With Entities
        $user = $I->grabEntityFromRepository(User::class, [
            'email' => 'john_doe@gmail.com'
        ]);
        $repository = $I->grabRepository($user);
        $I->assertInstanceOf(UserRepository::class, $repository);

        //With Repository interfaces
        $repository = $I->grabRepository(UserRepositoryInterface::class);
        $I->assertInstanceOf(UserRepository::class, $repository);
    }

    public function grabService(FunctionalTester $I)
    {
        $security = $I->grabService('security.helper');
        $I->assertInstanceOf(Security::class, $security);
    }

    public function logout(FunctionalTester $I)
    {
        $user = $I->grabEntityFromRepository(User::class, [
            'email' => 'john_doe@gmail.com'
        ]);
        $I->amLoggedInAs($user);
        $I->amOnPage('/dashboard');
        $I->see('You are in the Dashboard!');

        $I->logout();
        $I->amOnPage('/dashboard');
        $I->seeInCurrentUrl('login');
        $I->dontSee('You are in the Dashboard!');
    }

    public function runSymfonyConsoleCommand(FunctionalTester $I)
    {
        $output = $I->runSymfonyConsoleCommand(ExampleCommand::getDefaultName());
        $I->assertStringContainsString('Hello world!', $output);
    }

    public function seeAuthentication(FunctionalTester $I)
    {
        $user = $I->grabEntityFromRepository(User::class, [
            'email' => 'john_doe@gmail.com'
        ]);
        $I->amLoggedInAs($user);
        $I->amOnPage('/dashboard');

        $I->seeAuthentication();
    }

    public function seeCurrentActionIs(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->seeCurrentActionIs('HomeController');
    }

    public function seeCurrentRouteIs(FunctionalTester $I)
    {
        $I->amOnPage('/login');
        $I->seeCurrentRouteIs('app_login');
    }

    public function seeEmailIsSent(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->stopFollowingRedirects();
        $I->submitSymfonyForm('registration_form', [
            '[email]' => 'jane_doe@gmail.com',
            '[plainPassword]' => '123456',
            '[agreeTerms]' => true
        ]);
        $I->seeEmailIsSent();
    }

    public function seeFormErrorMessage(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->stopFollowingRedirects();
        $I->submitSymfonyForm('registration_form', [
            '[email]' => 'john_doe@gmail.com',
            '[plainPassword]' => '123456',
            '[agreeTerms]' => true
        ]);
        $I->seeFormErrorMessage('email');
        $I->seeFormErrorMessage('email', 'There is already an account with this email');
    }

    public function seeFormHasErrors(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->submitSymfonyForm('registration_form', [
            '[email]' => 'john_doe@gmail.com',
            '[plainPassword]' => '123456',
            '[agreeTerms]' => true
        ]);
        //There is already an account with this email
        $I->seeFormHasErrors();
    }

    public function seeInCurrentRoute(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->seeInCurrentRoute('index');
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

    public function seeNumRecords(FunctionalTester $I)
    {
        $I->seeNumRecords(1, User::class);
    }

    public function seePageIsAvailable(FunctionalTester $I)
    {
        $I->seePageIsAvailable('/');
    }

    public function seePageRedirectsTo(FunctionalTester $I)
    {
        $I->seePageRedirectsTo('/dashboard', '/login');
    }

    public function seeUserHasRole(FunctionalTester $I)
    {
        $user = $I->grabEntityFromRepository(User::class, [
            'email' => 'john_doe@gmail.com'
        ]);
        $I->amLoggedInAs($user);
        $I->amOnPage('/');

        $I->seeUserHasRole('ROLE_USER');
    }

    public function seeUserPasswordDoesNotNeedRehash(FunctionalTester $I)
    {
        $user = $I->grabEntityFromRepository(User::class, [
            'email' => 'john_doe@gmail.com'
        ]);
        $I->amLoggedInAs($user);
        $I->amOnPage('/dashboard');

        $I->seeUserPasswordDoesNotNeedRehash();
    }

    public function submitSymfonyForm(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->submitSymfonyForm('registration_form', [
            '[email]' => 'jane_doe@gmail.com',
            '[plainPassword]' => '123456',
            '[agreeTerms]' => true
        ]);
        $I->seeInRepository(User::class, [
            'email' => 'jane_doe@gmail.com'
        ]);
    }
}
