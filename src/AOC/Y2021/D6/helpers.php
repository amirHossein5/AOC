<?php

function initLanterFishAges(array &$lanterFishes, array $ages, int $newLanterFishAge = 8): void
{
    for ($i = 0; $i <= $newLanterFishAge; $i++) {
        $lanterFishes[$i] = 0;
    }

    foreach ($ages as $age) {
        $lanterFishes[$age]++;
    }
}
