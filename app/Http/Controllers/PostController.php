<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Requests\Tag\IdArrayRequest;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller implements HasMiddleware
{
    public function index(Request $request): View
    {
        $posts = Post::with('category', 'tags', 'user')
            ->byCategory($request->category)
            ->byTag($request->tag)
            ->search($request->s)
            ->paginate(4)
            ->withQueryString();

        return view('posts.index', compact('posts'));

    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(StoreRequest $request, IdArrayRequest $tagsRequest): RedirectResponse
    {
        $validated = $request->validated();

        if($cover = $request->file('cover')) {
            $fileName = rand(111111, 999999).'.'.$cover->getClientOriginalExtension();
            Storage::putFileAs('covers', $cover, $fileName);
            $validated['cover'] = 'storage/covers/'.$fileName;
        }

        $post = Post::query()->create($validated);
        $post->tags()->attach($tagsRequest->tags);

        return redirect(route('posts.show', compact('post')));
    }

    public function show(Post $post): View
    {
        $post->load('category', 'tags', 'user', 'comments.user');

        $isSubscribed = $post->user->readers()->where('reader_id', auth()->id())->exists();

        return view('posts.show', compact('post', 'isSubscribed'));
    }

    public function edit(Post $post): View
    {
        Gate::authorize('postOwner', $post);
        $post->load('tags');
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, UpdateRequest $request, IdArrayRequest $tagsRequest): RedirectResponse
    {
        $validated = $request->validated();

        if($cover = $request->file('cover')) {
            $fileName = rand(111111, 999999).'.'.$cover->getClientOriginalExtension();
            Storage::putFileAs('covers', $cover, $fileName);
            $validated['cover'] = 'storage/covers/'.$fileName;
        }

        Gate::authorize('postOwner', $post);
        $post->update($validated);

        $post->tags()->sync($tagsRequest->tags);

        return redirect(route('posts.index'));
    }

    public function destroy(Post $post): RedirectResponse
    {
        Gate::authorize('postOwner', $post);
        $post->delete();

        return redirect(route('posts.index'));
    }

    public static function middleware()
    {
        return [
            new Middleware('auth', except: ['index']),
        ];
    }
}
