<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(ResultCommand::COMMAND_NAME, 'A command exercising the execution result paths.')]
final class ResultCommand extends Command
{
    public const COMMAND_NAME = 'app:result-command';

    protected function configure(): void
    {
        $this->addOption('fail', null, InputOption::VALUE_NONE);
        $this->addOption('invalid', null, InputOption::VALUE_NONE);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($input->getOption('invalid')) {
            $output->writeln('Invalid input.');

            return Command::INVALID;
        }

        if ($input->getOption('fail')) {
            if ($output instanceof ConsoleOutputInterface) {
                $output->getErrorOutput()->writeln('Something failed.');
            }

            return Command::FAILURE;
        }

        $output->writeln('All good.');

        return Command::SUCCESS;
    }
}
