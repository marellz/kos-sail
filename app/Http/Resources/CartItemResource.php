<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'featured_image' => $this->featured_image,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'short_description' => $this->short_description,
            'in_stock' => $this->in_stock,
            'visible' => $this->visible,
            'brand' => $this->brand->only(['name']),
            'category' => $this->category->only(['name']),
            'quantity' => $this->quantity,
        ];
    }
}
