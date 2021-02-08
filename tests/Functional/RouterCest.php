<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\FunctionalTester;

final class RouterCest
{
    public function amOnAction(FunctionalTester $I)
    {
        $I->amOnAction('HomeController');
        $I->see('Hello World!');
    }

    public function amOnRoute(FunctionalTester $I)
    {
        $I->amOnRoute('index');
        $I->see('Hello World!');
    }

    public function seeCurrentActionIs(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->seeCurrentActionIs('HomeController');
    }

    public function seeCurrentRouteIs(FunctionalTester $I)
    {
        $I->amOnPage('/login');
        $I->seeCurrentRouteIs('app_login');
    }

    public function seeInCurrentRoute(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->seeInCurrentRoute('index');
    }

}
