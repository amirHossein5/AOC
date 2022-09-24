<?php

namespace AOC\Console;

class GeneratorCommand extends Command
{
    private string $generatedFilePath;
    private string $generatedFileNamespace;

    public function handle(): int
    {
        $this->generatedFileClassName = array_slice(explode('/', $this->argument('name')), -1)[0];
        $this->generatedFilePath = $this->namespaceToPath($this->getDefaultNamespace('AOC'))."/{$this->argument('name')}.php";
        $this->generatedFileNamespace = $this->pathToNamespace(str_replace($this->getClassName().'.php', '', $this->getPath()));

        if (file_exists($this->getPath())) {
            $this->error('File already exists In: '.$this->getPath());
            exit;
        }

        if (! is_dir($dir = dirname($this->getPath()))) {
            mkdir($dir, 0777, true);
        }

        file_put_contents($this->getPath(), file_get_contents($this->getStub()));

        return Command::SUCCESS;
    }

    protected function getPath(): string
    {
        return $this->generatedFilePath;
    }

    protected function getClassName(): string
    {
        return $this->generatedFileClassName;
    }

    protected function getNamespace(): string
    {
        return $this->generatedFileNamespace;
    }

    protected function appendVariables(string $content, array $vars)
    {
        foreach ($vars as $var => $value) {
            $content = str_replace("{{ $var }}", $value, $content);
        }

        return $content;
    }

    protected function getVariables(string $content): array
    {
        preg_match_all('/{{\s([\w]+)\s}}/', $content, $variables);

        unset($variables[0]);

        return collect($variables)->flatten()->toArray();
    }

    private function namespaceToPath(string $namespace): string
    {
        return '/'.trim(str_replace('\\', '/', str_replace('AOC', trim(src_path(), '/'), $namespace)), '/');
    }

    private function pathToNamespace(string $path): string
    {
        return trim(str_replace('/', '\\', str_replace(trim(src_path(), '/'), 'AOC', $path)), '\\');
    }
}
