<?php

namespace Tests;

use AOC\Traits\HasFormattedOutput;
use Tests\Traits\HasAdditionalTests;

class TestCase extends \PHPUnit\Framework\TestCase
{
    use HasFormattedOutput, HasAdditionalTests;

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
            if (file_exists($path)) {
                unlink($path);
            }
        }
        foreach ($this->unlinkFoldersForTesting as $dirName) {
            if (is_dir($dirName)) {
                rmdir($dirName);
            }
        }
    }
}
