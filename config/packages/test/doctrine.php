<?php

declare(strict_types=1);

use Symfony\Config\DoctrineConfig;

return static function (DoctrineConfig $doctrine): void {
    $defaultConnection = $doctrine->dbal()->connection('default');
    $defaultConnection->dbnameSuffix('_test%env(default::TEST_TOKEN)%');
};
