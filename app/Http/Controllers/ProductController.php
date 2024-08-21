<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFilterRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;


class ProductController extends Controller
{

    public function __construct(
        private readonly ProductService $service,
        private readonly CategoryService $categoryService,
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(ProductFilterRequest $request)
    {
        $validated = $request->safe([
            "order_by",
            "category_id",
            "query",
            "price_max",
            "price_min",
        ]);

        $products = $this->service->filter(collect($validated))->paginate(12)->withQueryString();

        $filter_values = $validated ?? [];

        $filtered = $this->service->getFilters($filter_values);

        return inertia('products/index', [
            'products' => new ProductCollection($products),
            'categories' => Category::all(),
            'filteredValues' => $filter_values,
            'filtered' => $filtered
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->visit();

        return Inertia::render('products/show', [
            'product' => new ProductResource($product),
        ]);
    }
}
