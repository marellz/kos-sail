<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "short_description",
        "description",
        "category_id",
        "brand_id",
        "featured_image",
        "specifications",
        "images",
        "price",
        "discount_price",
        "in_stock",
        "visible",
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand ()
    {
        return $this->belongsTo(ProductBrand::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $casts = [
        'specifications' => 'object',
        'images' => 'array',
        "in_stock" => 'boolean',
        "visible" => 'boolean',
    ];
}
