<?php


namespace Main\UniqueSymbols;

interface CacheInterface
{
    public function set(string $key, int $value): void;

    public function get(string $key);

    public function hasKey(string $key): bool;
}