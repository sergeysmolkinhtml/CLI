<?php

namespace Main\Command;

use Exception;
use JetBrains\PhpStorm\Pure;
use Main\UniqueSymbols\CacheClass;
use Main\UniqueSymbols\UniqueSymbolsClass;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;



class FileStringCommand extends Command
{
    private CacheClass $changedFile;

    public function __construct(string $name = null)
    {
        $this->changedFile = new CacheClass();
        parent::__construct($name);
    }

    protected static $defaultDescription = 'Works with args';

    public function configure()
    {
        $this->setName('app:fileNstring')
            ->setDescription('Sets both string or file')
            ->setHelp('Set arguments')
            ->addOption(
                'file',
                'f',
                InputOption::VALUE_REQUIRED,
                'Type a file',
                null
            )
            ->addOption(
                'string',
                's',
                InputOption::VALUE_OPTIONAL,
                'Type a string',
                null);

        return $_SERVER['argv'];
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $file = $input->getOption('file');
        $string = $input->getOption('string');

        $args = $_SERVER['argv'][2];
        var_dump($args);

        if (($file) || ($file && $string)) {
            $this->changedFile->stringsFile = $file;
            $data = (new UniqueSymbolsClass($this->changedFile))->findOrCompute($string ?? '123');
            $output->writeln($data);
        } else {
            $string = $input->getOption('string');
            $data = (new UniqueSymbolsClass($this->changedFile))->findOrCompute($string);
            $output->writeln($data);
        }

        return 1;
    }


}


