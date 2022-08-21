<?php

require __DIR__.'/../../vendor/autoload.php';
require 'helpers.php';

use Classes\Read;

$input = Read::firstLine(__DIR__.'/puzzle.php');
$puzzle = Read::lineByline(__DIR__.'/puzzle.php');
unset($puzzle[0]);

// separating bingoes
$bingoes = [];
$skipAfterKey = null;

foreach ($puzzle as $i => $data) {
    if ($skipAfterKey >= $i && $skipAfterKey) {
        continue;
    }
    if (! trim($data)) {
        continue;
    }

    // add complete bingo to data
    for ($in = 1; $in < 5; $in++) {
        $data .= ' '.$puzzle[$in + $i];
    }

    // to array
    $data = array_filter(explode(' ', $data), fn ($val) => trim($val) !== '');
    $d = array_values($data);

    $bingoes[] = [
        'rows' => [
            $d[00] => false, $d[01] => false, $d[02] => false, $d[03] => false, $d[04] => false,
            $d[05] => false, $d[06] => false, $d[07] => false, $d[8] => false, $d[9] => false,
            $d[10] => false, $d[11] => false, $d[12] => false, $d[13] => false, $d[14] => false,
            $d[15] => false, $d[16] => false, $d[17] => false, $d[18] => false, $d[19] => false,
            $d[20] => false, $d[21] => false, $d[22] => false, $d[23] => false, $d[24] => false,
        ],
        'columns' => [
            $d[00] => false, $d[05] => false, $d[10] => false, $d[15] => false, $d[20] => false,
            $d[01] => false, $d[06] => false, $d[11] => false, $d[16] => false, $d[21] => false,
            $d[02] => false, $d[07] => false, $d[12] => false, $d[17] => false, $d[22] => false,
            $d[03] => false, $d[8] => false, $d[13] => false, $d[18] => false, $d[23] => false,
            $d[04] => false, $d[9] => false, $d[14] => false, $d[19] => false, $d[24] => false,
        ],
        'lastDraw' => '',
        'drawedNumbers' => [],
    ];
    $skipAfterKey = $i + 4;
}

// draw numbers
$input = explode(',', $input);
$solvedBingo = null;
$lastSolved = null;

foreach ($input as $inputKey => $number) {
    for ($i = 0; $i < count($bingoes); $i++) {
        if (isset($bingoes[$i])) {
            drawBingo(by: $number, bingo: $bingoes[$i]);
        }
    }

    // check is solved
    foreach ($bingoes as $key => $bingo) {
        if (is_bingo_solved($bingo)) {
            $lastSolved = $bingo;
            unset($bingoes[$key]);
        }
        if (count($bingoes) === 0) {
            break 2;
        }
    }

    $bingoes = array_values($bingoes);
}

$solvedBingo = $lastSolved;

// calculate last solved bingo
$sumUnmarkedNumbers = 0;

foreach ($solvedBingo['rows'] as $number => $isDrawed) {
    if (! $isDrawed) {
        $sumUnmarkedNumbers += $number;
    }
}

return ($sumUnmarkedNumbers * $solvedBingo['lastDraw']);

// [
//      [
//          rows => [
//              [22 => false, 13, 13, 1, 2
//              22, 13, 13, 1, 2
//              22, 13, 13, 1, 2
//              22, 13, 13, 1, 2
//              22, 13, 13, 1, 2]
//          ]
//          columns => [
//              [22, 22, 22, 1, 2
//              22, 13, 13, 1, 2
//              22, 13, 13, 1, 2
//              22, 13, 13, 1, 2
//              22, 13, 13, 1, 2]
//          ]
//          lastDraw => ''
//          drawedNumbers => []
//      ]
//      []
//      []
// ]
//
