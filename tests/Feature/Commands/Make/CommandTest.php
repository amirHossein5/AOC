<?php

namespace Tests\Feature\Commands\Make;

use Tests\TestCase;

class CommandTest extends TestCase
{
    public function test_creates_new_command()
    {
        $this->unlinkFilesForTesting[] = $testCommandPath = src_path().'/Console/Commands/TestingCommand.php';

        $this->assertFileDoesNotExist($testCommandPath);

        $this->command('php aoc make:command TestingCommand');

        $this->assertFileExists($testCommandPath);
    }

    public function test_creates_new_command_with_nested_directories()
    {
        $this->unlinkFilesForTesting[] = $testCommandPath = src_path().'/Console/Commands/Test1/Test2/TestingCommand.php';
        $this->unlinkFoldersForTesting[] = src_path().'/Console/Commands/Test1/Test2';
        $this->unlinkFoldersForTesting[] = src_path().'/Console/Commands/Test1';


        $this->assertFileDoesNotExist($testCommandPath);

        $this->command('php aoc make:command Test1/Test2/TestingCommand');

        $this->assertFileExists($testCommandPath);
    }

    public function test_fails_when_command_exists()
    {
        $this->unlinkFilesForTesting[] = $testCommandPath = src_path().'/Console/Commands/TestingCommand.php';

        $this->command('php aoc make:command TestingCommand');

        $this->assertFileExists($testCommandPath);

        $this->assertStrContains(
            $this->command('php aoc make:command TestingCommand'),
            "File already exists In: ".$testCommandPath
        );
    }

    public function test_command_option()
    {
        $this->unlinkFilesForTesting[] = $testCommandPath = src_path().'/Console/Commands/TestingCommand.php';

        $this->assertFileDoesNotExist($testCommandPath);

        $this->command('php aoc make:command TestingCommand --command=test:command');

        $this->assertStrContains(file_get_contents($testCommandPath), 'test:command');
        $this->assertStrDoesNotContain(file_get_contents($testCommandPath), 'command:name');

        $this->assertFileExists($testCommandPath);
    }
}
