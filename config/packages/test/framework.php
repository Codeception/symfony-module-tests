<?php

declare(strict_types=1);

use Symfony\Config\FrameworkConfig;

return static function (FrameworkConfig $framework): void {
    // Framework
    $framework->test(true);
    $framework->session()
        ->storageFactoryId('session.storage.factory.mock_file');

    // Validator
    $framework->validation()
        ->notCompromisedPassword()
        ->enabled(false);

    // Web Profiler
    $framework->profiler([
        'collect' => false
    ]);
};
