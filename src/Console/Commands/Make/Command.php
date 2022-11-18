<?php

namespace AOC\Console\Commands\Make;

use AOC\Console\GeneratorCommand;

class Command extends GeneratorCommand
{
    protected $signature = 'make:command
                                    {name}
                                    {--command=command:name : The terminal command that should be assigned [default: "command:name"]}';

    protected $description = 'Creates a new AOC command';

    public function handle(): int
    {
        parent::handle();

        $generatedFileContents = file_get_contents($this->getPath());

        $this->setVariables($generatedFileContents);

        if (count($remainVars = $this->getVariables($generatedFileContents)) !== 0) {
            $this->error(implode(', ', $remainVars) . ' -> not setted.');

            unlink($this->getPath());

            return Command::FAILURE;
        }

        file_put_contents($this->getPath(), $generatedFileContents);

        $this->info('Command ' . $this->argument('name') . ' Created successfully.');

        return Command::SUCCESS;
    }

    protected function getStub()
    {
        return stubs_path() . '/console.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\\Console\\Commands';
    }

    private function setVariables(string &$generatedFileContents): void
    {
        $generatedFileContents = $this->appendVariables($generatedFileContents, [
            'namespace' => $this->getNamespace(),
            'class' => $this->getClassName(),
            'command' => $this->option('command', 'command:name'),
        ]);
    }
}
