<?php

require __DIR__.'/../../vendor/autoload.php';

use Classes\ReadPuzzle;

$puzzle = ReadPuzzle::lineByline(__DIR__.'/puzzle.php');

$horizontal = 0;
$depth = 0;
$aim = 0;

foreach ($puzzle as $value) {
    if (preg_match("/forward (\d+)/", $value, $forward)) {
        $horizontal += $forward[1];
        $depth += $forward[1] * $aim;
    } elseif (preg_match("/up (\d+)/", $value, $up)) {
        $aim -= $up[1];
    } elseif (preg_match("/down (\d+)/", $value, $down)) {
        $aim += $down[1];
    }
}

dump($horizontal * $depth);
