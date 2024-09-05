<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function __construct (
        private readonly CategoryService $service,
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Inertia::render('categories/index', [
            'categories' => new CategoryCollection($this->service->parents()),
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
