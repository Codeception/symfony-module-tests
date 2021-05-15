<?php

declare(strict_types=1);

use Symfony\Config\MonologConfig;

return static function (MonologConfig $monolog): void
{
    $monolog->handler('main', [
        'type' => 'fingers_crossed',
        'action_level' => 'error',
        'handler' => 'nested',
    ])->channel('!event')->excludedHttpCode()->code(404)->code(405);
    $monolog->handler('nested', [
        'type' => 'stream',
        'path' => '%kernel.logs_dir%/%kernel.environment%.log',
        'level' => 'debug'
    ]);
};
