<?php

use App\Models\Category;
use App\Models\ProductBrand;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->foreignIdFor(Category::class, 'category_id');
            $table->foreignIdFor(ProductBrand::class, 'brand_id');
            $table->text('featured_image')->nullable();
            $table->json('images')->nullable();
            $table->json('specifications')->nullable();
            $table->float('price');
            $table->float('discount_price')->nullable();
            $table->boolean('in_stock')->default(true);
            $table->boolean('visible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
