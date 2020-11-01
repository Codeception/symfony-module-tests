<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $config): void
{
    $config->extension('sensio_framework_extra', [
        'router' => [
            'annotations' => false
        ]
    ]);
};
