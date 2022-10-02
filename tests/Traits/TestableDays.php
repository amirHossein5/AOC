<?php

namespace Tests\Traits;

trait TestableDays
{
    public function test_days()
    {
        $this->newLine();
        $this->warn('Y2021');

        foreach (array_reverse($this->answers) as $day => $parts) {
            $this->write($this->color('day '.str_replace('D', '', $day).'-> ', 'success'));

            foreach ($parts as $part => $expectedAnswer) {
                $answer = (int) include_once $this->getPathToYear()."/{$day}/{$part}.php";

                if ($answer !== $expectedAnswer) {
                    $this->fail(
                        "{{$day}/{$part}.php} failed. expectedAnswer: {$expectedAnswer}, realAnswer: {$answer}."
                    );
                }

                $this->write($this->color('P'.str_replace('part_', '', $part).' ', 'success'));
                $this->assertEquals($answer, $expectedAnswer);
            }

            $this->newLine();
        }
    }
}
