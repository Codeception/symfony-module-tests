<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

#[AsCommand('app:ask-for-input', 'An example command asking for user input.')]
final class AskForInputCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        $question = new ConfirmationQuestion('continue?', false);
        if (!$helper->ask($input, $output, $question)) {
            $output->writeln('bye');

            return Command::FAILURE;
        }

        $question = new Question('input');
        $answer = $helper->ask($input, $output, $question);

        $output->writeln("user input: '$answer'");

        return Command::SUCCESS;
    }
}
