<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Entity\User;
use App\Security\SecurityAuthenticator;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

return App::config([
    'security' => [
        'password_hashers' => [
            PasswordAuthenticatedUserInterface::class => 'auto',
        ],
        'providers' => [
            'app_user_provider' => [
                'entity' => [
                    'class' => User::class,
                    'property' => 'email',
                ],
            ],
        ],
        'firewalls' => [
            'dev' => [
                'pattern' => '^/(_(profiler|wdt)|css|images|js)/',
                'security' => false,
            ],
            'main' => [
                'lazy' => true,
                'provider' => 'app_user_provider',
                'custom_authenticators' => [
                    SecurityAuthenticator::class,
                ],
                'logout' => [
                    'path' => 'app_logout',
                ],
                'remember_me' => [
                    'secret' => '%env(APP_SECRET)%',
                ],
            ],
        ],
        'access_control' => [
            ['path' => '^/dashboard', 'roles' => 'ROLE_USER'],
        ],
    ],
    'when@test' => [
        'security' => [
            'password_hashers' => [
                PasswordAuthenticatedUserInterface::class => [
                    'algorithm' => 'auto',
                    // 'cost' => 4,
                    // 'time_cost' => 3,
                    // 'memory_cost' => 10,
                ],
            ],
        ],
    ],
]);
