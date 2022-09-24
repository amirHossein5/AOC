<?php

function getCoordinatesArray(int $x1, int $y1, int $x2, int $y2): array
{
    return
    [
        1 => [
            'x' => $x1,
            'y' => $y1,
        ],
        2 => [
            'x' => $x2,
            'y' => $y2,
        ],
    ];
}
