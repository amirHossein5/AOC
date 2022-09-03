<?php

require __DIR__.'/../../vendor/autoload.php';
require 'helpers.php';

use Classes\Read;

$puzzle = Read::lineByline(__DIR__.'/puzzle.php');

// oxygen
$filtered = $puzzle;
$oxygenGR = null;

for ($i = 0; $i < strlen($filtered[0]); $i++) {
    if ($oxygenGR) {
        break;
    }

    $oneCount = 0;
    $zeroCount = 0;

    foreach ($filtered as $number) {
        0 === (int) $number[$i]
            ? $zeroCount++
            : $oneCount++;
    }

    if (0 === $zeroCount or 0 === $oneCount) {
        continue;
    } elseif ($zeroCount === $oneCount) {
        $filtered = filterHasChar(indexOf: $i, char: '1', items: $filtered);
    } elseif ($zeroCount > $oneCount) {
        $filtered = filterHasChar(indexOf: $i, char: '0', items: $filtered);
    } elseif ($zeroCount < $oneCount) {
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

    foreach ($filtered as $number) {
        0 === (int) $number[$i]
            ? $zeroCount++
            : $oneCount++;
    }

    if (0 === $zeroCount or 0 === $oneCount) {
        continue;
    } elseif ($zeroCount === $oneCount) {
        $filtered = filterHasChar(indexOf: $i, char: '0', items: $filtered);
    } elseif ($zeroCount > $oneCount) {
        $filtered = filterHasChar(indexOf: $i, char: '1', items: $filtered);
    } elseif ($zeroCount < $oneCount) {
        $filtered = filterHasChar(indexOf: $i, char: '0', items: $filtered);
    }
}

$CO2GR = $filtered[0];

if (env() !== 'testing') {
    var_dump(bindec($CO2GR) * bindec($oxygenGR));
}

return bindec($CO2GR) * bindec($oxygenGR);
