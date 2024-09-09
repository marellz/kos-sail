<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $products = $this->products;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'is_parent' => $this->parent_id === null,
            'parent_id' => $this->parent_id,
            'subcategories' => CategoryResource::collection($this->children),
            'products' => $products,
            'product_count' => $products->count(),
        ];

    }
}
