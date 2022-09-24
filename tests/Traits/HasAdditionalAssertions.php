<?php

namespace Tests\Traits;

trait HasAdditionalAssertions
{
    protected function assertStrContains(string $haystack, string $needle)
    {
        $this->assertTrue(
            str_contains($haystack, $needle)
        );
    }

    protected function assertStrDoesNotContain(string $haystack, string|array $needle)
    {
        if (is_array($needle)) {
            foreach ($needle as $string) {
                $this->assertFalse(
                    str_contains($string, $haystack)
                );
            }
        } else {
            $this->assertFalse(
                str_contains($haystack, $needle)
            );
        }
    }
}
