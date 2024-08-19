<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {
        $validated = $request->validate([
            'order_by' => ['nullable'],
            'category_id' => ['nullable', 'int'],
            'query' => ['nullable'],
            'price_max' => ['nullable', 'int'],
            'price_min' => ['nullable', 'int','lt:price_max'],
        ]);

        $products = $this->service->filter(collect($validated))->paginate(12);

        return inertia('products/index', [
            'products' => new ProductCollection($products),
            'categories' => Category::all(),
            'filtered' => $filters ?? [],
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return Inertia::render('products/show',[
            'product' => new ProductResource($product),
        ]);
    }
}
