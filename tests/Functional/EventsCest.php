<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Event\UserRegisteredEvent;
use App\Tests\FunctionalTester;
use Sensio\Bundle\FrameworkExtraBundle\EventListener\SecurityListener;
use Symfony\Bundle\FrameworkBundle\DataCollector\RouterDataCollector;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\EventListener\ErrorListener;
use Symfony\Component\HttpKernel\EventListener\LocaleListener;
use Symfony\Component\HttpKernel\KernelEvents;

final class EventsCest
{
    /**
     * @deprecated in favor of dontSeeEventListenerIsCalled
     */
    public function dontSeeEventTriggered(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->dontSeeEventTriggered(ErrorListener::class);
        $I->dontSeeEventTriggered(new ErrorListener());
        $I->dontSeeEventTriggered([ErrorListener::class, ErrorListener::class]);
    }

    public function dontSeeEventListenerIsCalled(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->dontSeeEventListenerIsCalled(ErrorListener::class);
        $I->dontSeeEventListenerIsCalled(new ErrorListener());
        $I->dontSeeEventListenerIsCalled([ErrorListener::class, ErrorListener::class]);
        // with events
        $I->dontSeeEventListenerIsCalled(SecurityListener::class, KernelEvents::EXCEPTION);
        $I->dontSeeEventListenerIsCalled(SecurityListener::class, [KernelEvents::REQUEST, KernelEvents::EXCEPTION]);
    }

    public function dontSeeOrphanEvent(FunctionalTester $I)
    {
        $I->amOnPage('/login');
        $I->submitForm('form[name=login]', [
            'email' => 'john_doe@gmail.com',
            'password' => '123456',
            '_remember_me' => false
        ]);
        $I->dontSeeOrphanEvent();
    }

    public function dontSeeEvent(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->dontSeeEvent(KernelEvents::EXCEPTION);
        $I->dontSeeEvent([new UserRegisteredEvent(), ConsoleEvents::COMMAND]);
    }

    /**
     * @deprecated in favor of seeEventListenerIsCalled
     */
    public function seeEventTriggered(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->seeEventTriggered(SecurityListener::class);
        $I->seeEventTriggered(new RouterDataCollector());
        $I->seeEventTriggered([SecurityListener::class, RouterDataCollector::class]);
    }

    public function seeEventListenerIsCalled(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->seeEventListenerIsCalled(SecurityListener::class);
        $I->seeEventListenerIsCalled(new RouterDataCollector());
        $I->seeEventListenerIsCalled([SecurityListener::class, RouterDataCollector::class]);
        // with events
        $I->seeEventListenerIsCalled(SecurityListener::class, KernelEvents::CONTROLLER_ARGUMENTS);
        $I->seeEventListenerIsCalled(LocaleListener::class, [KernelEvents::REQUEST, KernelEvents::FINISH_REQUEST]);
    }

    public function seeOrphanEvent(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->stopFollowingRedirects();
        $I->submitSymfonyForm('registration_form', [
            '[email]' => 'jane_doe@gmail.com',
            '[plainPassword]' => '123456',
            '[agreeTerms]' => true
        ]);
        $I->seeOrphanEvent(UserRegisteredEvent::class);
    }

    public function seeEvent(FunctionalTester $I)
    {
        $I->amOnPage('/register');
        $I->stopFollowingRedirects();
        $I->submitSymfonyForm('registration_form', [
            '[email]' => 'jane_doe@gmail.com',
            '[plainPassword]' => '123456',
            '[agreeTerms]' => true
        ]);
        $I->seeEvent(UserRegisteredEvent::class);
        $I->seeEvent(KernelEvents::REQUEST, KernelEvents::FINISH_REQUEST);
    }
}
