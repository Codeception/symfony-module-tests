<?php

declare(strict_types=1);

namespace App\Tests;

use Codeception\Actor;

class ApiTester extends Actor
{
    use _generated\ApiTesterActions;
}
