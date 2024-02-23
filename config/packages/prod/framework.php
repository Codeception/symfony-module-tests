<?php

declare(strict_types=1);

use Symfony\Config\FrameworkConfig;

return static function (FrameworkConfig $framework): void {
    // Doctrine
    $framework->cache()
        ->pool('doctrine.result_cache_pool')->adapters(['cache.app'])
        ->pool('doctrine.system_cache_pool')->adapters(['cache.system']);

    // Routing
    $framework->router()
        ->strictRequirements(null);
};
