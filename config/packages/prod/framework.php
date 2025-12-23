<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return App::config([
    'framework' => [
        // Doctrine
        'cache' => [
            'pools' => [
                'doctrine.result_cache_pool' => [
                    'adapters' => ['cache.app'],
                ],
                'doctrine.system_cache_pool' => [
                    'adapters' => ['cache.system'],
                ],
            ],
        ],
        'router' => [
            'strict_requirements' => null,
        ],
    ],
]);
