<?php

/**
 * This file is part of the Laravel Enhancement Suite package.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Serializer
    |--------------------------------------------------------------------------
    |
    | Specify the serializer that will be used in the response builder.
    |
    */
    'serializer' => \GearHub\LaravelEnhancementSuite\Serializers\EmberDataRestSerializer::class,


    /*
    |--------------------------------------------------------------------------
    | Repository Namespace
    |--------------------------------------------------------------------------
    |
    | Specify the Repository namespace that will be appended to the
    | application's root namespace.
    |
    */
    'repository_namespace' => 'Repositories',

    /*
    |--------------------------------------------------------------------------
    | Transformer Namespace
    |--------------------------------------------------------------------------
    |
    | Specify the Transformer namespace that will be appended to the
    | application's root namespace.
    |
    */
    'transformer_namespace' => 'Transformers',

];
