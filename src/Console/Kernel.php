<?php

namespace AOC\Console;

use Symfony\Component\Console\Application;

class Kernel
{
    public function registerCommands()
    {
        $this->load(__DIR__.'/Commands');
    }

    public function load(string $path): void
    {
        $application = new Application();

        $path = realpath(trim($path));

        foreach ([...glob("{$path}/**/*.php"), ...glob("{$path}/*.php")] as $commandClass) {
            $application->add(
                new (str_replace(
                    '/',
                    '\\',
                    str_replace(
                        '.php',
                        '',
                        str_replace(src_path(), 'AOC', $commandClass)
                    )
                )
                )
            );
        }

        $application->run();
    }
}
