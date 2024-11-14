<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;

final class FormCest
{
    public function assertFormValue(FunctionalTester $I)
    {
        $I->amOnPage('/test_form');
        $I->assertFormValue('#testForm', 'username', 'codeceptUser');
    }

    public function assertNoFormValue(FunctionalTester $I)
    {
        $I->amOnPage('/test_form');
        $I->assertNoFormValue('#testForm', 'nonexistentField');
    }

    public function dontSeeFormErrors(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->submitSymfonyForm('registration_form', [
            '[email]' => 'jane_doe@gmail.com',
            '[password]' => '123456',
            '[agreeTerms]' => true,
        ]);
        $I->dontSeeFormErrors();
    }

    public function seeFormErrorMessage(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->submitSymfonyForm('registration_form', [
            '[email]' => 'john_doe@gmail.com',
            '[password]' => '123456',
            '[agreeTerms]' => true,
        ]);
        $I->seeFormErrorMessage('email');
        $I->seeFormErrorMessage('email', 'There is already an account with this email');
    }

    public function seeFormErrorMessages(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->submitSymfonyForm('registration_form', [
            '[email]' => 'john_doe@gmail.com',
            '[password]' => '123',
            '[agreeTerms]' => true,
        ]);

        // Only with the names of the fields
        $I->seeFormErrorMessages(['email', 'password']);

        // With field names and error messages
        $I->seeFormErrorMessages([
            // Full Message
            'email' => 'There is already an account with this email',
            // Part of a message
            'password' => 'at least 6 characters',
        ]);
    }

    public function seeFormHasErrors(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->submitSymfonyForm('registration_form', [
            '[email]' => 'john_doe@gmail.com',
            '[password]' => '123456',
            '[agreeTerms]' => true,
        ]);
        // There is already an account with this email
        $I->seeFormHasErrors();
    }
}
