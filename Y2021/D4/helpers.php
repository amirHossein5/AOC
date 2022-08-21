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

        if ((int) $drawedCount === 5) {
            $solved = true;
            break;
        }
        if ($countedRows === 5) {
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

        if ((int) $drawedCount === 5) {
            $solved = true;
            break;
        }
        if ($countedCols === 5) {
            $countedCols = 0;
            $drawedCount = 0;
        }
    }

    return $solved;
}
