<?php

require __DIR__.'/../../vendor/autoload.php';

use Classes\Read;

$puzzle = Read::lineByline(__DIR__.'/puzzle.php');

$readKeysAfter = null;
$firstN = null;
$secondN = null;
$summedNumbers = [];

foreach ($puzzle as $key => $value) {
    if ($readKeysAfter >= $key && $readKeysAfter) {
        continue;
    }

    $firstN = $value +
        (isset($puzzle[$key + 1]) ? $puzzle[$key + 1] : 0) +
        (isset($puzzle[$key + 2]) ? $puzzle[$key + 2] : 0);
    $secondN =
        (isset($puzzle[$key + 1]) ? $puzzle[$key + 1] : 0) +
        (isset($puzzle[$key + 2]) ? $puzzle[$key + 2] : 0) +
        (isset($puzzle[$key + 3]) ? $puzzle[$key + 3] : 0);

    $readKeysAfter = $key + 1;
    $summedNumbers[] = $firstN;
    $summedNumbers[] = $secondN;
}

$prevN = null;
$isGreaterCount = 0;

foreach ($summedNumbers as $number) {
    ! ($number > $prevN && $prevN) ?: $isGreaterCount++;
    $prevN = $number;
}

if (env() !== 'testing') {
    var_dump($isGreaterCount);
}
return $isGreaterCount;
