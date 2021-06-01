<?php

declare(strict_types=1);

use Symfony\Config\TwigConfig;

return static function (TwigConfig $twig): void
{
    $twig->defaultPath('%kernel.project_dir%/resources/views');
    $twig->global('business_shortname')->value('%app.business_shortname%');
    $twig->global('business_shortname')->value('%app.business_fullname%');
};
