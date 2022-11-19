<?php

use AOC\Services\Read;

$puzzle = Read::contents(__DIR__.'/puzzle.txt');
$puzzle = collect(explode(',', $puzzle));

$midNumber = $puzzle->sort()->values()->get(
    $puzzle->count() / 2
);

$spentFuel = 0;

$puzzle->each(function ($number) use (&$spentFuel, $midNumber) {
    $spentFuel += abs($number - $midNumber);
});

if (getenv('env') !== 'testing') {
    var_dump($spentFuel);
}

return $spentFuel;
