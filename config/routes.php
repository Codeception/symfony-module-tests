<?php

declare(strict_types=1);

use App\Controller\DashboardController;
use App\Controller\HomeController;
use App\Controller\RegistrationController;
use App\Controller\SecurityController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routes): void {
    $routes->add('index', '/')
        ->controller(HomeController::class)
        ->methods(['GET']);

    $routes->add('app_login', '/login')
        ->controller([SecurityController::class, 'login'])
        ->methods(['GET', 'POST']);

    $routes->add('app_logout', '/logout')
        ->controller([SecurityController::class, 'logout'])
        ->methods(['GET']);

    $routes->add('dashboard', '/dashboard')
        ->controller(DashboardController::class)
        ->methods(['GET']);

    $routes->add('app_register', '/register')
        ->controller(RegistrationController::class)
        ->methods(['GET', 'POST']);
};
