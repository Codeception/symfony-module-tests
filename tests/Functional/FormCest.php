<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;

final class FormCest
{
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

    public function seeFormErrorMessage(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->submitSymfonyForm('registration_form', [
            '[email]' => 'john_doe@gmail.com',
            '[plainPassword]' => '123456',
            '[agreeTerms]' => true
        ]);
        $I->seeFormErrorMessage('email');
        $I->seeFormErrorMessage('email', 'There is already an account with this email');
    }

    public function seeFormErrorMessages(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->submitSymfonyForm('registration_form', [
            '[email]' => 'john_doe@gmail.com',
            '[plainPassword]' => '123',
            '[agreeTerms]' => true
        ]);

        // Only with the names of the fields
        $I->seeFormErrorMessages(['email', 'plainPassword']);

        // With field names and error messages
        $I->seeFormErrorMessages([
            // Full Message
            'email' => 'There is already an account with this email',
            // Part of a message
            'plainPassword' => 'at least 6 characters'
        ]);
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
}
