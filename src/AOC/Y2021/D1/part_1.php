<?php

use AOC\Services\Read;

$puzzle = Read::lineByline(__DIR__ . '/puzzle.php');

$previous = null;
$increaseCount = 0;

foreach ($puzzle as $value) {
    $previous < $value && $previous
        ? $increaseCount++
        : '';
    $previous = $value;
}

if (getenv('env') !== 'testing') {
    var_dump($increaseCount);
}

return $increaseCount;
