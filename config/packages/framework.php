<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return App::config([
    'framework' => [
        'cache' => [],
        'csrf_protection' => [
            'stateless_token_ids' => ['submit', 'authenticate', 'logout'],
        ],
        'default_locale' => 'en',
        'form' => [
            'csrf_protection' => [
                'token_id' => 'submit',
            ],
        ],
        'handle_all_throwables' => true,
        'mailer' => [
            'dsn' => '%env(MAILER_DSN)%',
        ],
        'notifier' => [
            'chatter_transports' => [
                'slack' => '%env(NOTIFIER_DSN)%',
            ],
        ],
        'php_errors' => [
            'log' => true,
        ],
        'property_info' => [
            'with_constructor_extractor' => true,
        ],
        'router' => [
            'utf8' => true,
        ],
        'secret' => '%env(APP_SECRET)%',
        'session' => [
            'handler_id' => null,
            'cookie_secure' => 'auto',
            'cookie_samesite' => 'lax',
        ],
        'translator' => [
            'enabled' => true,
            'default_path' => '%kernel.project_dir%/resources/lang',
            'fallbacks' => ['es'],
        ],
        'validation' => [
            'email_validation_mode' => 'html5',
        ],
    ],
    'when@dev' => [
        'framework' => [
            'profiler' => [
                'only_exceptions' => false,
                'collect_serializer_data' => true,
            ],
        ],
    ],
    'when@test' => [
        'framework' => [
            'profiler' => [
                'collect' => false,
                'collect_serializer_data' => true,
            ],
            'session' => [
                'storage_factory_id' => 'session.storage.factory.mock_file',
            ],
            'test' => true,
            'validation' => [
                'not_compromised_password' => [
                    'enabled' => true,
                ],
            ],
        ],
    ],
]);
