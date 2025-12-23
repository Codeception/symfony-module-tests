<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(ExampleCommand::COMMAND_NAME, 'An example command.')]
final class ExampleCommand extends Command
{
    public const COMMAND_NAME = 'app:example-command';

    /** @var string */
    private const OPTION_SOMETHING = 'something';

    /** @var string */
    private const OPTION_SHORT_SOMETHING = 's';

    private ?SymfonyStyle $ioStream = null;

    protected function configure(): void
    {
        $this->addOption(
            self::OPTION_SOMETHING,
            self::OPTION_SHORT_SOMETHING,
            InputOption::VALUE_NONE,
            'Give some output'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->ioStream = new SymfonyStyle($input, $output);

        $optionSomething = $input->getOption(self::OPTION_SOMETHING);
        if ($optionSomething) {
            $this->ioStream->text('Bye world!');
        } else {
            $this->ioStream->text('Hello world!');
        }

        return Command::SUCCESS;
    }
}
