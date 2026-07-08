<?php

declare(strict_types=1);

use Codeception\Config\SuiteConfig;

return SuiteConfig::create()
    ->actor('FunctionalTester')
    ->module('Asserts')
    ->module('Symfony', ['app_path' => 'src', 'environment' => 'test'])
    ->module('Doctrine', ['cleanup' => true], depends: 'Symfony');
