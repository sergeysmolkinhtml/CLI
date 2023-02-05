<?php
declare(strict_types=1);


class File
{
    public function read($file): bool
    {
        $stream = fopen($file, 'r+');
        fread($stream, 100);
        return is_readable($file);
    }
}