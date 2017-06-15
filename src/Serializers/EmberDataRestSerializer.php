<?php

namespace GearHub\LaravelEnhancementSuite\Serializers;

use GearHub\LaravelEnhancementSuite\Contracts\Serializers\DataSerializer;
use League\Fractal\Serializer\ArraySerializer;

class EmberDataRestSerializer extends ArraySerializer implements DataSerializer
{
    /**
     * Serialize an item.
     *
     * @param string $resourceKey
     * @param array  $data
     *
     * @return array
     */
    public function item($resourceKey, array $data)
    {
        return [$resourceKey ?: 'data' => $data];
    }
}
