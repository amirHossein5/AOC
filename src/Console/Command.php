<?php

namespace AOC\Console;

use AOC\Traits\HasFormattedOutput;
use InvalidArgumentException;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Command extends SymfonyCommand
{
    use HasFormattedOutput;

    protected InputInterface $input;

    protected OutputInterface $output;

    protected string $signature;

    protected string $description;

    public function __construct()
    {
        [$name, $arguments, $options] = Parser::parse($this->signature);

        parent::__construct($this->name = $name);
        $this->getDefinition()->addArguments($arguments);
        $this->getDefinition()->addOptions($options);
        $this->setDescription((string) $this->description);
    }

    abstract public function handle(): int;

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->input = $input;
        $this->output = $output;

        return $this->handle();
    }

    protected function arguments(): array
    {
        return $this->input->getArguments();
    }

    protected function argument(string $argument, mixed $default = null): mixed
    {
        if (! isset($this->arguments()[$argument])) {
            return $default;
        }

        return $this->arguments()[$argument];
    }

    protected function options(): array
    {
        return $this->input->getOptions();
    }

    protected function option(string $option): mixed
    {
        return $this->options()[$option];
    }
}
