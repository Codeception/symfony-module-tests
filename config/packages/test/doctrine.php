<?php

declare(strict_types=1);

use Symfony\Config\DoctrineConfig;

return static function (DoctrineConfig $doctrine): void
{
    $doctrineDbal = $doctrine->dbal();
    $doctrineDbal->connection('default'
    )->dbname('main_test%env(default::TEST_TOKEN)%');
};
