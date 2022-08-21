<?php

/**
 * Vardump and die.
 *
 * @param mixed params
 */
function dd(mixed ...$params): mixed
{
    foreach ($params as $param) {
        var_dump($param);
    }
    exit;
}

/**
 * Alias of var_dump.
 *
 * @param mixed params
 */
function dump(mixed ...$params): void
{
    foreach ($params as $param) {
        var_dump($param);
    }
}
