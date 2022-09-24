<?php

namespace AOC\Traits;

trait HasFormattedOutput
{
    protected function write(string $string): void
    {
        if (! isset($this->output)) {
            echo $string;

            return;
        }
        $this->output->write($string);
    }

    protected function line(string $string): void
    {
        if (! isset($this->output)) {
            echo $string.PHP_EOL;

            return;
        }
        $this->output->writeln($string);
    }

    protected function newLine(int $newLine = 1): void
    {
        for ($i = 0; $i < $newLine; $i++) {
            $this->line('');
        }
    }

    protected function info(string $string): void
    {
        echo $this->line($this->getColor('info').$string.$this->endColor());
    }

    protected function success(string $string): void
    {
        echo $this->line($this->getColor('success').$string.$this->endColor());
    }

    protected function error(string $string): void
    {
        echo $this->line($this->getColor('error').$string.$this->endColor());
    }

    protected function warn(string $string): void
    {
        echo $this->line($this->getColor('warn').$string.$this->endColor());
    }

    protected function command(string $sh): mixed
    {
        return shell_exec($sh);
    }

    protected function getColor(string $mod): string
    {
        return [
            'info' => "\e[94m",
            'success' => "\e[92m",
            'error' => "\e[91m",
            'warn' => "\e[93m",
        ][$mod];
    }

    protected function endColor(): string
    {
        return "\e[0m";
    }
}
