<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function store()
    {
        $cartItems = CartItem::where('user_id', auth()->id)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'The cart is empty'], 400);
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => auth()->id,
                'status' => 'pending',
                'total' => $cartItems->sum(function ($item) {
                    return $item->product->price * $item->quantity;
                }),
            ]);

            foreach ($cartItems as $cartItem) {
                $product = $cartItem->product;
                if ($product->stock < $cartItem->quantity) {
                    return response()->json(['message' => 'Not enough stock'], 400);
                }

                $product->decrement('stock', $cartItem->quantity);

                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $cartItem->quantity,
                    'price' => $product->price,
                ]);
            }

            $cartItems->each->delete();

            DB::commit();

            return response()->json($order, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Order failed'], 500);
        }
    }
}
