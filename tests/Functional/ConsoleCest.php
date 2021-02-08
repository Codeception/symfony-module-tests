<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Command\ExampleCommand;
use App\Tests\FunctionalTester;

final class ConsoleCest
{
    public function runSymfonyConsoleCommand(FunctionalTester $I)
    {
        // Call Symfony console without option
        $output = $I->runSymfonyConsoleCommand(ExampleCommand::getDefaultName());
        $I->assertStringContainsString('Hello world!', $output);

        // Call Symfony console with short option
        $output = $I->runSymfonyConsoleCommand(
            ExampleCommand::getDefaultName(),
            ['-s' => true]
        );
        $I->assertStringContainsString('Bye world!', $output);

        // Call Symfony console with long option
        $output = $I->runSymfonyConsoleCommand(
            ExampleCommand::getDefaultName(),
            ['--something' => true]
        );
        $I->assertStringContainsString('Bye world!', $output);
    }
}
