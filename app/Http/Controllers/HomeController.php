<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    //
    public function __construct(
        private readonly ProductService $productService
    )
    {
        
    }

    public function index (Request $request)
    {
        $chunk = 'new';
        if($request->has('chunk') && $request->get('chunk') === 'popular'){
            $chunk = $request->get('chunk');
        }
        
        $products = $this->productService->getChunked($chunk);

        return Inertia::render('welcome', [
            'chunk' => $chunk,
            'products' => $products,
        ]);
    }

    public function help ()
    {
        return inertia('help/index');
    }

    public function docs ()
    {
        return inertia('docs/index');
    }
}
