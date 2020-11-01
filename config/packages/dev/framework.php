<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $config): void
{
    // Web Profiler
    $config->extension('framework', [
        'profiler' => ['only_exceptions' => false]
    ]);
};
