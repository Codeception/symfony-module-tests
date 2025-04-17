<?php

declare(strict_types=1);

use App\Entity\User;
use App\Security\SecurityAuthenticator;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Config\SecurityConfig;

return static function (SecurityConfig $security): void {
    $security->passwordHasher(PasswordAuthenticatedUserInterface::class, 'auto');
    $userProvider = $security->provider('app_user_provider');
    $userProvider->entity()
        ->class(User::class)
        ->property('email');

    $devFirewall = $security->firewall('dev');
    $devFirewall
        ->pattern('^/(_(profiler|wdt)|css|images|js)/')
        ->security(false);

    $apiFirewall = $security->firewall('api');
    $apiFirewall
        ->pattern('^/api')
        ->stateless(true)
        ->provider('app_user_provider')
        ->jwt();
    $apiFirewall->jsonLogin([
        'check_path' => '/api/login',
        'success_handler' => 'lexik_jwt_authentication.handler.authentication_success',
        'failure_handler' => 'lexik_jwt_authentication.handler.authentication_failure',
    ]);

    $mainFirewall = $security->firewall('main');
    $mainFirewall
        ->lazy(true)
        ->provider('app_user_provider')
        ->customAuthenticators([SecurityAuthenticator::class]);
    $mainFirewall->logout(['path' => 'app_logout']);
    $mainFirewall->rememberMe(['secret' => '%env(APP_SECRET)%']);

    $security->accessControl(['path' => '^/api/login', 'roles' => 'PUBLIC_ACCESS']);
    $security->accessControl(['path' => '^/api', 'roles' => 'IS_AUTHENTICATED_FULLY']);
    $security->accessControl(['path' => '^/dashboard', 'roles' => 'ROLE_USER']);
};
