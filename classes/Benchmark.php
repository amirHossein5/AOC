<?php

namespace Classes;

class Benchmark
{
    /**
     * @var null
     */
    private static null|int $startedAt = null;

    /**
     * Starts timer.
     * @return void
     */
    public static function startTimer(): void
    {
        self::$startedAt = microtime(true);
    }

    /**
     * Calculates excecution time.
     * @return string
     */
    public static function benchmark(): string
    {
        return number_format((float) microtime(true) - self::$startedAt, 3, '.', '') . ' sec';
    }
}
