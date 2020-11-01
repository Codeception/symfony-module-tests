<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $config): void
{
    // Framework
    $config->extension('framework', [
        'test' => true,
        'session' => [
            'storage_id' => 'session.storage.mock_file'
        ]
    ]);

    // Validator
    $config->extension('framework', [
        'validation' => [
            'not_compromised_password' => false
        ]
    ]);

    // Web Profiler
    $config->extension('framework', [
        'profiler' => ['collect' => false]
    ]);
};
