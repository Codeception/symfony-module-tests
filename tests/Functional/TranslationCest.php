<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;

final class TranslationCest
{
    public function dontSeeFallbackTranslations(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->dontSeeFallbackTranslations();
    }

    public function dontSeeMissingTranslations(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->dontSeeMissingTranslations();
    }

    public function grabDefinedTranslationsCount(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $defined = $I->grabDefinedTranslationsCount();
        $I->assertSame($defined, 6);
    }

    public function seeAllTranslationsDefined(FunctionalTester $I)
    {
        $I->amOnPage('/login');
        $I->seeAllTranslationsDefined();
    }

    public function seeDefaultLocaleIs(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->seeDefaultLocaleIs('en');
    }

    public function seeFallbackLocalesAre(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->seeFallbackLocalesAre(['es']);
    }

    public function seeFallbackTranslationsCountLessThan(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->seeFallbackTranslationsCountLessThan(1);
    }

    public function seeMissingTranslationsCountLessThan(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->seeMissingTranslationsCountLessThan(1);
    }
}
