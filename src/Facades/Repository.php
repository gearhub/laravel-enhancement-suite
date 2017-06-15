<?php

namespace GearHub\LaravelEnhancementSuite\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \GearHub\LaravelEnhancementSuite\Contracts\Repositories\RepositoryFactory
 * @see \GearHub\LaravelEnhancementSuite\Repositories\RepositoryFactory
 */
class Repository extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'repositories';
    }
}
