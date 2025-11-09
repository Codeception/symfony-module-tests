<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;

final class NotifierCest
{
    public function assertNotificationSubjectContains(FunctionalTester $I)
    {
        $I->registerUser('jane_doe@gmail.com', '123456', followRedirects: false);
        $notification = $I->getNotifierMessage();
        $I->assertNotificationSubjectContains($notification, 'created!');
    }

    public function assertNotificationSubjectNotContains(FunctionalTester $I)
    {
        $I->registerUser('jane_doe@gmail.com', '123456', followRedirects: false);
        $notification = $I->getNotifierMessage();
        $I->assertNotificationSubjectNotContains($notification, 'Account not created!');
    }

    public function assertNotificationTransportIsEqual(FunctionalTester $I)
    {
        $I->registerUser('jane_doe@gmail.com', '123456', followRedirects: false);
        $notification = $I->getNotifierMessage();
        $I->assertNotificationTransportIsEqual($notification);
    }

    public function assertNotificationTransportIsNotEqual(FunctionalTester $I)
    {
        $I->registerUser('jane_doe@gmail.com', '123456', followRedirects: false);
        $notification = $I->getNotifierMessage();
        $I->assertNotificationTransportIsNotEqual($notification, 'chat');
    }

    public function dontSeeNotificationIsSent(FunctionalTester $I)
    {
        $I->registerUser('john_doe@gmail.com', '123456', followRedirects: false);
        // There is already an account with this notification
        $I->dontSeeNotificationIsSent();
    }

    public function grabLastSentNotification(FunctionalTester $I)
    {
        $I->registerUser('jane_doe@gmail.com', '123456', followRedirects: false);
        $notification = $I->grabLastSentNotification();
        $I->assertSame('Account created!', $notification->getSubject());
    }

    public function grabSentNotifications(FunctionalTester $I)
    {
        $I->registerUser('jane_doe@gmail.com', '123456', followRedirects: false);
        $notifications = $I->grabSentNotifications();
        $subject = $notifications[0]->getSubject();
        $I->assertSame('Account created!', $subject);
    }

    public function seeNotificationIsSent(FunctionalTester $I)
    {
        $I->registerUser('jane_doe@gmail.com', '123456', followRedirects: false);
        $I->seeNotificationIsSent();
    }
}
