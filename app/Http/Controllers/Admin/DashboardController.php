<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Contact;
use App\Models\Product;
use App\Models\User;
use App\Services\ProductService;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class DashboardController extends Controller
{
    //

    public function __construct(
        private readonly ProductService $productService,
    ) {
    }

    public function index()
    {
        Gate::authorize('view-admin-dashboard');

        return Inertia::render('dashboard/index', [
            'stats' => [
                'products' => Product::count(),
                'users' => User::count(),
                'views' => Product::withTotalVisitCount()->get()->sum('visit_count_total'),
                'contacts' => Contact::where('resolved', false)->count(),
            ],
            'products' => ProductResource::collection($this->productService->getMostViewed()),
        ]);
    }
}
