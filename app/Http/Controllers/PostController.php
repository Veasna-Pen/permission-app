<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Inertia\Response;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index(): Response
    {
        $perPage = request('perPage') ?: 5;

        $posts = Post::query()
            ->when(request('search'), function($query, $search){
                $query->where('title', 'like', "%{$search}%");
            })
            ->paginate($perPage)
            ->appends(request()->query());

        $posts = PostResource::collection($posts);

        $filters = request()->only(['search', 'perPage']);

        return Inertia::render('Admin/Posts/PostIndex', compact('posts', 'filters'));
    }

    public function create(): Response
    {
        $this->authorize('create', Post::class);
        return Inertia::render('Admin/Posts/Create');
    }

    public function store(CreatePostRequest $request):RedirectResponse
    {
        $this->authorize('create', Post::class);
        Post::create($request->validated());
        return to_route('posts.index');
    }

    public function edit(Post $post):Response
    {
        $this->authorize('update', $post);
        return Inertia::render('Admin/Posts/Edit', [
            'post' => new PostResource($post)
        ]);
    }

    public function update(CreatePostRequest $request, Post $post): RedirectResponse
    {
        $this->authorize('update', $post);
        $post->update($request->validated());

        return to_route('posts.index');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return back();
    }
}
