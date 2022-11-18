<?php

namespace AOC\Traits;

trait HasFormattedOutput
{
    protected function write(string $string): void
    {
        echo $string;
    }

    protected function line(string $string): void
    {
        $this->write($string . PHP_EOL);
    }

    protected function newLine(int $newLine = 1): void
    {
        for ($i = 0; $i < $newLine; $i++) {
            $this->line('');
        }
    }

    protected function info(string $string): void
    {
        echo $this->line($this->color($string, 'info'));
    }

    protected function success(string $string): void
    {
        echo $this->line($this->color($string, 'success'));
    }

    protected function error(string $string): void
    {
        echo $this->line($this->color($string, 'error'));
    }

    protected function warn(string $string): void
    {
        echo $this->line($this->color($string, 'warn'));
    }

    protected function command(string $sh): mixed
    {
        return shell_exec($sh);
    }

    protected function color(string $string, string $color): string
    {
        return [
            'info' => "\e[94m{$string}\e[0m",
            'success' => "\e[92m{$string}\e[0m",
            'error' => "\e[91m{$string}\e[0m",
            'warn' => "\e[93m{$string}\e[0m",
        ][$color];
    }
}
