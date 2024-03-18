<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\User;
use App\Tests\Support\FunctionalTester;
use Doctrine\DBAL\Connection;

final class IssuesCest
{
    /**
     * @see https://github.com/Codeception/module-symfony/pull/129
     */
    public function keepDoctrineDbalConnection(FunctionalTester $I)
    {
        $I->haveInRepository(
            User::class,
            [
                'email' => 'fixture@fixture.test',
                'password' => uniqid(),
            ]
        );
        $ormConnection = $I->grabService('doctrine.orm.default_entity_manager')->getConnection();
        $I->rebootClientKernel();
        /** @var Connection $dbalConnection */
        $dbalConnection = $I->grabService('doctrine.dbal.default_connection');

        $I->assertSame($ormConnection, $dbalConnection);

        $user = $dbalConnection->fetchOne('SELECT id FROM user WHERE email = :email', ['email' => 'fixture@fixture.test']);
        $I->assertNotFalse($user);
    }

    /**
     * @see https://github.com/Codeception/module-symfony/pull/185
     */
    public function ensureFragmentsAreIgnored(FunctionalTester $I)
    {
        $I->amOnPage('/register#content');
        $I->seeInCurrentRoute('app_register');
        $I->seeCurrentRouteIs('app_register');
    }

    /**
     * @see https://github.com/Codeception/module-symfony/pull/185
     */
    public function runSymfonyConsoleCommandIgnoresSpecificOptions(FunctionalTester $I)
    {
        $output = $I->runSymfonyConsoleCommand('doctrine:fixtures:load', ['-q']);
        $I->assertIsEmpty($output);
        $numRecords = $I->grabNumRecords(User::class);
        $I->assertSame(1, $numRecords);
    }
}
