<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\ProductCollection;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class HomeController extends Controller
{
    //
    public function __construct(
        private readonly ProductService $productService
    ) {
    }

    public function index(Request $request)
    {
        $chunk = 'new';
        if ($request->has('chunk') && $request->get('chunk') === 'popular') {
            $chunk = $request->get('chunk');
        }

        $products = new ProductCollection($this->productService->getChunked($chunk));

        return Inertia::render('welcome', [
            'chunk' => $chunk,
            'products' => $products,
            'submittedMessage' => $request->session()->get('contact_message_sent', false)
        ]);
    }

    public function search(Request $request)
    {

        $validated = $request->validate(['q' => 'string']);

        $query = Str::lower($validated['q']);

        $products = Product::where(function ($builder) use ($query) {
            $builder->whereRaw('LOWER(name) LIKE ?', ['%' . $query . '%'])
                ->orWhereRaw('LOWER(short_description) LIKE ?', ['%' . $query . '%'])
                ->orWhereRaw('LOWER(description) LIKE ?', '%' . $query . '%');
        })->get();

        $categories = Category::where(function ($builder) use ($query) {
            $builder->whereRaw('LOWER(name) LIKE ?', ['%' . $query . '%'])
                ->orWhereRaw('LOWER(description) LIKE ?', ['%' . $query . '%']);
        })->get();

        $results = [
            'products' => new ProductCollection($products),
            'categories' => new CategoryCollection($categories),
        ];

        return Inertia::render('search/index', [
            'query' => $request->get('q'),
            'results' => $results,
        ]);
    }

    public function help()
    {
        return inertia('help/index');
    }

    public function docs()
    {
        return inertia('docs/index');
    }
}
