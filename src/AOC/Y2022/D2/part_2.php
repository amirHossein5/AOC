<?php

use AOC\Services\Read;

require_once 'helpers.php';

$puzzle = Read::lineByline(__DIR__.'/puzzle.txt');
$rockPaperGames = collect($puzzle)->chunk(3);
$decodeMovements = [
    'againstMove' => ['A' => ROCK, 'B' => PAPER, 'C' => SEASOR],
];
$decodePreferedMatchesResult = [ // true as win, false as fail, null as draw
    'X' => false, 'Y' => null, 'Z' => true
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
        $round += 1;
        [$againstMove, $yourMove] = explode(' ', $movements);
        $againstMove = $decodeMovements['againstMove'][$againstMove];
        $wonRound = $decodePreferedMatchesResult[$yourMove];
        $yourMove = getMovementIf(won: $wonRound, againstMove: $againstMove);

        if (is_null($wonRound)) {
            $totalScore += $drawScore;
        } else if ($wonRound) {
            $totalScore += $wonScore;
        } else {
            $totalScore += $lostScore;
        }
        $totalScore += $movementScores[$yourMove];
    }
}

if (getenv('env') !== 'testing') {
    var_dump($totalScore);
}

return $totalScore;

