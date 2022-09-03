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

/**
 * Alias of Collect class.
 *
 * @param  mixed  $param
 * @return \Classes\Collect
 */
function collect(array|\Classes\Collect $param): \Classes\Collect
{
    return (new \Classes\Collect)->collect($param);
}

/**
 * Flatten a multi-dimensional array into a single level.
 *
 * @param  iterable  $array
 * @param  null|int  $depth
 * @return array
 */
function flatten($array, $depth = null): array
{
    $result = [];

    foreach ($array as $item) {
        $item = $item instanceof Collection ? $item->all() : $item;

        if (! is_array($item)) {
            $result[] = $item;
        } else {
            $values = $depth === 1
                ? array_values($item)
                : flatten($item, $depth - 1);

            foreach ($values as $value) {
                $result[] = $value;
            }
        }
    }

    return $result;
}

function env(): string
{
    return getenv('env');
}
