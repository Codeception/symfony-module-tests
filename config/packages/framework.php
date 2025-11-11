<?php

declare(strict_types=1);

use Symfony\Config\FrameworkConfig;

return static function (FrameworkConfig $framework): void {
    // Cache
    $framework->cache();

    // Csrf
    $framework->form()
        ->csrfProtection()
        ->tokenId('submit');

    $framework->csrfProtection()
        ->statelessTokenIds(['submit', 'authenticate', 'logout']);

    // Framework
    $framework->secret('%env(APP_SECRET)%');
    $framework->handleAllThrowables(true);
    $framework->session()
        ->handlerId(null)
        ->cookieSecure('auto')
        ->cookieSamesite('lax');
    $framework->phpErrors()
        ->log(true);

    // Mailer
    $framework->mailer()
        ->dsn('%env(MAILER_DSN)%');

    // Notifier
    $framework->notifier()
        ->chatterTransport('slack', '%env(NOTIFIER_DSN)%');

    // PropertyInfo
    $framework->propertyInfo()
        ->withConstructorExtractor(true);

    // Routing
    $framework->router()
        ->utf8(true);

    // Translation
    $framework->defaultLocale('en');
    $framework->translator()
        ->enabled(true)
        ->defaultPath('%kernel.project_dir%/resources/lang')
        ->fallbacks('es');

    // Validator
    $framework->validation([
        'email_validation_mode' => 'html5',
    ]);
};
