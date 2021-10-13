<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class UserFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = User::create(
            'john_doe@gmail.com',
            '123456',
            ['ROLE_CUSTOMER']
        );

        $manager->persist($user);
        $manager->flush();
    }
}
