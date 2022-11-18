<?php

namespace Tests\Feature;

use Tests\Traits\TestableDays;

class Y2021_Test extends \Tests\TestCase
{
    use TestableDays;

    private array $answers = [
        'D6' => [
            'part_1' => 352872,
            'part_2' => 1604361182149,
        ],
        'D5' => [
            'part_1' => 7269,
            'part_2' => 21140,
        ],
        'D4' => [
            'part_1' => 6592,
            'part_2' => 31755,
        ],
        'D3' => [
            'part_1' => 1307354,
            'part_2' => 482500,
        ],
        'D2' => [
            'part_1' => 1893605,
            'part_2' => 2120734350,
        ],
        'D1' => [
            'part_1' => 1466,
            'part_2' => 1491,
        ],
    ];

    private function getPathToYear()
    {
        return src_path() . '/AOC/Y2021';
    }
}
