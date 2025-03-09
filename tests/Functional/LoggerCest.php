<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;

final class LoggerCest
{
    public function dontSeeDeprecations(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->dontSeeDeprecations();
    }
}
