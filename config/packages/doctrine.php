<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return App::config([
    'doctrine' => [
        'dbal' => [
            'connections' => [
                'default' => [
                    'url' => '%env(resolve:DATABASE_URL)%',
                    'profiling_collect_backtrace' => '%kernel.debug%',
                ],
            ],
        ],
        'orm' => [
            'entity_managers' => [
                'default' => [
                    'auto_mapping' => true,
                    'naming_strategy' => 'doctrine.orm.naming_strategy.underscore_number_aware',
                    'validate_xml_mapping' => true,
                    'mappings' => [
                        'App' => [
                            'alias' => 'App',
                            'dir' => '%kernel.project_dir%/src/Entity',
                            'is_bundle' => false,
                            'prefix' => 'App\Entity',
                            'type' => 'attribute',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'when@test' => [
        'doctrine' => [
            'dbal' => [
                'connections' => [
                    'default' => [
                        'dbname_suffix' => '_test%env(default::TEST_TOKEN)%',
                    ],
                ],
            ],
        ],
    ],
]);
