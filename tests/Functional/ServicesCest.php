<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Service\Greeting;
use App\Tests\Support\FunctionalTester;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class ServicesCest
{
    public function grabContainer(FunctionalTester $I): void
    {
        $container = $I->grabContainer();

        $I->assertInstanceOf(ContainerInterface::class, $container);
        $I->assertSame('test', $container->getParameter('kernel.environment'));

        $I->assertTrue($container->has(EntityManagerInterface::class));
        $I->assertFalse($I->grabService('kernel')->getContainer()->has(EntityManagerInterface::class));
    }

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
