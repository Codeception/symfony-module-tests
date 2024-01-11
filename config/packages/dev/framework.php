<?php

declare(strict_types=1);

use Symfony\Config\FrameworkConfig;

return static function (FrameworkConfig $framework): void {
    // Web Profiler
    $framework->profiler([
        'only_exceptions' => false,
        'collect_serializer_data' => true,
    ]);
};
