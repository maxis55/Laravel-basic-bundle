<?php

namespace App\Http\Controllers\Api\Posts;


use App\Http\Controllers\Api\Posts\Resources\AdminPostCollectionResource;
use App\Http\Controllers\Api\Posts\Resources\AdminPostResource;
use App\Models\Post;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function adminIndex(Request $request)
    {


//        return new AdminPostResource(Post::find(1));
//        return AdminPostResource::collection(Post::latest()->paginate(20));

        return Laratables::recordsOf(Post::class);
       // $skip=$request->input('start');
//        dd($skip);
//        dd(Post::latest()->simplePaginate());
//        return (new AdminPostCollectionResource(Post::latest()->simplePaginate()))
//            ->additional(['draw'=>intval($request->input('draw'))]);

    }
}
