<?php

declare(strict_types=1);

use Symfony\Config\DoctrineConfig;

return static function (DoctrineConfig $doctrine): void {
    $doctrineOrm = $doctrine->orm();
    $defaultEm = $doctrineOrm->entityManager('default');
    $defaultConnection = $doctrine->dbal()->connection('default');

    $defaultConnection
        ->url('%env(resolve:DATABASE_URL)%')
        ->profilingCollectBacktrace('%kernel.debug%');

    $doctrineOrm
        ->autoGenerateProxyClasses(true)
        ->enableLazyGhostObjects(true);
    $defaultEm
        ->autoMapping(true)
        ->namingStrategy('doctrine.orm.naming_strategy.underscore_number_aware')
        ->reportFieldsWhereDeclared(true)
        ->validateXmlMapping(true)
        ->mapping('App', [
            'alias' => 'App',
            'dir' => '%kernel.project_dir%/src/Entity',
            'is_bundle' => false,
            'prefix' => 'App\Entity',
            'type' => 'attribute',
        ]);
};
