<?php

declare(strict_types=1);

use Codeception\Config\GlobalConfig;
use Codeception\Extension\RunFailed;

return GlobalConfig::create()
    ->namespace('App\Tests')
    ->supportNamespace('Support')
    ->paths(
        tests: 'tests',
        output: 'tests/_output',
        data: 'tests/Support/Data',
        support: 'tests/Support',
        envs: 'tests/_envs',
    )
    ->actorSuffix('Tester')
    ->extension(RunFailed::class)
    ->params('.env', '.env.test')
    ->settings(shuffle: true, colors: true, reportUselessTests: true);
