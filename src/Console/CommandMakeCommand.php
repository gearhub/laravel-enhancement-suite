<?php

namespace GearHub\LaravelEnhancementSuite\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class CommandMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:les-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new command class.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Command';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if (parent::fire() === false) {
            return;
        }

        if ($this->option('with-handler')) {
            $this->createCommandHandler();
        }
    }

    /**
     * Create a handler for the command.
     *
     * @return void
     */
    protected function createCommandHandler()
    {
        $handler = $this->argument('name');

        $this->call('make:les-handler', [
            'name'    => "{$handler}Handler",
            '--event' => $this->argument('name')
        ]);
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
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../stubs/command.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\\' . $this->laravel['config']['les.command_namespace'];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['with-handler', null, InputOption::VALUE_NONE, 'Make a handler for the newly created command.']
        ];
    }
}
