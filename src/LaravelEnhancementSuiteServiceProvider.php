<?php

namespace GearHub\LaravelEnhancementSuite;

use GearHub\LaravelEnhancementSuite\Console\RepositoryMakeCommand;
use GearHub\LaravelEnhancementSuite\Console\TransformerMakeCommand;
use GearHub\LaravelEnhancementSuite\Contracts\Serializers\DataSerializer;
use Illuminate\Support\ServiceProvider;

class LaravelEnhancementSuiteServiceProvider extends ServiceProvider
{
    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        'command.les.repository.make',
        'command.les.transformer.make',
    ];

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('les.php')
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array_merge($this->commands, [DataSerializer::class]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'les');

        $this->registerCommands();
        $this->registerDataSerializer();
    }

    /**
     * Register the given commands.
     *
     * @param  array $commands
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->registerRepositoryMakeCommand();
        $this->registerTransformerMakeCommand();

        $this->commands($this->commands);
    }

    /**
     * Register the data serializer.
     *
     * @return void
     */
    protected function registerDataSerializer()
    {
        $this->app->singleton(DataSerializer::class, function ($app) {
            return $app->make($this->config('serializer'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRepositoryMakeCommand()
    {
        $this->app->singleton('command.les.repository.make', function ($app) {
            return new RepositoryMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerTransformerMakeCommand()
    {
        $this->app->singleton('command.les.transformer.make', function ($app) {
            return new TransformerMakeCommand($app['files']);
        });
    }

    /**
     * Helper to get config values.
     *
     * @param  string      $key
     * @param  string|null $default
     *
     * @return string
     */
    protected function config($key, $default = null)
    {
        return config("les.$key", $default);
    }
}
