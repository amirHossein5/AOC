<?php

require(__DIR__ . '/../../vendor/autoload.php');

use Classes\ReadPuzzle;
$puzzle = ReadPuzzle::lineByline(__DIR__ . '/puzzle.php');

$previous = null;
$increaseCount = 0;

foreach ($puzzle as $value) {
    $previous < $value && $previous
        ? $increaseCount ++
        : '';
    $previous = $value;
}

var_dump($increaseCount);

