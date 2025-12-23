<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return App::config([
    'when@dev' => [
        'web_profiler' => [
            'intercept_redirects' => false,
            'toolbar' => [
                'enabled' => true,
            ],
        ],
    ],
    'when@test' => [
        'web_profiler' => [
            'intercept_redirects' => false,
            'toolbar' => [
                'enabled' => false,
            ],
        ],
    ],
]);
