<?php

declare(strict_types=1);

use Symfony\Config\MonologConfig;

return static function (MonologConfig $monolog): void
{
    $monolog->handler('main', [
        'type' => 'stream',
        'path' => '%kernel.logs_dir%/%kernel.environment%.log',
        'level' => 'debug',
    ])->channel('!event');
    $monolog->handler('console', [
        'type' => 'console',
        'process_psr_3_messages' => false,
    ])->channels()->elements(['!event', '!doctrine', '!console']);
};
