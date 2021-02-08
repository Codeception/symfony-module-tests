<?php

declare(strict_types=1);

use App\Doctrine\UserHashPasswordListener;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $config): void
{
    $config->parameters()
        ->set('locale', 'es')
        ->set('app.business_shortname', '%env(BUSINESS_SHORTNAME)%')
        ->set('app.business_fullname', '%env(BUSINESS_FULLNAME)%');

    $services = $config->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load('App\\', '../src/*')
        ->exclude('../src/{DependencyInjection,Entity,Tests,Kernel.php}');

    $services->load('App\Controller\\', '../src/Controller')
        ->tag('controller.service_arguments');

    $services->set(UserHashPasswordListener::class)
        ->tag('doctrine.orm.entity_listener', ['lazy' => true]);
};
