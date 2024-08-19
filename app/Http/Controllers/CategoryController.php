<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function __construct (
        private readonly CategoryService $service,
    )
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Inertia::render('categories/index', [
            'categories' => $this->service->all(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }
}
