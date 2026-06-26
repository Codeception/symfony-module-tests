<?php

declare(strict_types=1);

use App\Controller\BrowserController;
use App\Controller\DashboardController;
use App\Controller\DomCrawlerController;
use App\Controller\ExternalApiController;
use App\Controller\FormController;
use App\Controller\HomeController;
use App\Controller\HttpClientController;
use App\Controller\RegistrationController;
use App\Controller\SecurityController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routes): void {
    $routes->add('index', '/')
        ->controller(HomeController::class)
        ->methods(['GET']);

    $routes->add('app_external_api', '/external-api')
        ->controller(ExternalApiController::class)
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

    $routes->add('app_browser_request_attr', '/request_attr')
        ->controller([BrowserController::class, 'requestWithAttribute'])
        ->methods(['GET']);

    $routes->add('app_browser_response_cookie', '/response_cookie')
        ->controller([BrowserController::class, 'responseWithCookie'])
        ->methods(['GET']);

    $routes->add('app_browser_response_json', '/response_json')
        ->controller([BrowserController::class, 'responseJsonFormat'])
        ->methods(['GET']);

    $routes->add('app_browser_unprocessable_entity', '/unprocessable_entity')
        ->controller([BrowserController::class, 'unprocessableEntity'])
        ->methods(['GET']);

    $routes->add('app_browser_redirect_home', '/redirect_home')
        ->controller([BrowserController::class, 'redirectToHome'])
        ->methods(['GET']);

    $routes->add('app_dom_crawler_test_page', '/test_page')
        ->controller(DomCrawlerController::class)
        ->methods(['GET']);

    $routes->add('app_form_test', '/test_form')
        ->controller(FormController::class)
        ->methods(['GET', 'POST']);

    $routes->add('route_using_http_client', '/route-using-http-client')
        ->controller([HttpClientController::class, 'routeUsingHttpClient'])
        ->methods(['GET']);

    $routes->add('internal_endpoint', '/internal-endpoint')
        ->controller([HttpClientController::class, 'internalEndpoint'])
        ->methods(['GET']);

    $routes->add('route_making_multiple_requests', '/route-making-multiple-requests')
        ->controller([HttpClientController::class, 'routeMakingMultipleRequests'])
        ->methods(['GET']);

    $routes->add('internal_endpoint_post', '/internal-endpoint-post')
        ->controller([HttpClientController::class, 'internalEndpointPost'])
        ->methods(['POST']);

    $routes->add('route_should_not_make_specific_request', '/route-should-not-make-specific-request')
        ->controller([HttpClientController::class, 'routeShouldNotMakeSpecificRequest'])
        ->methods(['GET']);

    $routes->add('internal_endpoint_not_desired', '/internal-endpoint-not-desired')
        ->controller([HttpClientController::class, 'internalEndpointNotDesired'])
        ->methods(['GET']);

    $routes->add('send_email', '/send-email')
        ->controller(App\Controller\SendEmailController::class)
        ->methods(['GET']);

    $routes->add('send_message', '/send-message')
        ->controller(App\Controller\SendMessageController::class)
        ->methods(['GET']);

    $routes->add('app_create_user', '/create-user')
        ->controller(App\Controller\CreateUserController::class)
        ->methods(['GET']);

    $routes->add('app_create_user_with_confirmation', '/create-user-with-confirmation')
        ->controller(App\Controller\CreateUserWithConfirmationController::class)
        ->methods(['GET']);

    $routes->add('dispatch_message', '/dispatch-message')
        ->controller(App\Controller\DispatchMessageController::class)
        ->methods(['GET']);
};
