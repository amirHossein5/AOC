<?php

require(__DIR__ . '/../../vendor/autoload.php');
use Classes\ReadPuzzle;

$puzzle = ReadPuzzle::lineByline();

$previous = null;
$increaseCount = 0;

foreach ($puzzle as $value) {
    $previous < $value && $previous
        ? $increaseCount ++
        : '';
    $previous = $value;
}

var_dump($increaseCount);

