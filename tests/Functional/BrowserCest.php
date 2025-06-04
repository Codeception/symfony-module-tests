<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\User;
use App\Tests\Support\FunctionalTester;

final class BrowserCest
{
    public function assertBrowserCookieValueSame(FunctionalTester $I)
    {
        $I->setCookie('TESTCOOKIE', 'codecept');
        $I->assertBrowserCookieValueSame('TESTCOOKIE', 'codecept');
    }

    public function assertBrowserHasCookie(FunctionalTester $I)
    {
        $I->setCookie('TESTCOOKIE', 'codecept');
        $I->assertBrowserHasCookie('TESTCOOKIE');
    }

    public function assertBrowserNotHasCookie(FunctionalTester $I)
    {
        $I->setCookie('TESTCOOKIE', 'codecept');
        $I->resetCookie('TESTCOOKIE');
        $I->assertBrowserNotHasCookie('TESTCOOKIE');
    }

    public function assertRequestAttributeValueSame(FunctionalTester $I)
    {
        $I->amOnPage('/request_attr');
        $I->assertRequestAttributeValueSame('page', 'register');
    }

    public function assertResponseCookieValueSame(FunctionalTester $I)
    {
        $I->amOnPage('/response_cookie');
        $I->assertResponseCookieValueSame('TESTCOOKIE', 'codecept');
    }

    public function assertResponseFormatSame(FunctionalTester $I)
    {
        $I->amOnPage('/response_json');
        $I->assertResponseFormatSame('json');
    }

    public function assertResponseHasCookie(FunctionalTester $I)
    {
        $I->amOnPage('/response_cookie');
        $I->assertResponseHasCookie('TESTCOOKIE');
    }

    public function assertResponseHasHeader(FunctionalTester $I)
    {
        $I->amOnPage('/response_json');
        $I->assertResponseHasHeader('content-type');
    }

    public function assertResponseHeaderNotSame(FunctionalTester $I)
    {
        $I->amOnPage('/response_json');
        $I->assertResponseHeaderNotSame('content-type', 'application/octet-stream');
    }

    public function assertResponseHeaderSame(FunctionalTester $I)
    {
        $I->amOnPage('/response_json');
        $I->assertResponseHeaderSame('content-type', 'application/json');
    }

    public function assertResponseIsSuccessful(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->assertResponseIsSuccessful();
    }

    public function assertResponseIsUnprocessable(FunctionalTester $I)
    {
        $I->amOnPage('/unprocessable_entity');
        $I->assertResponseIsUnprocessable();
    }

    public function assertResponseNotHasCookie(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->assertResponseNotHasCookie('TESTCOOKIE');
    }

    public function assertResponseNotHasHeader(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->assertResponseNotHasHeader('accept-charset');
    }

    public function assertResponseRedirects(FunctionalTester $I)
    {
        $I->stopFollowingRedirects();
        $I->amOnPage('/redirect_home');
        $I->assertResponseRedirects();
        $I->assertResponseRedirects('/');
    }

    public function assertResponseStatusCodeSame(FunctionalTester $I)
    {
        $I->stopFollowingRedirects();
        $I->amOnPage('/redirect_home');
        $I->assertResponseStatusCodeSame(302);
    }

    public function assertRouteSame(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->assertRouteSame('index');

        $I->amOnPage('/login');
        $I->assertRouteSame('app_login');
    }

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
        $I->registerUser('jane_doe@gmail.com', '123456', followRedirects: true);
        $I->seeInRepository(User::class, [
            'email' => 'jane_doe@gmail.com',
        ]);
    }
}
