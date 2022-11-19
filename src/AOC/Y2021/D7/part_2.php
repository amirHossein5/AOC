<?php

use AOC\Services\Read;

$puzzle = Read::contents(__DIR__ . '/puzzle.txt');
$puzzle = collect(explode(',', $puzzle));

$midNumber = floor($puzzle->sort()->values()->sum() / $puzzle->count());
$spentFuel = 0;

$puzzle->each(function ($number) use (&$spentFuel, $midNumber) {
    $difference = abs($number - $midNumber);
    $caveCost = 0;

    for ($i=1; $i <= $difference; $i++) {
        $caveCost += $i;
    }

    $spentFuel += $caveCost;
});

if (getenv('env') !== 'testing') {
    var_dump($spentFuel);
}

return $spentFuel;
