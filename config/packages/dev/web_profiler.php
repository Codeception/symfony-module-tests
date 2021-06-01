<?php

declare(strict_types=1);

use Symfony\Config\WebProfilerConfig;

return static function (WebProfilerConfig $webProfiler): void
{
    $webProfiler
        ->toolbar(true)
        ->interceptRedirects(false)
    ;
};
