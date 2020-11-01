<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class ExampleCommand extends Command
{
    private $ioStream;

    protected static $defaultName = 'app:example-command';

    protected function configure()
    {
        $this->setDescription('An example command.');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->ioStream = new SymfonyStyle($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->ioStream->text('Hello world!');

        return 0;
    }
}
