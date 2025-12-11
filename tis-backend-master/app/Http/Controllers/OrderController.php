<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderJson;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\OrderPrepare;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $user = auth()->user();
        $data = $user->orders->map(fn (Order $order) => new OrderPrepare($order->id, $order->cart->products));
        return OrderJson::collection($data);
    }

    public function store(){
        $user = auth()->user();
        $cart = $user->carts->where('is_order', false)->first();
        if($cart->products->isEmpty()){
            return response()->json([
               "error"=>[
                   "code"=> 422,
                   "message"=>"Cart is empty",
               ]
            ], 422);
        }

        Cart::where('id', $cart->id)->update(['is_order' => true]);
        $user->carts()->create([]);

        $order = Order::create(['user_id'=>$user->id, 'cart_id'=>$cart->id]);
        return response()->json([
            'data'=>[
                'order_id'=>$order->id,
                'message'=>'Order is processed',
            ]
        ], 201);
    }
}
