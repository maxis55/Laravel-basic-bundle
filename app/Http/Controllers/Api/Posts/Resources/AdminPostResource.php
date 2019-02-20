<?php

namespace App\Http\Controllers\Api\Posts\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'type'=>$this->type,
            'cover'=>asset($this->cover),
            'created_at'=>$this->created_at->diffForHumans()
        ];
    }
}
