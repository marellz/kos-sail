<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductFormResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductSpecification;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function __construct(
        private readonly ProductService $service
    ) {
    }

    public function index()
    {
        return inertia('dashboard/products/index', [
            'products' => $this->service->collect($this->service->paginated()),
        ]);
    }

    public function create()
    {
        return inertia('dashboard/products/form', [
            'isEdit' => false,
            'categories' => Category::all(),
            'brands' => ProductBrand::all(),
            'specifications' => ProductSpecification::all(),
        ]);
    }

    public function show(Product $product)
    {
        return inertia('dashboard/products/show', [
            'product' => new ProductResource($product),
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $product = $this->service->store($request);
            return redirect()->route('admin.products.show', ["product" => $product]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(Product $product)
    {

        // dd($product->specifications);
        return inertia('dashboard/products/form', [
            'product' => $product,
            'isEdit' => true,
            'categories' => Category::all(),
            'brands' => ProductBrand::all(),
            'specifications' => ProductSpecification::all(),
        ]);
    }

    public function update(Product $product, UpdateProductRequest $request)
    {
        try {
            $this->service->update($product, $request);
            return redirect()->route('admin.products.show', ["product" => $product->slug]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Product $product)
    {
        try {
            $this->service->destroy($product);
            return redirect()->route('admin.products.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}