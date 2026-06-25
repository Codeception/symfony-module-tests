<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Message\SendWelcomeMessage;
use App\Tests\Support\FunctionalTester;
use stdClass;

final class MessengerCest
{
    public function seeDispatchedMessageCount(FunctionalTester $I): void
    {
        $I->amOnPage('/dispatch-message');
        $I->seeDispatchedMessageCount(1);
        $I->seeDispatchedMessageCount(1, 'messenger.bus.default');
    }

    public function seeMessageDispatched(FunctionalTester $I): void
    {
        $I->amOnPage('/dispatch-message');
        $I->seeMessageDispatched(SendWelcomeMessage::class);
        $I->seeMessageDispatched(SendWelcomeMessage::class, 'messenger.bus.default');
    }

    public function dontSeeMessageDispatched(FunctionalTester $I): void
    {
        $I->amOnPage('/dispatch-message');
        $I->dontSeeMessageDispatched(stdClass::class);
    }

    public function grabDispatchedMessageClasses(FunctionalTester $I): void
    {
        $I->amOnPage('/dispatch-message');
        $messages = $I->grabDispatchedMessageClasses();
        $I->assertSame([SendWelcomeMessage::class], $messages);
    }

    public function noMessagesDispatched(FunctionalTester $I): void
    {
        $I->amOnPage('/');
        $I->seeDispatchedMessageCount(0);
        $I->assertSame([], $I->grabDispatchedMessageClasses());
    }
}
