<?php

namespace Classes;

class ReadPuzzle
{
    public static function lineByline(string $path = 'puzzle.php'): array
    {
        return explode(PHP_EOL, trim(file_get_contents('puzzle.php')));
    }
}
