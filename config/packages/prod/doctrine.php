<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return App::config([
    'doctrine' => [
        'orm' => [
            'entity_managers' => [
                'default' => [
                    'query_cache_driver' => [
                        'type' => 'pool',
                        'pool' => 'doctrine.system_cache_pool',
                    ],
                    'result_cache_driver' => [
                        'type' => 'pool',
                        'pool' => 'doctrine.system_cache_pool',
                    ],
                ],
            ],
        ],
    ],
]);
