<?php

declare(strict_types=1);

use App\Doctrine\UserHashPasswordListener;
use App\Entity\User;
use Doctrine\ORM\Events;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $config): void {
    $config->parameters()
        ->set('app.business_name', '%env(BUSINESS_NAME)%');

    $services = $config->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load('App\\', '../src/*')
        ->exclude('../src/{DependencyInjection,Entity,Kernel.php}');

    $services->set(UserHashPasswordListener::class)
        ->tag('doctrine.orm.entity_listener', [
            'event' => Events::prePersist,
            'entity' => User::class,
            'lazy' => true,
        ]);

    // Doctrine listeners used by App\Tests\Functional\IssuesCest to reproduce the
    // security/request context regressions. Each is public so the tests can grab
    // it and read the state it captured during the request.

    // Issue #34 (entity-listener path).
    $services->set(App\Doctrine\CurrentUserListener::class)
        ->public()
        ->tag('doctrine.orm.entity_listener', [
            'event' => Events::prePersist,
            'entity' => User::class,
            'lazy' => true,
        ]);

    // Issue #34 (event-listener path).
    $services->set(App\Doctrine\CurrentUserEventListener::class)
        ->public();

    // Issue #150 (request_stack inside a Doctrine listener).
    $services->set(App\Doctrine\RequestStackListener::class)
        ->public();

    // Issue #151 (shared listener instance across reboots).
    $services->set(App\Doctrine\FlushCounterListener::class)
        ->public();

    // Issue #90 (email sent from a Doctrine entity listener).
    $services->set(App\Doctrine\SendConfirmationListener::class)
        ->tag('doctrine.orm.entity_listener', [
            'event' => Events::postPersist,
            'entity' => User::class,
            'lazy' => true,
        ]);

    $services->set(App\Service\ExternalApiStub::class)
        ->public();
};
