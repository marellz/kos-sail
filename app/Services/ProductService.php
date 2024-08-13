<?php

namespace App\Services;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductService
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
        return Product::findOrFail($id);
    }

    public function collect($collection): ProductCollection
    {
        return new ProductCollection($collection);
    }

    public function resource(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    public function paginated()
    {
        return Product::paginate(10)->withQueryString();
    }

    public function all()
    {
        return Product::all();
    }

    public function fields()
    {
        return [
            "name",
            "slug",
            "short_description",
            "description",
            "category_id",
            "brand_id",
            "featured_image",
            "price",
            "images",
            "discount_price",
            "in_stock",
            "visible",
            "specifications",
        ];
    }

    public function store(StoreProductRequest $request)
    {
        return Product::create($request->safe($this->fields()));
    }

    public function update(Product $category, UpdateProductRequest $request)
    {
        return $category->update($request->safe($this->fields()));
    }

    public function destroy(Product $product)
    {
        return $product->delete();
    }
}
