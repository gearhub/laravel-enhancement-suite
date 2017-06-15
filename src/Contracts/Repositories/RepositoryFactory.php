<?php

namespace GearHub\LaravelEnhancementSuite\Contracts\Repositories;

interface RepositoryFactory
{
    /**
     * Get repository for the corresponding model.
     * If $key is null return instance of the factory.
     *
     * @param  string|null $key
     *
     * @return mixed
     */
    public function get($key = null);
}
