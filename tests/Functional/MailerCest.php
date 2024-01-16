<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;

final class MailerCest
{
    public function dontSeeEmailIsSent(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->stopFollowingRedirects();
        $I->submitSymfonyForm('registration_form', [
            '[email]' => 'john_doe@gmail.com',
            '[plainPassword]' => '123456',
            '[agreeTerms]' => true
        ]);
        //There is already an account with this email
        $I->dontSeeEmailIsSent();
    }

    public function grabLastSentEmail(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->stopFollowingRedirects();
        $I->submitSymfonyForm('registration_form', [
            '[email]' => 'jane_doe@gmail.com',
            '[plainPassword]' => '123456',
            '[agreeTerms]' => true
        ]);
        $email = $I->grabLastSentEmail();
        $address = $email->getTo()[0];
        $I->assertSame('jane_doe@gmail.com', $address->getAddress());
    }

    public function grabSentEmails(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->stopFollowingRedirects();
        $I->submitSymfonyForm('registration_form', [
            '[email]' => 'jane_doe@gmail.com',
            '[plainPassword]' => '123456',
            '[agreeTerms]' => true
        ]);
        $emails = $I->grabSentEmails();
        $address = $emails[0]->getTo()[0];
        $I->assertSame('jane_doe@gmail.com', $address->getAddress());
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
