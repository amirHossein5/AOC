<?php

use AOC\Services\Read;

$puzzle = explode(PHP_EOL, Read::contents(__DIR__ . '/puzzle.txt'));

$elvesCalories = [];
$totalElfCalory = 0;

foreach ($puzzle as $line) {
    if ($line === '') {
        $elvesCalories[] = $totalElfCalory;
        $totalElfCalory = 0;
        continue;
    }

    $totalElfCalory += (int) $line;
}

$elvesCalories[] = $totalElfCalory;
$totalElfCalory = 0;

$topThreeElvesCalories = collect($elvesCalories)
    ->sortDesc()
    ->take(3)
    ->sum();

if (getenv('env') !== 'testing') {
    dump($topThreeElvesCalories);
}

return $topThreeElvesCalories;
