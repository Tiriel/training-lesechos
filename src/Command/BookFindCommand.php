<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:book:find',
    description: 'Add a short description for your command',
)]
class BookFindCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('lastname', InputArgument::OPTIONAL, 'Argument description')
            ->addArgument('firstname', InputArgument::IS_ARRAY, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $firstname = $input->getArgument('firstname');
        $lastname = $input->getArgument('lastname');
        if (!$lastname) {
            $lastname = $io->ask('What is your lastname ?');
        }

        $happy =$io->choice('Are you happy', ['yes', 'no']);
        if ($happy === 'yes') {
            $io->success('You are happy');
        }

        if ($firstname) {
            $io->text(sprintf("You passed a firstname : %s", implode(', ', $firstname)));
        }

        if ($lastname) {
            $io->text(sprintf("You passed a lastname : %s", $lastname));
        }

        if ($input->getOption('option1')) {
            $io->note('You passed an option');
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
