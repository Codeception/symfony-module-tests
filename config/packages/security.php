<?php

declare(strict_types=1);

use App\Entity\User;
use App\Security\SecurityAuthenticator;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $configurator): void
{
    $configurator->extension('security', [
        'encoders' => [
            User::class => ['algorithm' => 'auto']
        ],
        'providers' => [
            'app_user_provider' => [
                'entity' => [
                    'class' => User::class,
                    'property' => 'email'
                ]
            ]
        ]
    ]);

    $configurator->extension('security', [
        'firewalls' => [
            'dev' => [
                'pattern' => '^/(_(profiler|wdt)|css|images|js)/',
                'security' => false
            ],
            'main' => [
                'anonymous' => true,
                'lazy' => true,
                'provider' => 'app_user_provider',
                'guard' => [
                    'authenticators' => [
                        SecurityAuthenticator::class
                    ]
                ],
                'logout' => [
                    'path' => 'app_logout'
                ],
                'remember_me' => [
                    'secret' => '%env(APP_SECRET)%'
                ]
            ]
        ]
    ]);

    $configurator->extension('security', [
        'access_control' => [
            ['path' => '^/dashboard', 'roles' => 'ROLE_USER'],
        ]
    ]);
};
