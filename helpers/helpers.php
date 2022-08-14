<?php

/**
 * Vardump and die.
 *
 * @param mixed params
 * @return mixed
 */
function dd(mixed ... $params): mixed {
    foreach($params as $param) {
        var_dump($param);
    }
    exit;
}

/**
 * Alias of var_dump.
 *
 * @param mixed params
 * @return void
 */
function dump(mixed ... $params): void {
    foreach($params as $param) {
        var_dump($param);
    }
}
