<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\FunctionalTester;

final class TwigCest
{
    public function dontSeeRenderedTemplate(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->dontSeeRenderedTemplate('security/login.html.twig');
    }

    public function seeCurrentTemplateIs(FunctionalTester $I)
    {
        $I->amOnPage('/login');
        $I->seeCurrentTemplateIs('security/login.html.twig');
    }

    public function seeRenderedTemplate(FunctionalTester $I)
    {
        $I->amOnPage('/login');
        $I->seeRenderedTemplate('layout.html.twig');
        $I->seeRenderedTemplate('security/login.html.twig');
    }
}