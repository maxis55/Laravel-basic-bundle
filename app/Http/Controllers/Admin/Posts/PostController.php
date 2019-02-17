<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::paginate(20);
        return view('admin.posts.index',['posts'=>$posts]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $post=auth()->user()->posts()->save(new Post($request->except('_token', '_method')));

        return redirect()->route('admin.posts.edit', $post->id)->with('message', 'Создание успешно');
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Post $post)
    {
        return view('admin.posts.show',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Post $post)
    {

        $post->update($request->except('_token', '_method'));

        $request->session()->flash('message', 'Редактирование успешно');

        return redirect()->route('admin.posts.edit', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();
            request()->session()->flash('message', 'Удаление успешно');
        } catch (\Exception $e) {
            request()->session()->flash('message', 'Удаление не успешно. '.$e->getMessage());
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Request $request
     */
    public function removeImage(Post $post)
    {
        $result = Storage::disk('public')->delete($post->cover);
        $result = $post->update(['cover' => null]) && $result;

        request()->session()->flash('message', 'Изображение успешно удалено');
        return redirect()->route('admin.posts.edit', $post->id);
    }

}
