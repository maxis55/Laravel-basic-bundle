<?php

namespace App\Http\Controllers\Api\Posts;


use App\Http\Controllers\Api\Posts\Resources\AdminPostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function adminIndex()
    {
        return AdminPostResource::collection(Post::latest()->paginate(20));
    }
}
