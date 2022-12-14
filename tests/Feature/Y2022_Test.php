<?php

namespace Tests\Feature;

use Tests\Traits\TestableDays;

class Y2022_Test extends \Tests\TestCase
{
    use TestableDays;

    private array $answers = [
        'D2' => [
            'part_1' => 13221,
            'part_2' => 13131,
        ],
        'D1' => [
            'part_1' => 73211,
            'part_2' => 213958,
        ],
    ];

    private function getPathToYear()
    {
        return src_path() . '/AOC/Y2022';
    }
}
