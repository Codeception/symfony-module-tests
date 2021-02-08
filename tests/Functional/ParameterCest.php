<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\FunctionalTester;

final class ParameterCest
{
    public function grabParameter(FunctionalTester $I)
    {
        $locale = (string) $I->grabParameter('locale');
        $I->assertSame('es', $locale);
    }
}
