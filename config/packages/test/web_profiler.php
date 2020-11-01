<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $config): void
{
    $config->extension('web_profiler', [
        'toolbar' => false,
        'intercept_redirects' => false
    ]);
};
