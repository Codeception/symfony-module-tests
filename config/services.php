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
};
