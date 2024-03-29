<?php

declare(strict_types=1);

use Symfony\Config\FrameworkConfig;

return static function (FrameworkConfig $framework): void {
    // Cache
    $framework->cache();

    // Framework
    $framework->secret('%env(APP_SECRET)%');
    $framework->httpMethodOverride(false);
    $framework->session()
        ->handlerId(null)
        ->cookieSecure('auto')
        ->cookieSamesite('lax')
        ->storageFactoryId('session.storage.factory.native');
    $framework->phpErrors()
        ->log(true);

    // Mailer
    $framework->mailer()
        ->dsn('%env(MAILER_DSN)%');

    // Routing
    $framework->router()
        ->utf8(true);

    // Translation
    $framework->defaultLocale('en');
    $framework->translator()
        ->defaultPath('%kernel.project_dir%/resources/lang')
        ->fallbacks('en');

    // Validator
    $framework->validation([
        'email_validation_mode' => 'html5'
    ]);
};
