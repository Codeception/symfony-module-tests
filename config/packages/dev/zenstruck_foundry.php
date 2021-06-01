<?php

declare(strict_types=1);

use Symfony\Config\ZenstruckFoundryConfig;

return static function (ZenstruckFoundryConfig $foundry): void
{
    $foundry->autoRefreshProxies(true);
};
