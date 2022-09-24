<?php

namespace Tests;

use AOC\Traits\HasFormattedOutput;
use Tests\Traits\HasAdditionalAssertions;

class TestCase extends \PHPUnit\Framework\TestCase
{
    use HasFormattedOutput;
    use HasAdditionalAssertions;

    protected array $unlinkFilesForTesting = [];

    protected array $unlinkFoldersForTesting = [];

    public function setUp(): void
    {
        $this->unlinkForTesting();
    }

    public function tearDown(): void
    {
        $this->unlinkForTesting();
    }

    private function unlinkForTesting(): void
    {
        foreach ($this->unlinkFilesForTesting as $path) {
            $path = pathable($path);

            if (file_exists($path)) {
                unlink($path);
            }
        }
        foreach ($this->unlinkFoldersForTesting as $dirName) {
            $path = pathable($path);

            if (is_dir($dirName)) {
                rmdir($dirName);
            }
        }
    }
}
