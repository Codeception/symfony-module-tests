<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;

final class MimeCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/send-email');
        $I->seeResponseCodeIs(200);
    }

    public function assertEmailAddressContains(FunctionalTester $I)
    {
        $I->assertEmailAddressContains('To', 'jane_doe@example.com');
    }

    public function assertEmailAddressNotContains(FunctionalTester $I)
    {
        $I->assertEmailAddressNotContains('To', 'john_doe@example.com');
    }

    public function assertEmailAttachmentCount(FunctionalTester $I)
    {
        $I->assertEmailAttachmentCount(1);
    }

    public function assertEmailHasHeader(FunctionalTester $I)
    {
        $I->assertEmailHasHeader('To');
    }

    public function assertEmailHeaderNotSame(FunctionalTester $I)
    {
        $I->assertEmailHeaderNotSame('To', 'john_doe@gmail.com');
    }

    public function assertEmailHeaderSame(FunctionalTester $I)
    {
        $I->assertEmailHeaderSame('To', 'jane_doe@example.com');
    }

    public function assertEmailHtmlBodyContains(FunctionalTester $I)
    {
        $I->assertEmailHtmlBodyContains('Example Email');
    }

    public function assertEmailHtmlBodyNotContains(FunctionalTester $I)
    {
        $I->assertEmailHtmlBodyNotContains('userpassword');
    }

    public function assertEmailNotHasHeader(FunctionalTester $I)
    {
        $I->assertEmailNotHasHeader('Bcc');
    }

    public function assertEmailSubjectContains(FunctionalTester $I)
    {
        $I->assertEmailSubjectContains('Account created successfully');
    }

    public function assertEmailSubjectNotContains(FunctionalTester $I)
    {
        $I->assertEmailSubjectNotContains('Password reset');
    }

    public function assertEmailTextBodyContains(FunctionalTester $I)
    {
        $I->assertEmailTextBodyContains('Example text body');
    }

    public function assertEmailTextBodyNotContains(FunctionalTester $I)
    {
        $I->assertEmailTextBodyNotContains('My secret text body');
    }
}
