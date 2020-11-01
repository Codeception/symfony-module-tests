<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $config): void
{
    $config->extension('monolog', [
        'handlers' => [
            'main' => [
                'type' => 'fingers_crossed',
                'action_level' => 'error',
                'handler' => 'nested',
                'excluded_http_codes' => [404, 405],
                'channels' => ['!event']
            ],
            'nested' => [
                'type' => 'stream',
                'path' => '%kernel.logs_dir%/%kernel.environment%.log',
                'level' => 'debug'
            ]
        ]
    ]);
};
