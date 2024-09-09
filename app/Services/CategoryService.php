<?php

namespace App\Services;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function get($id)
    {
        return Category::findOrFail($id);
    }

    public function parents()
    {
        return Category::whereNull('parent_id')->withCount(['products'])->get();
    }

    public function all(bool $withProductCount = false)
    {
        if ($withProductCount) {
            return Category::withCount('products')->get();
        }
        return Category::all();
    }

    public function store(StoreCategoryRequest $request)
    {
        return Category::create($request->safe([
            'name',
            'description',
            'slug',
            'parent_id'
        ]));
    }

    public function update(Category $category, UpdateCategoryRequest $request)
    {
        return $category->update($request->safe([
            'name',
            'description',
            'slug',
            'parent_id'
        ]));
    }

    public function destroy(Category $category)
    {

        foreach ($category->products as $product) {
            $product->update(['category_id' => null]);
        }

        return $category->delete();
    }
}
