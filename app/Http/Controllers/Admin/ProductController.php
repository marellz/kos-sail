<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductSpecification;
use App\Services\ProductService;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    //
    public function __construct(
        private readonly ProductService $service
    ) {
    }

    public function index()
    {
        Gate::authorize('manage-products');

        return inertia('dashboard/products/index', [
            'products' => $this->service->collect($this->service->paginated()),
        ]);
    }

    public function create()
    {
        Gate::authorize('manage-products');

        return inertia('dashboard/products/form', [
            'isEdit' => false,
            'categories' => Category::all(),
            'brands' => ProductBrand::all(),
            'specifications' => ProductSpecification::all(),
        ]);
    }

    public function show(Product $product)
    {
        Gate::authorize('manage-products');

        return inertia('dashboard/products/show', [
            'product' => new ProductResource($product),
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        Gate::authorize('manage-products');

        try {
            $product = $this->service->store($request);
            return redirect()->route('admin.products.show', ["product" => $product]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(Product $product)
    {
        Gate::authorize('manage-products');

        return inertia('dashboard/products/form', [
            'product' => new ProductResource($product),
            'isEdit' => true,
            'categories' => Category::all(),
            'brands' => ProductBrand::all(),
            'specifications' => ProductSpecification::all(),
        ]);
    }

    public function update(Product $product, UpdateProductRequest $request)
    {
        Gate::authorize('manage-products');

        try {
            $this->service->update($product, $request);
            return redirect()->route('admin.products.show', ["product" => $product->slug]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Product $product)
    {
        Gate::authorize('manage-products');
        
        try {
            $this->service->destroy($product);
            return redirect()->route('admin.products.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function export ()
    {
        Gate::authorize('manage-products');

        $url = Excel::download(new ProductsExport, 'products.xlsx');
        return $url;
    }

}