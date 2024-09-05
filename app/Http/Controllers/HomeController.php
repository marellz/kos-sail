<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
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
        
        $products = new ProductCollection($this->productService->getChunked($chunk));

        return Inertia::render('welcome', [
            'chunk' => $chunk,
            'products' => $products,
            'submittedMessage' => $request->session()->get('contact_message_sent', false)
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
