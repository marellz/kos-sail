<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartItemResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index(Request $request)
    {
        // show all items
        $cart = $request->session()->get('cart', []);

        $items = Product::whereIn('slug', array_keys($cart))->get();

        $items = $items->map(function($item) {
            return [
                'item' => new CartItemResource($item),
                'quantity' => session('cart', [])[$item->slug],
            ];
        });

        return Inertia::render('cart/index', [
            'items' => $items
        ]);
    }

    public function store(Request $request)
    {
        // add an item to cart
        $cart = $request->session()->get('cart', []);
        $item = $request->item;

        if (isset($cart[$item])) {
            $cart[$item] += 1;
        } else {
            $cart[$item] = 1;
        }

        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    public function update(Request $request)
    {
        // update item quantity

        $cart = $request->session()->get('cart', []);
        $item = $request->item;
        $quantity = $request->quantity;

        if (isset($cart[$item]) && $quantity != 0) {
            $cart[$item] = $quantity;
        }

        $request->session()->put('cart', $cart);

        // $request->session()->put('cart', $request->cart);
        return redirect()->route('cart.index');
    }

    public function destroy (Request $request, string $slug)
    {
        //delete item from cart
        $cart = $request->session()->get('cart', []);

        if(isset($cart[$slug])){
            // delete
            unset($cart[$slug]);

            $request->session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }

    public function reset(Request $request)
    {
        // delete entire cart/refresh
        $request->session()->forget('cart');
        return redirect()->route('cart.index');
    }
}
