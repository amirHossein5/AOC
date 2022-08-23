<?php

namespace Tests\Feature;

class Y2021_Test extends \Tests\TestCase
{
    private array $answers = [
        'D5' => [
            'part_1' => 7269,
            // 'part_2' => '',
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

    private string $pathToYear = __DIR__ . '/../../Y2021';

    public function testDays()
    {
        foreach ($this->answers as $day => $parts) {
            foreach ($parts as $part => $expectedAnswer) {
                $answer = (int) include_once $this->pathToYear . "/{$day}/{$part}.php";
                $answer === $expectedAnswer
                    ? $this->assertEquals($answer, $expectedAnswer)
                    : $this->fail(
                        "{{$day}/{$part}.php} failed. expectedAnswer: {$expectedAnswer}, realAnswer: {$answer}."
                    );
            }
        }
    }
}
