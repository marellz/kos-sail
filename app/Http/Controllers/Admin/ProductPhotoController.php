<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductPhotoRequest;
use App\Models\Product;
use App\Services\PhotoUploadService;
use App\Services\ProductService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    //

    public function __construct(
        private readonly PhotoUploadService $uploadService,
        private readonly ProductService $service,
    ) {
    }

    public function store(StoreProductPhotoRequest $request, Product $product)
    {
        Gate::authorize('manage-products');

        $path = $this->uploadService->upload($request->photo);
        // $product = $this->service->get($id);
        $image_array = $product->images ?? [];

        // add path to product images
        array_push($image_array, $path);

        // update
        $product->update(['images' => $image_array]);

        return redirect()->route('admin.products.edit', [
            'product' => $product->slug,
        ]);

    }

    public function destroy(string $path)
    {
        Gate::authorize('manage-products');
        
        if (Storage::exists($path)) {
            // remove from storage

            // remove from images array

        } else {
            // throw sth
        }
    }
}
