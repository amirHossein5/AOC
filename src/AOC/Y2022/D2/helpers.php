<?php

const ROCK = 'rock';
const PAPER = 'paper';
const SEASOR = 'seasor';

function haveWonRockPaper(
    string $yourMove,
    string $againstMove
): ?bool {
    if ($yourMove === $againstMove) {
        return null;
    }

    if ($yourMove === ROCK and $againstMove === PAPER) {
        return false;
    }
    if ($yourMove === ROCK and $againstMove === SEASOR) {
        return true;
    }

    if ($yourMove === PAPER and $againstMove === ROCK) {
        return true;
    }
    if ($yourMove === PAPER and $againstMove === SEASOR) {
        return false;
    }

    if ($yourMove === SEASOR and $againstMove === ROCK) {
        return false;
    }
    if ($yourMove === SEASOR and $againstMove === PAPER) {
        return true;
    }

    throw new \Exception("{$yourMove}, {$againstMove}, movement unmatched. valid movements: ". ROCK .', '. PAPER.', '. SEASOR);
}

/**
 * $won can be true as won, false as failed, null as draw
 * @param  ?bool $won
 * @param  string $againstMove
 * @return string
 */
function getMovementIf(?bool $won, $againstMove): string
{
    if (is_null($won)) {
        return getMovementIfDrawed($againstMove);
    }

    if ($won) {
        return getMovementIfWon($againstMove);
    }

    return getMovementIfLost($againstMove);
}

function getMovementIfDrawed(string $againstMove): string
{
    return [
        ROCK => ROCK,
        PAPER => PAPER,
        SEASOR => SEASOR,
    ][$againstMove];
}

function getMovementIfLost(string $againstMove): string
{
    return [
        ROCK => SEASOR,
        PAPER => ROCK,
        SEASOR => PAPER,
    ][$againstMove];
}

function getMovementIfWon(string $againstMove): string
{
    return [
        ROCK => PAPER,
        PAPER => SEASOR,
        SEASOR => ROCK,
    ][$againstMove];
}
