<?php

namespace GearHub\LaravelEnhancementSuite\Http\Responses;

use GearHub\LaravelEnhancementSuite\Contracts\Serializers\DataSerializer;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection as FractalCollection;
use League\Fractal\Resource\Item as FractalItem;

class ResponseBuilder
{
    /**
     * Manager instance.
     *
     * @var \League\Fractal\Manager
     */
    protected $manager;

    /**
     * Create new instance of ResponseBuilder.
     *
     * @param  \League\Fractal\Manager $manager
     * @param  \GearHub\LaravelEnhancementSuite\Contracts\Serializers\DataSerializer $serializer
     *
     * @return void
     */
    function __construct(Manager $manager, DataSerializer $serializer)
    {
        $this->manager = $manager;

        $this->manager->setSerializer($serializer);
    }

    /**
     * Create a new json response from a collection resource.
     *
     * @param  \Illuminate\Support\Collection $collection
     * @param  callable|\League\Fractal\TransformerAbstract $transformer
     * @param  string $key
     * @param  int|string $status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withCollection($collection, $transformer, $key = 'data', $status = 200)
    {
        $resource = new FractalCollection($collection, $transformer, $key);

        return response()->json($this->build($resource), $status);
    }

    /**
     * Create a new json response from an item resource.
     *
     * @param  mixed $item
     * @param  callable|\League\Fractal\TransformerAbstract $transformer
     * @param  string $key
     * @param  int|string $status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withItem($item, $transformer, $key = 'data', $status = 200)
    {
        $resource = new FractalItem($item, $transformer, $key);

        return response()->json($this->build($resource), $status);
    }

    /**
     * Create a new json response from a paginator resource.
     *
     * @param  mixed $paginator
     * @param  callable|\League\Fractal\TransformerAbstract $transformer
     * @param  string $key
     * @param  int|string $status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withPaginator($paginator, $transformer, $key = 'data', $status = 200)
    {
        $resource = new FractalCollection($paginator->getCollection(), $transformer, $key);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

        return response()->json($this->build($resource), $status);
    }

    /**
     * Create a new json response from raw data.
     *
     * @param  mixed $paginator
     * @param  \League\Fractal\TransformerAbstract $transformer
     * @param  string $key
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function withRaw($raw, $key = 'data', $status = 200)
    {
        return response()->json([$key => $raw], $status);
    }

    /**
     * Create a new no content response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function noContent()
    {
        return response()->json([], 204);
    }

    /**
     * Build the response data.
     *
     * @param  \League\Fractal\Resource\ResourceAbstract $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function build($data)
    {
        return $this->manager->createData($data)->toArray();
    }
}
