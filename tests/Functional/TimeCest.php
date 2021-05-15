<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\FunctionalTester;

final class TimeCest
{
    public function seeRequestElapsedTimeLessThan(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->seeInCurrentUrl('register');
        $I->seeRequestTimeIsLessThan(400);
    }
}