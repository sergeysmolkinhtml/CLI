<?php

declare(strict_types=1);


namespace Main\UniqueSymbols;

use Exception;


class UniqueSymbolsClass implements UniqueSymbolsInterface
{
    private CacheInterface $cache;


    public function __construct(CacheInterface $cache = null)
    {
        $this->cache = $cache ?? new CacheClass();
    }


    /**
     * @throws Exception
     */
    public function findOrCompute($string): ?int
    {
        if ($this->cache->hasKey($string)) {
            echo 'Cached';
            return $this->cache->get($string);
        } else {
            echo 'NOT CACHED';

            $result = self::getUniqueSymbols($string);

            $this->cache->set($string,$this->getUniqueSymbols($string));

            return $result;

        }
    }

    /**
     * @param string $string
     * @return integer
     */
    public function getUniqueSymbols(string $string): int
    {
        if ($string === '') {
            return 0;
        }

        $computed = self::countCharacters($string);
        $uniqueCharacters = 0;

        foreach ($computed as $character => $total) {
            if ($total === 1) {
                $uniqueCharacters++;
            }
        }

        return $uniqueCharacters;
    }

    private static function countCharacters(string $string): array
    {
        if ($string === '') {
            return [];
        }

        $characters = str_split($string);
        $counted = [];

        foreach ($characters as $character) {
            $counted[$character] = isset($counted[$character]) ? ++$counted[$character] : 1;
        }

        return $counted;
    }
}

