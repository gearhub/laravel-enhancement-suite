<?php

namespace GearHub\LaravelEnhancementSuite\Tests;

use GearHub\LaravelEnhancementSuite\Console\RepositoryMakeCommand;
use GearHub\LaravelEnhancementSuite\Console\TransformerMakeCommand;
use GearHub\LaravelEnhancementSuite\LaravelEnhancementSuiteServiceProvider;
use Orchestra\Testbench\TestCase;

class ServiceProviderTest extends TestCase
{
    /** @test */
    public function it_registers_the_reposity_make_console_command()
    {
        $this->assertInstanceOf(RepositoryMakeCommand::class, $this->app['command.les.repository.make']);
    }

    /** @test */
    public function it_registers_the_transformer_make_console_command()
    {
        $this->assertInstanceOf(TransformerMakeCommand::class, $this->app['command.les.transformer.make']);
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [LaravelEnhancementSuiteServiceProvider::class];
    }
}