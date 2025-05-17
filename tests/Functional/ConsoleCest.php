<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Command\AskForInputCommand;
use App\Command\ExampleCommand;
use App\Tests\Support\FunctionalTester;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\MissingInputException;

final class ConsoleCest
{
    public function runSymfonyConsoleCommand(FunctionalTester $I): void
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

    public function runSymfonyConsoleCommandInput(FunctionalTester $I): void
    {
        // Confirmation question not confirmed
        $output = $I->runSymfonyConsoleCommand(
            AskForInputCommand::getDefaultName(),
            consoleInputs: ['n'],
            expectedExitCode: Command::FAILURE,
        );
        $I->assertStringContainsString('bye', $output);

        // Exception on missing input
        $I->expectThrowable(
            MissingInputException::class,
            fn () => $I->runSymfonyConsoleCommand(
                AskForInputCommand::getDefaultName(),
                consoleInputs: ['y'],
            ),
        );

        // Multiple inputs
        $output = $I->runSymfonyConsoleCommand(
            AskForInputCommand::getDefaultName(),
            consoleInputs: ['y', 'foobar'],
        );
        $I->assertStringContainsString("user input: 'foobar'", $output);
    }
}
