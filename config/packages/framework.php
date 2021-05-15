<?php

declare(strict_types=1);

use Symfony\Config\FrameworkConfig;

return static function (FrameworkConfig $framework): void
{
    // Cache
    $framework->cache();

    // Framework
    $framework->secret('%env(APP_SECRET)%');
    $framework->session([
        'cookie_secure' => 'auto',
        'cookie_samesite' => 'lax'
    ])->handlerId(null);
    $framework->phpErrors([
        'log' => true
    ]);

    // Mailer
    $framework->mailer([
        'dsn' => '%env(MAILER_DSN)%'
    ]);

    // Routing
    $framework->router([
        'utf8' => true
    ]);

    // Translation
    $framework->defaultLocale('%locale%');
    $framework->translator([
        'default_path' => '%kernel.project_dir%/resources/lang',
        'fallbacks' => ['%locale%']
    ]);

    // Validator
    $framework->validation([
        'email_validation_mode' => 'html5'
    ]);
};
