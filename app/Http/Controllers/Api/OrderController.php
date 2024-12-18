<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth('sanctum')->id())
            ->get();

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found'], 404);
        }

        return response()->json($orders);
    }


    public function show($orderId)
    {
        $order = Order::with('items.product')
            ->where('id', $orderId)
            ->where('user_id',  auth('sanctum')->id())
            ->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order);
    }

    public function store()
    {
        $cartItems = CartItem::where('user_id',  auth('sanctum')->id())->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'The cart is empty'], 400);
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => auth('sanctum')->id(),
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
            return response()->json(['message' => 'Order creation failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id',  auth('sanctum')->id())
            ->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found or not owned by the user'], 404);
        }

        foreach ($order->items as $orderItem) {
            $product = $orderItem->product;
            $product->increment('stock', $orderItem->quantity);
        }

        $order->items()->delete();

        $order->delete();

        return response()->json(['message' => 'Order and its items have been deleted successfully, stock restored.'], 200);
    }
}
