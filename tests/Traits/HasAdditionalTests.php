<?php

namespace Tests\Traits;

trait HasAdditionalTests
{
    protected function assertStrContains(string $haystack, string $needle)
    {
        $this->assertTrue(
            str_contains($haystack, $needle)
        );
    }
    protected function assertStrDoesNotContain(string $haystack, string $needle)
    {
        $this->assertFalse(
            str_contains($haystack, $needle)
        );
    }
}
