<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class ExampleCommand extends Command
{
    private const OPTION_SOMETHING = 'something';
    private const OPTION_SHORT_SOMETHING = 's';

    private $ioStream;

    protected static $defaultName = 'app:example-command';

    protected function configure()
    {
        $this->setDescription('An example command.');

        $this->addOption(
            self::OPTION_SOMETHING,
            self::OPTION_SHORT_SOMETHING,
            InputOption::VALUE_NONE,
            'Give some output'
        );
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->ioStream = new SymfonyStyle($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($input->getOption(self::OPTION_SOMETHING)) {
            $this->ioStream->text('Bye world!');
        } else {
            $this->ioStream->text('Hello world!');
        }
        return 0;
    }
}
