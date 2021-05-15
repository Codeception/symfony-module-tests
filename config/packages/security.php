<?php

declare(strict_types=1);

use App\Entity\User;
use App\Security\SecurityAuthenticator;
use Symfony\Config\SecurityConfig;

return static function (SecurityConfig $security): void
{
    $security->passwordHasher(User::class, [
        'algorithm' => 'auto'
    ]);
    $security->provider('app_user_provider', [
        'entity' => [
            'class' => User::class,
            'property' => 'email'
        ]
    ]);

    $security->firewall('dev', [
        'pattern' => '^/(_(profiler|wdt)|css|images|js)/',
        'security' => false
    ]);
    $security->firewall('main', [
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
    ])->anonymous();

    $security->accessControl([
        'path' => '^/dashboard', 'roles' => 'ROLE_USER'
    ]);
};
