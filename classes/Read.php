<?php

namespace Classes;

class Read
{
    /**
     * Outputs puzzle line by line in array.
     *
     * @param  string  $path [can be content]
     * @return array
     */
    public static function lineByline(string $path): array
    {
        return explode(PHP_EOL, trim(self::contents($path)));
    }

    /**
     * A trimed file_get_contents.
     *
     * @param  string  $path
     * @return string
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
     *
     * @param  string  $path
     * @return string
     */
    public static function firstLine(string $path): string
    {
        return self::lineByline($path)[0];
    }

    /**
     * Returns the intended line.
     *
     * @param  string  $path
     * @param  string  $line
     * @return string
     */
    public static function getLine(string $path, int $line): string
    {
        return self::lineByline($path)[$line];
    }

    /**
     * Replaces intended line of content.
     *
     * @param  string  $path
     * @param  int  $line
     * @param  string  $content
     * @return bool|string
     */
    public static function putLine(string $path, int $line, string $content): bool|string
    {
        $fullContent = Read::lineByline($path);
        $fullContent[$line] = $content;

        return self::put_contents($path, implode(PHP_EOL, $fullContent));
    }

    /**
     * Replaces and puts intended content.
     *
     * @param  string  $path
     * @param  string  $content
     * @return bool|string
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
