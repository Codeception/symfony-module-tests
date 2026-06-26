<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Doctrine\CurrentUserEventListener;
use App\Doctrine\CurrentUserListener;
use App\Doctrine\FlushCounterListener;
use App\Doctrine\RequestStackListener;
use App\Entity\User;
use App\Service\ExternalApiStub;
use App\Tests\Support\FunctionalTester;
use Doctrine\DBAL\Connection;
use Symfony\Component\Mime\Message;

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
     * @see https://github.com/Codeception/module-symfony/issues/34
     */
    public function seeLoggedInUserInsideDoctrineListener(FunctionalTester $I)
    {
        $user = $I->grabEntityFromRepository(User::class, ['email' => 'john_doe@gmail.com']);
        $I->amLoggedInAs($user);

        $I->amOnPage('/create-user');

        $listener = $I->grabService(CurrentUserListener::class);
        $I->assertSame('john_doe@gmail.com', $listener->currentUserIdentifier);
    }

    /**
     * @see https://github.com/Codeception/module-symfony/issues/34
     */
    public function seeLoggedInUserInsideDoctrineEventListener(FunctionalTester $I)
    {
        $user = $I->grabEntityFromRepository(User::class, ['email' => 'john_doe@gmail.com']);
        $I->amLoggedInAs($user);

        $I->amOnPage('/create-user');

        $listener = $I->grabService(CurrentUserEventListener::class);
        $I->assertSame('john_doe@gmail.com', $listener->currentUserIdentifier);
    }

    /**
     * @see https://github.com/Codeception/module-symfony/issues/150
     */
    public function accessRequestStackInsideDoctrineListener(FunctionalTester $I)
    {
        $I->amOnPage('/create-user');

        $listener = $I->grabService(RequestStackListener::class);
        $I->assertTrue($listener->hasRequest, 'request_stack has no current request inside the Doctrine listener');
        $I->assertSame('en', $listener->currentLocale);
    }

    /**
     * @see https://github.com/Codeception/module-symfony/issues/151
     */
    public function grabSameDoctrineListenerInstanceAfterReboot(FunctionalTester $I)
    {
        $I->amOnPage('/create-user');

        $listener = $I->grabService(FlushCounterListener::class);
        $I->assertSame(1, $listener->flushes);
    }

    /**
     * @see https://github.com/Codeception/module-symfony/issues/90
     */
    public function seeEmailIsSentFromDoctrineListener(FunctionalTester $I)
    {
        $I->amOnPage('/create-user-with-confirmation');

        $I->seeEmailIsSent();
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

    /**
     * @see https://github.com/Codeception/module-symfony/pull/232
     */
    public function ensureMessageObjectsCanBeFetched(FunctionalTester $I)
    {
        $I->amOnPage('/send-message');
        $I->seeEmailIsSent(1);
        $I->assertEmailAddressContains('To', 'jane_doe@example.com');
        $I->assertEmailHeaderSame('To', 'jane_doe@example.com');
        $I->assertEmailHeaderSame('Subject', 'Text message');
        $I->assertInstanceOf(Message::class, $I->grabLastSentEmail());
    }

    /**
     * @see https://github.com/Codeception/module-symfony/issues/130
     */
    public function keepConfiguredServiceStateAcrossKernelReboot(FunctionalTester $I)
    {
        $I->amOnPage('/external-api');
        $I->see(ExternalApiStub::REAL_RESPONSE);

        /** @var ExternalApiStub $externalApi */
        $externalApi = $I->grabService(ExternalApiStub::class);
        $externalApi->setFakeResponse('Faked API response');
        $I->persistService(ExternalApiStub::class);

        $I->amOnPage('/external-api');
        $I->see('Faked API response');
    }
}
