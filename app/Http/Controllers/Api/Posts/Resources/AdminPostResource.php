<?php

namespace App\Http\Controllers\Api\Posts\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'       => $this->name,
            'type'       => $this->type,
            'cover'      => '<img src="' . asset("storage/$this->cover") . '" alt="cover" class="img-responsive">',
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
