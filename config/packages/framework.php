<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $config): void
{
    // Assets
    $config->extension('framework', [
        'assets' => [
            'json_manifest_path' => '%kernel.project_dir%/public/build/manifest.json'
        ]
    ]);

    // Cache
    $config->extension('framework', [
        'cache' => null
    ]);

    // Framework
    $config->extension('framework', [
        'secret' => '%env(APP_SECRET)%',
        'session' => [
            'handler_id' => null,
            'cookie_secure' => 'auto',
            'cookie_samesite' => 'lax'
        ],
        'php_errors' => ['log' => true]
    ]);

    // Mailer
    $config->extension('framework', [
        'mailer' => ['dsn' => '%env(MAILER_DSN)%'],
    ]);

    // Routing
    $config->extension('framework', [
        'router' => [
            'utf8' => true
        ]
    ]);

    // Translation
    $config->extension('framework', [
        'default_locale' => '%locale%',
        'translator' => [
            'default_path' => '%kernel.project_dir%/resources/lang',
            'fallbacks' => ['%locale%']
        ]
    ]);

    // Validator
    $config->extension('framework', [
        'validation' => [
            'email_validation_mode' => 'html5'
        ]
    ]);
};
