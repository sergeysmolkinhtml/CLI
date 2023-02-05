<?php

declare(strict_types=1);
namespace Main\UniqueSymbols;

require "vendor/autoload.php";


use Main\Command\FileStringCommand;
use Symfony\Component\Console\Application;



//echo "Output: " . (new UniqueSymbolsClass(new CacheClass()))->findOrCompute("342") . "\r\n";

$application = new Application();
$application->add(new FileStringCommand());
$application->run();