<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;
use Symfony\Component\Security\Core\Security;

final class ServicesCest
{
    public function grabService(FunctionalTester $I)
    {
        $security = $I->grabService('security.helper');
        $I->assertInstanceOf(Security::class, $security);
    }

}
