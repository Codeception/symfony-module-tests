<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\Security\Core\Security;

return static function (ContainerConfigurator $config): void
{
    $services = $config->services();

    $services->alias(Security::class, 'security.helper')
        ->public();
};
