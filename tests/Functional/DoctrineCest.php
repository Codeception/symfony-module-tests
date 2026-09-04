<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\User;
use App\Repository\Model\UserRepositoryInterface;
use App\Repository\UserRepository;
use App\Tests\Support\FunctionalTester;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineCest
{
    public function grabEntityManager(FunctionalTester $I): void
    {
        $em = $I->grabEntityManager();

        $I->assertInstanceOf(EntityManagerInterface::class, $em);
        $I->assertTrue($em->isOpen());
        $I->assertSame($em, $I->grabService('doctrine.orm.default_entity_manager'));
    }

    public function grabNumRecords(FunctionalTester $I)
    {
        $numRecords = $I->grabNumRecords(User::class);
        $I->assertSame(1, $numRecords);
    }

    public function grabRepository(FunctionalTester $I)
    {
        // With classes
        $repository = $I->grabRepository(User::class);
        $I->assertInstanceOf(UserRepository::class, $repository);

        // With Repository classes
        $repository = $I->grabRepository(UserRepository::class);
        $I->assertInstanceOf(UserRepository::class, $repository);

        // With Entities
        $user = $I->grabEntityFromRepository(User::class, [
            'email' => 'john_doe@gmail.com',
        ]);
        $repository = $I->grabRepository($user);
        $I->assertInstanceOf(UserRepository::class, $repository);

        // With Repository interfaces
        $repository = $I->grabRepository(UserRepositoryInterface::class);
        $I->assertInstanceOf(UserRepository::class, $repository);
    }

    public function resetDoctrineManager(FunctionalTester $I): void
    {
        $em = $I->grabEntityManager();
        $user = $em->getRepository(User::class)->findOneBy(['email' => 'john_doe@gmail.com']);
        $I->assertTrue($em->contains($user));

        $I->resetDoctrineManager();
        $I->assertFalse($I->grabEntityManager()->contains($user));

        $I->grabEntityManager()->close();
        $I->resetDoctrineManager();

        $I->assertTrue($I->grabEntityManager()->isOpen());
        $I->seeNumRecords(1, User::class);
    }

    public function seeNumRecords(FunctionalTester $I)
    {
        $I->seeNumRecords(1, User::class);
    }

    public function seeDoctrineSchemaIsValid(FunctionalTester $I): void
    {
        $I->seeDoctrineSchemaIsValid();
    }

    public function queryCountAssertions(FunctionalTester $I): void
    {
        $I->amOnPage('/run-queries');
        $I->seeNumQueriesIsLessThan(10);
        $I->dontSeeDuplicateQueries();
    }
}
