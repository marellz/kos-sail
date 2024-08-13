<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'featured_image' => $this->featured_image,
            'brand' => $this->brand ? $this->brand->only(['id', 'name']) : [],
            'category' => $this->category->only(['id','slug','name']),
            'short_description' => $this->short_description,
            'images' => collect($this->images)->map(function($path){
                return asset($path);
            }),
            'specifications' => $this->specifications,
            'description' => $this->description,
            'visible' => $this->visible,
            'last_updated' => $this->updated_at->format('d/m/y - H:m A'),
            'in_stock' => $this->in_stock,
        ];
    }
}
