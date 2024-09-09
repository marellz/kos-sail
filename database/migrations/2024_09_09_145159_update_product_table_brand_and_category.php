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
        //
        Schema::table(
            'products',
            function (Blueprint $table) {
                $table->foreignIdFor(Category::class, 'category_id')->nullable()->change();
                $table->foreignIdFor(ProductBrand::class, 'brand_id')->nullable()->change();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
