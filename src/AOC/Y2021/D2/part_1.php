<?php

use AOC\Services\Read;

$puzzle = Read::contents(__DIR__ . '/puzzle.php');

preg_match_all("/forward (\d+)/", $puzzle, $forwards);
preg_match_all("/down (\d+)/", $puzzle, $downwards);
preg_match_all("/up (\d+)/", $puzzle, $upwards);

$horizontal = 0;
$depth = 0;

foreach ($forwards[1] as $number) {
    $horizontal += $number;
}
foreach ($downwards[1] as $number) {
    $depth += $number;
}
foreach ($upwards[1] as $number) {
    $depth -= $number;
}

if (getenv('env') !== 'testing') {
    var_dump($horizontal * $depth);
}

return $horizontal * $depth;
