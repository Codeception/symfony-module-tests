<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;

final class MailerCest
{
    public function dontSeeEmailIsSent(FunctionalTester $I)
    {
        $I->registerUser('john_doe@gmail.com', '123456', followRedirects: false);
        // There is already an account with this email
        $I->dontSeeEmailIsSent();
    }

    public function grabLastSentEmail(FunctionalTester $I)
    {
        $I->registerUser('jane_doe@gmail.com', '123456', followRedirects: false);
        $email = $I->grabLastSentEmail();
        $address = $email->getTo()[0];
        $I->assertSame('jane_doe@gmail.com', $address->getAddress());
    }

    public function grabSentEmails(FunctionalTester $I)
    {
        $I->registerUser('jane_doe@gmail.com', '123456', followRedirects: false);
        $emails = $I->grabSentEmails();
        $address = $emails[0]->getTo()[0];
        $I->assertSame('jane_doe@gmail.com', $address->getAddress());
    }

    public function seeEmailIsSent(FunctionalTester $I)
    {
        $I->registerUser('jane_doe@gmail.com', '123456', followRedirects: false);
        $I->seeEmailIsSent();
    }
}
