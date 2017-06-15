<?php

namespace GearHub\LaravelEnhancementSuite\Repositories;

use GearHub\LaravelEnhancementSuite\Contracts\Repositories\RepositoryFactory as RepositoryFactoryContract;

class RepositoryFactory implements RepositoryFactoryContract
{
    /**
     * Mapping keys to repositories. Takes precidence over the dynamic resolution.
     *
     * @var array
     */
    protected $overrides = [];

    /**
     * Create new instance of RepositoryFactory.
     *
     * @param  array $overrides
     *
     * @return void
     */
    public function __construct(array $overrides = [])
    {
        $this->overrides = $overrides;
    }

    /**
     * Get repository for the corresponding model.
     * If $key is null return instance of the factory.
     *
     * @param  string|null $key
     *
     * @return mixed
     */
    public function get($key = null)
    {
        if (!empty($key)) {
            $class = null;

            if (array_has($this->overrides, $key)) {
                $class = array_get($this->overrides, $key);
            } else {
                $class = $this->build($key);
            }

            return resolve($class);
        }

        return $this;
    }

    /**
     * Build the path of the Repository class.
     *
     * @param  string $key
     *
     * @return string
     */
    protected function build($key)
    {
        return app()->getNamespace() . $this->laravel['config']['les.repository_namespace'] . '\\' . studly_case(str_singular($key)) . 'Repository';
    }
}
