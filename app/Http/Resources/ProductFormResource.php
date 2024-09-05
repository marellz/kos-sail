<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductFormResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public $collects = Product::class;
    
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $data = array_merge(parent::toArray($request),[
            'images' => collect($this->images)->map(function($path) {
                return asset($path);
            }),
        ]);

        return $data;
    }
}
