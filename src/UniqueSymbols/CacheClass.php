<?php

namespace Main\UniqueSymbols;

use Exception;

class CacheClass implements CacheInterface
{
    public string $stringsFile = 'cache.json';

    public function set(string $key, int $value): void
    {
        $file = file_get_contents($this->stringsFile);
        $obj = json_decode($file, true);
        $obj[$key] = $value;
        file_put_contents('cache.json', json_encode($obj, JSON_PRETTY_PRINT), LOCK_EX);
    }


    /**
     * @throws Exception
     */
    public function get(string $key): int
    {
        $stream = fopen($this->stringsFile, "r+");
        $stringsFile = fread($stream, 100);
        $arr = json_decode($stringsFile, true);

        foreach ($arr as $index=>$value){
            if(!$this->hasKey((string)$index)){
                throw new Exception("no index such like $index");
            }
        }

        return $arr[$key];
    }

    public function hasKey(string $key): bool
    {
        $stream = fopen($this->stringsFile, "r+");
        $stringsFile = fread($stream, 100);
        $arr = json_decode($stringsFile, true);
        return isset($arr[$key]);
    }
}

