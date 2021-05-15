<?php

declare(strict_types=1);

use Symfony\Config\FrameworkConfig;

return static function (FrameworkConfig $framework): void
{
    // Framework
    $framework->test(true);
    $framework->session([
        'storage_id' => 'session.storage.mock_file'
    ]);

    // Validator
    $framework->validation()
        ->notCompromisedPassword()
        ->enabled(false)
    ;

    // Web Profiler
    $framework->profiler([
        'collect' => false
    ]);
};
