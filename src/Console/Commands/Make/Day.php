<?php

namespace AOC\Console\Commands\Make;

use Illuminate\Console\Command;

class Day extends Command
{
    protected $signature = 'make:day {year} {day}';

    protected $description = 'Create a new AOC day.';

    public function handle(): int
    {
        $dir = src_path() . '/AOC/Y' . $this->argument('year') . '/D' . $this->argument('day');
        $dir = pathable($dir);

        if (! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        collect(['part_1.php', 'part_2.php'])->each(
            fn ($file) => $this->createFile(filePath: pathable("{$dir}/{$file}"))
        );

        collect(['puzzle.txt'])->each(
            fn ($file) => $this->createFile(
                filePath: pathable("{$dir}/{$file}"),
                hasStub: false,
            )
        );

        return Command::SUCCESS;
    }

    protected function getStub()
    {
        return stubs_path() . '/AOCPart.stub';
    }

    private function createFile(string $filePath, bool $hasStub = true): void
    {
        $fileName = basename($filePath);

        if (file_exists($filePath)) {
            $this->error("File {$fileName} already exists.");

            return;
        }

        if ($hasStub) {
            file_put_contents($filePath, file_get_contents($this->getStub()));
        } else {
            file_put_contents($filePath, '');
        }

        $this->info("File {$fileName} Created successfully.");
    }
}
