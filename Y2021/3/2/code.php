<?php

require(__DIR__ . '/../../../vendor/autoload.php');
require('helpers.php');

use Classes\ReadPuzzle;
$puzzle = ReadPuzzle::lineByline(__DIR__ . '/puzzle.php');

// oxygen
$filtered = $puzzle;
$oxygenGR = null;

for ($i = 0; $i < strlen($filtered[0]); $i++) {
    if ($oxygenGR) {
        break;
    }

    $oneCount = 0;
    $zeroCount = 0;

    foreach ($filtered as $number){
        (int) $number[$i] === 0
            ? $zeroCount ++
            : $oneCount ++;
    }

    if ($zeroCount === 0 or $oneCount === 0) {
        continue;
    } else if ($zeroCount === $oneCount) {
        $filtered = filterHasChar(indexOf: $i, char: '1', items: $filtered);
    } else if ($zeroCount > $oneCount) {
        $filtered = filterHasChar(indexOf: $i, char: '0', items: $filtered);
    } else if ($zeroCount < $oneCount) {
        $filtered = filterHasChar(indexOf: $i, char: '1', items: $filtered);
    }
}

$oxygenGR = $filtered[0];

// CO2
$filtered = $puzzle;
$CO2GR = null;

for ($i = 0; $i < strlen($filtered[0]); $i++) {
    if ($CO2GR) {
        break;
    }

    $oneCount = 0;
    $zeroCount = 0;

    foreach ($filtered as $number){
        (int) $number[$i] === 0
            ? $zeroCount ++
            : $oneCount ++;
    }

    if ($zeroCount === 0 or $oneCount === 0) {
        continue;
    } else if ($zeroCount === $oneCount) {
        $filtered = filterHasChar(indexOf: $i, char: '0', items: $filtered);
    } else if ($zeroCount > $oneCount) {
        $filtered = filterHasChar(indexOf: $i, char: '1', items: $filtered);
    } else if ($zeroCount < $oneCount) {
        $filtered = filterHasChar(indexOf: $i, char: '0', items: $filtered);
    }
}

$CO2GR = $filtered[0];

dump(
    bindec($CO2GR) * bindec($oxygenGR)
);
