<?php

namespace App\Helpers\Fractal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\ResourceAbstract;
use League\Fractal\Serializer\SerializerAbstract;
use League\Fractal\TransformerAbstract;

/**
 * Helper for Fractal package
 *
 * @package Classes\Fractal
 * @mixin \League\Fractal\Manager
 */
class Fractal
{
    /**
     * @var Manager
     */
    protected $manager;
    
    /**
     * @var ResourceAbstract
     */
    protected $resource;
    
    /**
     * @var SerializerAbstract
     */
    protected $serializer;
    
    /**
     * Fractal constructor.
     */
    public function __construct()
    {
        $this->manager = new Manager();
        $this->manager->setSerializer(resolve(SerializerAbstract::class));
    }
    
    /**
     * @param \Eloquent|\Illuminate\Support\Collection $data
     * @param $transformer
     *
     * @return \App\Helpers\Fractal\Fractal
     */
    public function decide($data, $transformer)
    {
        if ($data instanceof Model) {
            return $this->item($data, $transformer);
        }
        
        return $this->collection($data, $transformer);
    }
    
    /**
     * Make item with given transformer
     *
     * @param                            $item
     * @param string|TransformerAbstract $transformer
     *
     * @return Fractal
     */
    public function item($item, $transformer)
    {
        if (is_string($transformer)) {
            $transformer = new $transformer;
        }
        
        $this->resource = new Item($item, $transformer);
        
        return $this;
    }
    
    /**
     * @param                            $collection
     * @param string|TransformerAbstract $transformer
     *
     * @return Fractal
     */
    public function collection($collection, $transformer)
    {
        if (is_string($transformer)) {
            $transformer = new $transformer;
        }
        
        if ($collection instanceof LengthAwarePaginator) {
            $paginator  = $collection;
            $collection = $collection->getCollection();
        }
        
        $this->resource = new Collection($collection, $transformer);
        
        if (isset($paginator)) {
            $this->resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        }
        
        return $this;
    }
    
    /**
     * @param $funcName
     * @param $arguments
     *
     * @return Manager|mixed
     */
    public function __call($funcName, $arguments)
    {
        return $this->manager->{$funcName}($arguments);
    }
    
    /**
     * @return array
     */
    public function toArray()
    {
        return $this->manager->createData($this->getResource())->toArray();
    }
    
    /**
     * @return ResourceAbstract
     */
    public function getResource() : ResourceAbstract
    {
        return $this->resource;
    }
}