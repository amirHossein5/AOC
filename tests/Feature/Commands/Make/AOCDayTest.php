<?php

namespace Tests\Feature\Commands\Make;

use Tests\TestCase;

class AOCDayTest extends TestCase
{
    /** @var array<string, string> Value would be expected content. */
    private array $expectedFiles = ['puzzle.txt' => '', 'part_1.php' => '', 'part_2.php' => ''];

    public function test_creates_new_day()
    {
        $this->unlinkFilesForTesting[] = src_path() . '/AOC/Y2021/D1/puzzle.txt';

        $dir = src_path() . '/AOC/Y2021/D1';
        $dir = pathable($dir);

        collect($this->expectedFiles)
            ->except('puzzle.txt')
            ->each(function ($key, $file) use ($dir) {
                $this->assertFileExists($path = pathable($dir . '/' . $file));
                $this->expectedFiles[$file] = file_get_contents($path);
            });

        $this->assertFileDoesNotExist(pathable($dir . '/' . 'puzzle.txt'));

        $this->command('php aoc make:day 2021 1');

        collect($this->expectedFiles)->each(function ($key, $file) use ($dir) {
            $this->assertFileExists($path = pathable($dir . '/' . $file));
            $this->assertEquals(
                file_get_contents($path),
                $this->expectedFiles[$file]
            );
        });
    }
}
