<?php


namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloWorldCommand extends Command
{
// the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:helloworld';

    protected function configure(): void
    {
        $this->setHelp('Just a basic HelloWorld');
        $this
            // configure an argument
            ->addArgument('username', InputArgument::REQUIRED, 'The username of the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // ... put here the code to create the user

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        $output->writeln('Whoa!');
        $section1 = $output->section();
        $section2 = $output->section();

        $section1->writeln('Hello');
        $section2->writeln('World!');
        $section1->writeln('Hello');
        $section1->writeln('Username: '.$input->getArgument('username'));
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }

}