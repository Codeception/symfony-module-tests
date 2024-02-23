<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\User;
use App\Tests\Support\FunctionalTester;

final class BrowserCest
{
    public function seePageIsAvailable(FunctionalTester $I)
    {
        // With url parameter
        $I->seePageIsAvailable('/login');

        // Without url parameter
        $I->amOnPage('/register');
        $I->seePageIsAvailable();
    }

    public function seePageRedirectsTo(FunctionalTester $I)
    {
        $I->seePageRedirectsTo('/dashboard', '/login');
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
