<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home()
    {
        $categories = CategoryResource::collection(Category::all());
        return Inertia::render('Home', compact('categories'));
    }
}
