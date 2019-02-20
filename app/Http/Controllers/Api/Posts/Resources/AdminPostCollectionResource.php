<?php

namespace App\Http\Controllers\Api\Posts\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminPostCollectionResource extends ResourceCollection
{

    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = 'App\Http\Controllers\Api\Posts\Resources\AdminPostResource';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
//            'recordsTotal'=>$this->resource->total(),
//            'recordsFiltered'=>$this->resource->total()
        ];
    }
}
