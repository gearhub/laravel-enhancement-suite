<?php

namespace GearHub\LaravelEnhancementSuite\Tests;

use GearHub\LaravelEnhancementSuite\LaravelEnhancementSuiteServiceProvider;
use GearHub\LaravelEnhancementSuite\Contracts\Repositories\RepositoryFactory;
use Orchestra\Testbench\TestCase;

class HelpersTest extends TestCase
{
    /** @test */
    public function it_returns_an_instance_of_the_repository_factory_if_no_parameters()
    {
        $this->assertInstanceOf(RepositoryFactory::class, repository());
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
