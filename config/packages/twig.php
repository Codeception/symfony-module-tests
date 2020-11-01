<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $config): void
{
    $config->extension('twig', [
        'default_path' => '%kernel.project_dir%/resources/views',
        'globals' => [
            'business_shortname' => '%app.business_shortname%',
            'business_fullname' => '%app.business_fullname%'
        ]
    ]);
};
