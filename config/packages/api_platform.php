<?php

declare(strict_types=1);

use Symfony\Config\ApiPlatformConfig;

return static function (ApiPlatformConfig $apiPlatformConfig): void {
    $apiPlatformConfig->title('Hello API Platform');
    $apiPlatformConfig->version('1.0.0');
    $apiPlatformConfig->formats('jsonld', ['mime_types' => ['application/ld+json']]);
    $apiPlatformConfig->formats('json', ['mime_types' => ['application/json']]);
    $defaults = $apiPlatformConfig->defaults();
    $defaults->stateless(true);
    $defaults->cacheHeaders(['vary' => ['Content-Type', 'Authorization', 'Origin']]);
    $apiPlatformConfig->doctrine(['enabled' => false]);
};
