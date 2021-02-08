<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\User;
use App\Repository\Model\UserRepositoryInterface;
use App\Repository\UserRepository;
use App\Tests\FunctionalTester;

final class DoctrineCest
{
    public function grabNumRecords(FunctionalTester $I)
    {
        $numRecords = $I->grabNumRecords(User::class);
        $I->assertSame(1, $numRecords);
    }

    public function grabRepository(FunctionalTester $I)
    {
        //With classes
        $repository = $I->grabRepository(User::class);
        $I->assertInstanceOf(UserRepository::class, $repository);

        //With Repository classes
        $repository = $I->grabRepository(UserRepository::class);
        $I->assertInstanceOf(UserRepository::class, $repository);

        //With Entities
        $user = $I->grabEntityFromRepository(User::class, [
            'email' => 'john_doe@gmail.com'
        ]);
        $repository = $I->grabRepository($user);
        $I->assertInstanceOf(UserRepository::class, $repository);

        //With Repository interfaces
        $repository = $I->grabRepository(UserRepositoryInterface::class);
        $I->assertInstanceOf(UserRepository::class, $repository);
    }

    public function seeNumRecords(FunctionalTester $I)
    {
        $I->seeNumRecords(1, User::class);
    }

}
