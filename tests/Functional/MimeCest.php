<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\User;
use App\Tests\Support\FunctionalTester;
use App\Utils\Mailer;

final class MimeCest
{
    public function _before(FunctionalTester $I)
    {
        /** @var Mailer $mailer */
        $mailer = $I->grabService(Mailer::class);
        $mailer->sendConfirmationEmail(
            User::create(
                'jane_doe@gmail.com',
                '123456'
            )
        );
    }

    public function assertEmailAddressContains(FunctionalTester $I)
    {
        $I->assertEmailAddressContains('To', 'jane_doe@gmail.com');
    }

    public function assertEmailAttachmentCount(FunctionalTester $I)
    {
        $I->assertEmailAttachmentCount(1);
    }

    public function assertEmailHasHeader(FunctionalTester $I)
    {
        $I->assertEmailHasHeader('From');
    }

    public function assertEmailHeaderNotSame(FunctionalTester $I)
    {
        $I->assertEmailHeaderNotSame('To', 'john_doe@gmail.com');
    }

    public function assertEmailHeaderSame(FunctionalTester $I)
    {
        $I->assertEmailHeaderSame('To', 'jane_doe@gmail.com');
    }

    public function assertEmailHtmlBodyContains(FunctionalTester $I)
    {
        $I->assertEmailHtmlBodyContains('Example Email');
    }

    public function assertEmailHtmlBodyNotContains(FunctionalTester $I)
    {
        $I->assertEmailHtmlBodyNotContains('jane_doe@gmail.com');
    }

    public function assertEmailNotHasHeader(FunctionalTester $I)
    {
        $I->assertEmailNotHasHeader('Bcc');
    }

    public function assertEmailTextBodyContains(FunctionalTester $I)
    {
        $I->assertEmailTextBodyContains('Example text body');
    }

    public function assertEmailTextBodyNotContains(FunctionalTester $I)
    {
        $I->assertEmailTextBodyNotContains('Example Email');
    }
}
