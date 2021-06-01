<?php

declare(strict_types=1);

use Symfony\Config\DoctrineConfig;

return static function (DoctrineConfig $doctrine): void
{
    $doctrineDbal = $doctrine->dbal();
    $doctrineDbal->connection('default', [
        'url' => '%env(resolve:DATABASE_URL)%'
    ]);

    $doctrineOrm = $doctrine->orm();
    $doctrineOrm->autoGenerateProxyClasses(true);
    $doctrineOrm->entityManager('default', [
        'naming_strategy' => 'doctrine.orm.naming_strategy.underscore_number_aware',
        'auto_mapping' => true,
        'mappings' => [
            'App' => [
                'is_bundle' => false,
                'type' => 'annotation',
                'dir' => '%kernel.project_dir%/src/Entity',
                'prefix' => 'App\Entity',
                'alias' => 'App'
            ]
        ]
    ]);
};
