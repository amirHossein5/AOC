<?php

namespace Classes;

class ReadPuzzle
{
    public static function lineByline(string $path): array
    {
        return explode(PHP_EOL, trim(file_get_contents($path)));
    }
}
