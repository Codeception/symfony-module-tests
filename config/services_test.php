<?php

declare(strict_types=1);

use App\Service\Greeting;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $config): void {
    $services = $config->services();

    $services->alias(Security::class, 'security.helper')
        ->public();

    $services->set(Greeting::class)
        ->autowire()
        ->public();
};
