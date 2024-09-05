<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;

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

    public function getMostViewed (int $limit = 5)
    {
        return Product::withTotalVisitCount()->limit($limit)->get();
    }

    public function getChunked(string $chunkBy)
    {
        $number = 4;
        switch ($chunkBy) {
            case 'popular':
                $products =  Product::popularAllTime()->where([
                    'in_stock' => true,
                    'visible' => true
                ])->limit($number)->get();
                break;

            default: // new
                $products = Product::latest()->limit($number)->get();
                break;
        }

        return $products;
    }

    public function filter(Collection $filters)
    {
        $products = Product::where('visible', true);

        /**
         * FILTERS:
         * 
         *  'category',
         *  'subcategory',
         *  'price_max',
         *  'price_min',
         *  'query' // search term
         * 
         */

        $category = $filters->get('category_id');
        $query = $filters->get('query');
        $maxPrice = $filters->get('price_max');
        $minPrice = $filters->get('price_min');

        $products = Product::where('visible', true);

        if ($category) {
            $products = $products->where('category_id', $category);
        }

        if ($maxPrice) {
            $products = $products->where('price', '<=', $maxPrice);
        }

        if ($minPrice) {
            $products = $products->where('price', '>=', $minPrice);
        }

        if ($query) {
            $products =  $products->where(
                function ($builder) use ($query) {
                    $builder->where('name', 'LIKE', '%' . $query . '%')
                        ->orWhere('short_description', 'LIKE', '%' . $query . '%')
                        ->orWhere('description', 'LIKE', '%' . $query . '%');
                }
            );
        }

        /**
         * ORDER_BY:
         * price_asc
         * price_desc
         * oldest
         * newest
         * alpha_first
         * alpha_last
         */

        $orderBy = $filters->get('order_by');

        if ($orderBy) {
            switch ($orderBy) {
                case 'price_asc':
                    $products = $products->orderBy('price', 'asc');
                    break;

                case 'price_desc':
                    $products = $products->orderBy('price', 'desc');
                    break;

                case 'oldest':
                    $products = $products->orderBy('created_at', 'asc');
                    break;

                case 'newest':
                    $products = $products->orderBy('created_at', 'desc');
                    break;

                case 'alphabetical_asc':
                    $products = $products->orderBy('name', 'asc');
                    break;

                case 'alphabetic_desc':
                    $products = $products->orderBy('name', 'desc');
                    break;


                default:
                    $products = $products->orderBy('created_at', 'desc');
                    break;
            }
        }


        return $products;
    }

    public function getFilters (array $filter_values)
    {
        $filtered = collect([]);

        $filterValueKeys = [
            'order_by' => 'Order by',
            'category_id' => 'Category',
            'query' => 'Keyword',
            'price_max' => 'Max price',
            'price_min' => 'Min price',
        ];

        $orderByValueKeys = [
            "alphabetical_asc" => "Alphabetical(ascending)",
            "alphabetical_desc" =>  "Alphabetical(descending)",
            "price_desc" => "Price(descending)",
            "price_asc" => "Price(ascending)",
            "newest" => "Date added(latest)",
            "oldest" => "Date added(oldest)",
        ];

        foreach ($filter_values as $key => $value) {
            $val = '';
            switch ($key) {
                case 'price_min':
                case 'price_max':
                    $val = 'Ksh. ' . number_format($value);
                    break;

                case 'category_id':
                    $val = Category::findOrFail($value)->name;
                    break;

                case 'query':
                    $val = '"' . $value . '"';
                    break;

                case "order_by":
                    $val = $orderByValueKeys[$value];
                    break;

                default:
                    $val = $value;
                    break;
            }
            $filtered->push([
                'key' => $key,
                'label' => $filterValueKeys[$key],
                'value' => $val
            ]);

        }
        
        return $filtered;
    }

    public function resource(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    public function paginated($number = 10)
    {
        return Product::paginate($number)->withQueryString();
    }

    public function all($visible = false)
    {
        return $visible ? Product::where('visible', true)->get() : Product::all();
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
