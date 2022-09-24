<?php

namespace Tests\Traits;

Trait TestableDays
{
    public function test_days()
    {
        $this->newLine();
        $this->warn('Y2021');

        foreach (array_reverse($this->answers) as $day => $parts) {
            $this->write($this->getColor('success').'day '.str_replace('D', '', $day).'-> '.$this->endColor());

            foreach ($parts as $part => $expectedAnswer) {
                $answer = (int) include_once $this->getPathToYear()."/{$day}/{$part}.php";

                if ($answer !== $expectedAnswer) {
                    $this->fail(
                        "{{$day}/{$part}.php} failed. expectedAnswer: {$expectedAnswer}, realAnswer: {$answer}."
                    );
                }

                $this->write($this->getColor('success').'P'.str_replace('part_', '', $part).' '.$this->endColor());
                $this->assertEquals($answer, $expectedAnswer);
            }

            $this->newLine();
        }
    }
}
