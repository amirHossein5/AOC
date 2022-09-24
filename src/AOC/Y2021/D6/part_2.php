<?php

use AOC\Services\Read;

require_once(__DIR__.'/helpers.php');

$puzzle = Read::firstLine(__DIR__.'/puzzle.txt');
$days = 256;
$newLanterFishAge = 8;
$lanterFishRefreshAge = 6;

/** @var array<int, int> age, countOfThem */
$lanterFishes = [];

/** @var array<int, int> age, countOfThem */
$newDayFishes = [];

initLanterFishAges($lanterFishes, ages: explode(',', $puzzle));

for ($i=1; $i <= $days; $i++) {
    initLanterFishAges($newDayFishes, ages: []);

    foreach ($lanterFishes as $age => $countOfThem) {
        if ($age === 0) {
            if ($countOfThem >= 1) {
                $newDayFishes[$lanterFishRefreshAge] = $lanterFishes[$age];
                $newDayFishes[$newLanterFishAge] = $lanterFishes[$age];
            }
        } else {
            $newDayFishes[$age-1] = $lanterFishes[$age] + $newDayFishes[$age-1];
        }
    }
    $lanterFishes = $newDayFishes;
}

$lanterFishCount = collect($lanterFishes)->sum();

if (env() !== 'testing') {
    var_dump($lanterFishCount);
}

return $lanterFishCount;
