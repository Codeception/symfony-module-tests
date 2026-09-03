<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Service\Greeting;
use App\Tests\Support\FunctionalTester;
use Symfony\Component\Security\Core\Security;

final class ServicesCest
{
    public function grabService(FunctionalTester $I)
    {
        $security = $I->grabService('security.helper');
        $I->assertInstanceOf(Security::class, $security);
    }

    public function mockService(FunctionalTester $I): void
    {
        $I->mockService(Greeting::class, new class extends Greeting {
            public function greet(): string
            {
                return 'Mocked greeting!';
            }
        });

        $I->amOnPage('/greeting');
        $I->see('Mocked greeting!');
    }
}
