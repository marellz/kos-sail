<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Http\Resources\UserInformationResource;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $cartItems = $request->session()->get('cart', []);
        $user = $request->user() ?? null;
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $user ?  new UserInformationResource($request->user()) : null,
            ],
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'cart' => $cartItems,
        
        ];
    }
}
