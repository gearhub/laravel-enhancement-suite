<?php

namespace GearHub\LaravelEnhancementSuite\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class HandlerMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:les-handler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new handler class.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Handler';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (! $this->option('command')) {
            return $this->error('Missing required option: --command');
        }

        parent::handle();
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        return class_exists($rawName);
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function buildClass($name)
    {
        $command = $this->laravel->getNamespace() . $this->laravel['config']['les.command_namespace'] . '\\' . $this->option('command');

        $stub = str_replace(
            'DummyCommand', class_basename($command), parent::buildClass($name)
        );

        return str_replace(
            'DummyFullCommand', str_replace('/', '\\', $command), $stub
        );
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../stubs/handler.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\\' . $this->laravel['config']['les.handler_namespace'];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['command', 'c', InputOption::VALUE_REQUIRED, 'The command class that will be used in the handler.']
        ];
    }
}
