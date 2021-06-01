<?php

declare(strict_types=1);

use Symfony\Config\DebugConfig;

return static function (DebugConfig $debug): void
{
    $debug->dumpDestination('tcp://%env(VAR_DUMPER_SERVER)%');
};
