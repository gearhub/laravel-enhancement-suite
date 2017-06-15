<?php

namespace GearHub\LaravelEnhancementSuite\Tests;

use GearHub\LaravelEnhancementSuite\Console\RepositoryMakeCommand;
use GearHub\LaravelEnhancementSuite\Console\TransformerMakeCommand;
use GearHub\LaravelEnhancementSuite\Contracts\Repositories\RepositoryFactory as RepositoryFactoryContract;
use GearHub\LaravelEnhancementSuite\Contracts\Serializers\DataSerializer;
use GearHub\LaravelEnhancementSuite\Http\Responses\ResponseBuilder;
use GearHub\LaravelEnhancementSuite\LaravelEnhancementSuiteServiceProvider;
use GearHub\LaravelEnhancementSuite\Repositories\RepositoryFactory;
use GearHub\LaravelEnhancementSuite\Serializers\EmberDataRestSerializer;
use Orchestra\Testbench\TestCase;

class ServiceProviderTest extends TestCase
{
    /** @test */
    public function it_registers_the_reposity_make_console_command()
    {
        $this->assertInstanceOf(RepositoryMakeCommand::class, $this->app['command.les.repository.make']);
    }

    /** @test */
    public function it_registers_the_response_builder_class()
    {
        $this->assertInstanceOf(ResponseBuilder::class, $this->app[ResponseBuilder::class]);
    }

    /** @test */
    public function it_registers_the_repository_factory_class()
    {
        $this->assertInstanceOf(RepositoryFactory::class, $this->app[RepositoryFactoryContract::class]);
        $this->assertInstanceOf(RepositoryFactory::class, $this->app['repositories']);
    }

    /** @test */
    public function it_registers_the_serializer_class()
    {
        $this->assertInstanceOf(EmberDataRestSerializer::class, $this->app[DataSerializer::class]);
    }

    /** @test */
    public function it_registers_the_transformer_make_console_command()
    {
        $this->assertInstanceOf(TransformerMakeCommand::class, $this->app['command.les.transformer.make']);
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Repository' => \GearHub\LaravelEnhancementSuiteApp\Facades\Repository::class
        ];
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
