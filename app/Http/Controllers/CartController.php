<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartJson;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $user = auth()->user();
        $cart = $user->carts->where('is_order', false)->first();
        //dd($cart->products->count());
        return CartJson::collection($cart->products);
    }

    public function store(Product $product, Request $request) {
        $user = auth()->user();
        $cart = null;
        if (!$user->carts->where('is_order', false)->first()) {
            $cart = $user->carts()->create([]);
        } else {
            $cart = $user->carts->where('is_order', false)->first();
        }

        $cart->products()->attach($product);

        return response()->json([
            "data"=>["message"=> "Product add to card"]
        ], 201);
    }

    public function destroy(int $id) {
        $user = auth()->user();
        $cart = $user->carts->where('is_order', false)->first();

        if (!$cart->products()->wherePivot('id', $id)->exists()) {
            return response()->json([
                'error'=>403,
                'message'=>'Forbidden for you'
            ], 403);
        }
        $cart->products()->wherePivot('id', $id)->detach();
        return response()->json([
            'data'=>["message"=> "Item removed from cart"]
        ]);
    }

}
