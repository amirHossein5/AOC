<?php

/**
 * Vardump and die.
 *
 * @param  mixed  $params
 * @return mixed
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
 * @param  mixed  $params
 * @return void
 */
function dump(mixed ...$params): void
{
    foreach ($params as $param) {
        var_dump($param);
    }
}

function base_path(): string
{
    return pathable(realpath(__DIR__.'/../../'));
}

function src_path(): string
{
    return pathable(base_path().'/src');
}

function stubs_path(): string
{
    return pathable(base_path().'/stubs');
}

function env(): string
{
    return getenv('env');
}

function pathable(string $path): string
{
    return str_replace('/', DIRECTORY_SEPARATOR, $path);
}
