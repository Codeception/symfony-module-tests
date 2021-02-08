<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\User;
use App\Tests\FunctionalTester;

final class BrowserCest
{
    public function seePageIsAvailable(FunctionalTester $I)
    {
        $I->seePageIsAvailable('/');
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
