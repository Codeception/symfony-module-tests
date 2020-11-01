<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $config): void
{
    // Doctrine
    $config->extension('framework', [
        'cache' => [
            'pools' => [
                'doctrine.result_cache_pool' => [
                    'adapter' => 'cache.app'
                ],
                'doctrine.system_cache_pool' => [
                    'adapter' => 'cache.system'
                ]
            ]
        ]
    ]);

    // Routing
    $config->extension('framework', [
        'router' => [
            'strict_requirements' => null
        ]
    ]);
};
