<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Command\ExampleCommand;
use App\Command\ResultCommand;
use App\Tests\Support\FunctionalTester;

final class ConsoleCest
{
    public function runSymfonyConsoleCommand(FunctionalTester $I)
    {
        // Call Symfony console without option
        $output = $I->runSymfonyConsoleCommand(ExampleCommand::COMMAND_NAME);
        $I->assertStringContainsString('Hello world!', $output);

        // Call Symfony console with short option
        $output = $I->runSymfonyConsoleCommand(
            ExampleCommand::COMMAND_NAME,
            ['-s' => true]
        );
        $I->assertStringContainsString('Bye world!', $output);

        // Call Symfony console with long option
        $output = $I->runSymfonyConsoleCommand(
            ExampleCommand::COMMAND_NAME,
            ['--something' => true]
        );
        $I->assertStringContainsString('Bye world!', $output);
    }

    public function consoleExecutionResult(FunctionalTester $I): void
    {
        $I->assertCommandIsSuccessful($I->runCommand(ResultCommand::COMMAND_NAME));
        $I->assertCommandFailed($I->runCommand(ResultCommand::COMMAND_NAME, ['--fail' => true]));
        $I->assertCommandIsInvalid($I->runCommand(ResultCommand::COMMAND_NAME, ['--invalid' => true]));

        $result = $I->runCommand(ResultCommand::COMMAND_NAME, ['--fail' => true]);
        $I->assertStringContainsString('Something failed.', $result->getErrorOutput());
        $I->assertCommandResultEquals($result, expectedStatusCode: 1);
    }
}
