<?php

declare(strict_types=1);

use App\Entity\User;
use App\Security\SecurityAuthenticator;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Config\SecurityConfig;

return static function (SecurityConfig $security): void
{
    $security->enableAuthenticatorManager(true);
    $security->passwordHasher(PasswordAuthenticatedUserInterface::class, 'auto');
    $userProvider = $security->provider('app_user_provider');
    $userProvider->entity()
        ->class(User::class)
        ->property('email');

    $devFirewall = $security->firewall('dev');
    $devFirewall
        ->pattern('^/(_(profiler|wdt)|css|images|js)/')
        ->security(false);

    $mainFirewall = $security->firewall('main');
    $mainFirewall
        ->lazy(true)
        ->provider('app_user_provider')
        ->customAuthenticators([SecurityAuthenticator::class]);
    $mainFirewall->logout(['path' => 'app_logout']);
    $mainFirewall->rememberMe(['secret' => '%env(APP_SECRET)%']);
    $mainFirewall->formLogin();
    $mainFirewall->entryPoint('form_login');

    $security->accessControl([
        'path' => '^/dashboard', 'roles' => 'ROLE_USER'
    ]);
};
