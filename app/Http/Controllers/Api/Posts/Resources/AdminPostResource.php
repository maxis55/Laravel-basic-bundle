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
            'name'=>$this->name,
            'type'=>$this->type,
            'cover'=>'<img src="'.asset("storage/$this->cover").'" alt="cover" class="img-responsive">',
            'created_at'=>$this->created_at->diffForHumans(),
            'buttons'=>
                '<div class="btn-group">
                         <a href="' . route('admin.posts.edit', $this->id) . '"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Редактировать</a>
                         <a data-confirmation="Вы уверены?" href="'.route('admin.posts.destroy', $this->id).'"
                                 class="btn btn-danger btn-sm delete_element"><i class="fa fa-times"></i> Удалить
                         </a>
                     </form>
                 </div>'
        ];
    }
}
