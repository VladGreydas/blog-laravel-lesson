<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('index', compact('posts'));

    }

    public function create()
    {
        return view('create');
    }

    public function store(StoreRequest $request)
    {
        $post = Post::query()->create($request->validated());

        return redirect(route('posts.show', compact('post')));
    }

    public function show(Post $post)
    {
        return view('post', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('edit', compact('post'));
    }

    public function update(Post $post, StoreRequest $request)
    {
        $post->update($request->validated());

        return redirect(route('posts.index'));
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect(route('posts.index'));
    }
}
