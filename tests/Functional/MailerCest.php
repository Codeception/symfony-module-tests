<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\FunctionalTester;

final class MailerCest
{
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

}
