<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;

final class ParameterCest
{
    public function grabParameter(FunctionalTester $I)
    {
        $locale = (string) $I->grabParameter('app.business_name');
        $I->assertSame('Codeception', $locale);
    }
}
