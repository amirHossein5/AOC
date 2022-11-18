<?php

namespace AOC\Console\Commands;

use Illuminate\Console\Command;

class RunCommand extends Command
{
    protected $signature = 'run {year} {day} {part}';

    protected $description = 'Runs a AOC part of day.';

    public function handle(): int
    {
        ['year' => $year, 'day' => $day, 'part' => $part] = $this->arguments();

        $filePath = pathable(src_path() . '/AOC/' . "Y{$year}/D{$day}/part_{$part}.php");

        if (! file_exists($filePath)) {
            $this->error("AOC Not Found: year->{$year}, day->{$day}, part->{$part}");

            return Command::INVALID;
        }

        require_once $filePath;

        return Command::SUCCESS;
    }
}
