<?php

use AOC\Services\Read;

$puzzle = explode(PHP_EOL, Read::contents(__DIR__.'/puzzle.txt'));

$elvesCalories = [];
$totalElfCalory = 0;

foreach($puzzle as $line) {
    if ($line === '') {
        $elvesCalories[] = $totalElfCalory;
        $totalElfCalory = 0;
        continue;
    }

    $totalElfCalory += (int) $line;
}

$elvesCalories[] = $totalElfCalory;
$totalElfCalory = 0;

$maxCallory = collect($elvesCalories)->max();

if (getenv('env') !== 'testing') {
    dump($maxCallory);
}

return $maxCallory;
