<?php

require __DIR__ . '/../../vendor/autoload.php';

use Classes\Read;

$puzzle = Read::lineByline(__DIR__ . '/puzzle.php');

$gammaR = null;
$epsilonR = null;

for ($i = 0; $i < strlen($puzzle[0]); $i++) {
    $oneCount = 0;
    $zeroCount = 0;

    foreach ($puzzle as $number) {
        0 === (int) $number[$i]
            ? $zeroCount++
            : $oneCount++;
    }

    $zeroCount > $oneCount
        ? $gammaR .= '0'
        : $gammaR .= '1';
    $zeroCount > $oneCount
        ? $epsilonR .= '1'
        : $epsilonR .= '0';
}

$gammaRDecimal = bindec($gammaR);
$epsilonRDecimal = bindec($epsilonR);

return $epsilonRDecimal * $gammaRDecimal;
