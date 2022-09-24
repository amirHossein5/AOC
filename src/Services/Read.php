<?php

namespace AOC\Services;

class Read
{
    /**
     * Outputs puzzle line by line in array.
     *
     * @param  string  $path  [can be content]
     */
    public static function lineByline(string $path): array
    {
        return explode(PHP_EOL, trim(self::contents($path)));
    }

    /**
     * A trimed file_get_contents.
     */
    public static function contents(string $path): string
    {
        if (is_writable($path)) {
            return trim(file_get_contents($path));
        } else {
            return trim($path);
        }
    }

    /**
     * Returns the first line.
     */
    public static function firstLine(string $path): string
    {
        return self::lineByline($path)[0];
    }

    /**
     * Returns the intended line.
     *
     * @param  string  $line
     * @return string|null
     */
    public static function getLine(string $path, int $line): string|null
    {
        return self::lineByline($path)[$line];
    }

    /**
     * Replaces intended line of content.
     */
    public static function putLine(string $path, int $line, string $content): bool|string
    {
        $fullContent = Read::lineByline($path);
        $fullContent[$line] = $content;

        return self::put_contents($path, implode(PHP_EOL, $fullContent));
    }

    /**
     * Replaces and puts intended content.
     */
    public static function put_contents(string $path, string $content): bool|string
    {
        if (is_writable($path)) {
            return file_put_contents($path, $content);
        } else {
            return $content;
        }
    }
}
