<?php

use AOC\Services\Read;

require_once __DIR__.'/helpers.php';

$puzzle = Read::firstLine(__DIR__.'/puzzle.txt');
$lanterFishes = explode(',', $puzzle);
$days = 80;
$newLanterFishAge = 8;
$lanterFishRefreshAge = 6;

for ($i = 1; $i <= $days; $i++) {
    foreach ($lanterFishes as $lanterFish => $age) {
        if ($lanterFishes[$lanterFish] === 0) {
            $lanterFishes[$lanterFish] = $lanterFishRefreshAge;
            $lanterFishes[] = $newLanterFishAge;
        } else {
            $lanterFishes[$lanterFish]--;
        }
    }
}

if (env() !== 'testing') {
    var_dump(count($lanterFishes));
}

return count($lanterFishes);
