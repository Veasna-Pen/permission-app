<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request as Requests;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(): Response
    {
        $perPage = request('perPage') ?: 5;

        $categories = Category::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate($perPage)
            ->appends(request()->query());

        $categories = CategoryResource::collection($categories);

        $filters = request()->only(['search', 'perPage']);

        return Inertia::render('Admin/Categories/CategoryIndex', compact('categories', 'filters'));
    }

    public function create(): Response
    {
        $this->authorize('create', Category::class);
        return Inertia::render('Admin/Categories/Create');
    }

    public function store(CreateCategoryRequest $request): RedirectResponse
    {
        $this->authorize('create', Category::class);

        $categoryData = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('skills');
            $categoryData['image'] = $image;
        }
        Category::create($categoryData);

        return redirect()->route('categories.index');
    }

    public function edit(Category $category):Response
    {
        $this->authorize('update', $category);
        return Inertia::render('Admin/Categories/Edit', [
            'category' => new CategoryResource($category)
        ]);
    }

    public function update(CreateCategoryRequest $request, Category $category): RedirectResponse
    {
        $this->authorize('update', $category);
        $category->update($request->validated());

        return to_route('categories.index');
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        Storage::delete($category->image);
        $category->delete();
        return back();
    }
}
