<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Gate;
use App\Services\CategoryService;
use App\Models\Category;
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
        Gate::authorize('manage-categories');

        return inertia('dashboard/categories/index', [
            'categories' => new CategoryCollection($this->service->parents()),
        ]);
    }

    public function create(Request $request)
    {
        Gate::authorize('manage-categories');

        return inertia('dashboard/categories/form', [
            'parent_id' => $request->get('parent') ?? '',
            'categories' => $this->service->all(),
        ]);
    }

    public function show(Category $category)
    {
        Gate::authorize('manage-categories');

        return inertia('dashboard/categories/show', [
            'category' => new CategoryResource($category),
        ]);
    }

    public function store(StoreCategoryRequest $request)
    {
        Gate::authorize('manage-categories');

        try {
            $category = $this->service->store($request);
            return redirect()->route('admin.categories.show', ['category' => $category]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(Category $category)
    {
        Gate::authorize('manage-categories');

        return inertia('dashboard/categories/form', [
            'category' => $category,
            'categories' => $this->service->all(),
        ]);
    }

    public function update(Category $category, UpdateCategoryRequest $request)
    {

        Gate::authorize('manage-categories');

        try {
            $this->service->update($category, $request);
            return redirect()->route('admin.categories.show', [
                'category' => $category,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Category $category)
    {
        Gate::authorize('manage-categories');

        $parent = $category->parent;

        $this->service->destroy($category);

        if($parent){
            return redirect()->route('admin.categories.show', ['category' => $parent]);
        } else {
            return redirect()->route('admin.categories.index');
        }
    }
}
