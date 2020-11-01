<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $config): void
{
    $config->extension('doctrine', [
        'orm' => [
            'auto_generate_proxy_classes' => false,
            'metadata_cache_driver' => [
                'type' => 'pool',
                'pool' => 'doctrine.system_cache_pool'
            ],
            'query_cache_driver' => [
                'type' => 'pool',
                'pool' => 'doctrine.system_cache_pool'
            ],
            'result_cache_driver' => [
                'type' => 'pool',
                'pool' => 'doctrine.result_cache_pool'
            ]
        ]
    ]);
};
