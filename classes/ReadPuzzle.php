<?php

namespace Classes;

class ReadPuzzle
{
    /**
     * Outputs puzzle line by line in array.
     *
     * @param  string  $path
     * @return array
     */
    public static function lineByline(string $path): array
    {
        return explode(PHP_EOL, trim(file_get_contents($path)));
    }

    /**
     * A trimed file_get_contents.
     *
     * @param  string  $path
     * @return string
     */
    public static function contents(string $path): string
    {
        return trim(file_get_contents($path));
    }

    /**
     * Returns the first line.
     *
     * @param  string  $path
     * @return string
     */
    public static function firstLine(string $path): string
    {
        return self::lineByline($path)[0];
    }
}
