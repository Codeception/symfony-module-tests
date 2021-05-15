<?php

declare(strict_types=1);

use Symfony\Config\DoctrineConfig;

return static function (DoctrineConfig $doctrine): void
{
    $doctrineOrm = $doctrine->orm();
    $doctrineOrm->autoGenerateProxyClasses(false);
    $doctrineOrm->entityManager('default', [
        'metadata_cache_driver' => [
            'type' => 'pool',
            'pool' => 'doctrine.system_cache_pool'
        ],
        'query_cache_driver' => [
            'type' => 'pool',
            'pool' => 'doctrine.system_cache_pool'
        ],
        'result_cache_driver' => [
            'type' => 'pool',
            'pool' => 'doctrine.result_cache_pool'
        ]
    ]);
};
