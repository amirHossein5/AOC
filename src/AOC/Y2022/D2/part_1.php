<?php

use AOC\Services\Read;

require 'helpers.php';

$puzzle = Read::lineByline(__DIR__.'/puzzle.txt');
$rockPaperGames = collect($puzzle)->chunk(3);
$decodeMovements = [
    'againstMove' => ['A' => ROCK, 'B' => PAPER, 'C' => SEASOR],
    'yourMove' => ['X' => ROCK, 'Y' => PAPER, 'Z' => SEASOR],
];
$totalScore = 0;
$wonScore = 6;
$drawScore = 3;
$lostScore = 0;
$movementScores = [
    ROCK => 1,
    PAPER => 2,
    SEASOR => 3,
];

foreach($rockPaperGames as $rounds) {
    foreach($rounds as $round => $movements) {
        $round ++;
        [$againstMove, $yourMove] = explode(' ', $movements);

        $wonRound = haveWonRockPaper(
            $decodedYourMove = $decodeMovements['yourMove'][$yourMove],
            $decodeMovements['againstMove'][$againstMove]
        );

        if (is_null($wonRound)) {
            $totalScore += $drawScore;
        } else if ($wonRound) {
            $totalScore += $wonScore;
        } else {
            $totalScore += $lostScore;
        }

        $totalScore += $movementScores[$decodedYourMove];
    }
}

if (getenv('env') !== 'testing') {
    var_dump($totalScore);
}

return $totalScore;
