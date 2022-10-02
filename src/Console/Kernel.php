<?php

namespace AOC\Console;

use Illuminate\Console\Application;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;

class Kernel
{
    public function registerCommands()
    {
        $this->load(__DIR__.'/Commands');
    }

    public function load(string $path): void
    {
        $application = new Application(new Container, new Dispatcher, '9');

        $path = realpath(trim($path));

        foreach ([...glob(pathable("{$path}/**/*.php")), ...glob(pathable("{$path}/*.php"))] as $commandClass) {
            $application->add(
                new (pathable(str_replace(
                    '/',
                    '\\',
                    str_replace(
                        '.php',
                        '',
                        str_replace(src_path(), 'AOC', $commandClass)
                    )
                ))
                )
            );
        }

        $application->run();
    }
}
