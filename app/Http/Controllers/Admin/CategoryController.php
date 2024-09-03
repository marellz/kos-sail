<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function __construct(
        private readonly CategoryService $service
    ) {
    }

    public function index()
    {
        return inertia('dashboard/categories/index', [
            'categories' => new CategoryCollection($this->service->parents()),
        ]);
    }

    public function create()
    {
        return inertia('dashboard/categories/index', [
            'showForm'=> true,
            'categories' => $this->service->all(),
        ]);
    }

    public function show(Category $category)
    {
        return inertia('dashboard/categories/index', [
            'category' => $category,
            'categories' => $this->service->all(),
            'showItem' => true
        ]);
    }

    public function store (StoreCategoryRequest $request)
    {
        try {
            $this->service->store($request);
            return redirect()->route('admin.categories.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(Category $category)
    {
        return inertia('dashboard/categories/index', [
            'category' => $category,
            'categories' => $this->service->all(),
            'showItem' => false,
            'showForm' => true
        ]);
    }

    public function update(Category $category, UpdateCategoryRequest $request)
    {

        try {
            $this->service->update($category, $request);
            return redirect()->route('admin.categories.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Category $category)
    {
        return redirect()->route('admin.categories.index');
    }
}
