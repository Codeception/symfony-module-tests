<?php

declare(strict_types=1);

use Symfony\Config\MonologConfig;

return static function (MonologConfig $monolog): void
{
    $monolog->handler('main', [
        'type' => 'fingers_crossed',
        'action_level' => 'error',
        'handler' => 'nested',
        'buffer_size' => 50
    ])->excludedHttpCode()->code(404)->code(405);
    $monolog->handler('nested', [
        'type' => 'stream',
        'path' => 'php://stderr',
        'level' => 'debug',
        'formatter' => 'monolog.formatter.json'
    ]);
    $monolog->handler('console', [
        'type' => 'console',
        'process_psr_3_messages' => false
    ])->channels()->elements(['!event', '!doctrine']);
};
