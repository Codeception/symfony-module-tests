<?php

declare(strict_types=1);

use Symfony\Config\FrameworkConfig;

return static function (FrameworkConfig $framework): void {
    $uid = $framework->uid();
    $uid->defaultUuidVersion(7);
    $uid->timeBasedUuidVersion(7);
};
