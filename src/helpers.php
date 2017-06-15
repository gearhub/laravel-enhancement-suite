<?php

if (! function_exists('repository')) {

    /**
     * Find corresponding repository if it exists.
     *
     * @param  string|null $key
     *
     * @return string
     */
    function repository($key = null)
    {
        return resolve('repositories')->get($key);
    }
}
