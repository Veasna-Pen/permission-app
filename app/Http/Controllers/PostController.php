<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Requests;
use Inertia\Response;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index(): Response
    {
        $perPage = Requests::input('perPage') ?: 5;
        return Inertia::render('Admin/Posts/PostIndex',[
            'posts' => Post::query()
            ->when(Requests::input('search'), function($query, $search){
                $query->where('title', 'like', "%{$search}%");
            })
            ->paginate($perPage)
            ->withQueryString(),
            'filters' => Requests::only(['search', 'perPage'])
        ]);
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
