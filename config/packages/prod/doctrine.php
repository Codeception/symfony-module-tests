<?php

declare(strict_types=1);

use Symfony\Config\DoctrineConfig;

return static function (DoctrineConfig $doctrine): void {
    $doctrineOrm = $doctrine->orm();
    $defaultEm = $doctrineOrm->entityManager('default');

    $doctrineOrm
        ->autoGenerateProxyClasses(false)
        ->proxyDir('%kernel.build_dir%/doctrine/orm/Proxies');
    $defaultEm->resultCacheDriver()
        ->type('pool')
        ->pool('doctrine.result_cache_pool');
    $defaultEm->resultCacheDriver()
        ->type('pool')
        ->pool('doctrine.system_cache_pool');
};
