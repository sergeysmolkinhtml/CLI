<?php


declare(strict_types=1);

namespace Main\UniqueSymbols;

interface UniqueSymbolsInterface
{
    /**
     * @param string $string
     * @return int
     */
    public function getUniqueSymbols(string $string): int;
}