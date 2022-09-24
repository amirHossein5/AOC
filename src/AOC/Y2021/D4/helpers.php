<?php

function drawBingo(int $by, array &$bingo): void
{
    isset($bingo['rows'][$by])
        ? $bingo['rows'][$by] = true
        : null;
    isset($bingo['columns'][$by])
        ? $bingo['columns'][$by] = true
        : null;
    $bingo['lastDraw'] = $by;
    $bingo['drawedNumbers'][] = $by;
}

function is_bingo_solved(array $bingo)
{
    $solved = false;

    // check for rows
    $countedRows = 0;
    $drawedCount = 0;

    foreach ($bingo['rows'] as $number => $isDrawed) {
        $countedRows++;
        ! $isDrawed ?: $drawedCount++;

        if (5 === (int) $drawedCount) {
            $solved = true;
            break;
        }
        if (5 === $countedRows) {
            $countedRows = 0;
            $drawedCount = 0;
        }
    }

    // check for cols
    $countedCols = 0;
    $drawedCount = 0;

    foreach ($bingo['columns'] as $number => $isDrawed) {
        $countedCols++;
        ! $isDrawed ?: $drawedCount++;

        if (5 === (int) $drawedCount) {
            $solved = true;
            break;
        }
        if (5 === $countedCols) {
            $countedCols = 0;
            $drawedCount = 0;
        }
    }

    return $solved;
}
