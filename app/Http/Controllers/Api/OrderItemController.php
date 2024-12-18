<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function show($orderId, $itemId)
    {
        $order = Order::where('id', $orderId)->where('user_id',  auth('sanctum')->id())->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found or not owned by the user'], 404);
        }

        $orderItem = $order->items()->where('id', $itemId)->first();

        if (!$orderItem) {
            return response()->json(['message' => 'Order item not found'], 404);
        }

        return response()->json([
            'order_item' => $orderItem,
            'product' => $orderItem->product,
            'quantity' => $orderItem->quantity,
            'price' => $orderItem->price,
        ]);
    }


    public function update($orderId, $itemId, Request $request)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', auth('sanctum')->id())
            ->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $orderItem = $order->items()->where('id', $itemId)->first();

        if (!$orderItem) {
            return response()->json(['message' => 'Order item not found'], 404);
        }

        $newQuantity = $request->input('quantity');
        $product = $orderItem->product;

        if ($newQuantity > $product->stock + $orderItem->quantity) {
            return response()->json(['message' => 'Not enough stock'], 400);
        }

        $quantityDiff = $newQuantity - $orderItem->quantity;

        $orderItem->update([
            'quantity' => $newQuantity,
            'price' => $product->price,
        ]);

        $order->total = $order->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $order->save();

        if ($quantityDiff < 0) {
            $product->increment('stock', abs($quantityDiff));
        } else {
            $product->decrement('stock', $quantityDiff);
        }

        return response()->json($order);
    }

    public function destroy($orderId, $itemId)
    {
        $order = Order::where('id', $orderId)->where('user_id',  auth('sanctum')->id())->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $orderItem = $order->items()->where('id', $itemId)->first();

        if (!$orderItem) {
            return response()->json(['message' => 'Order item not found'], 404);
        }

        // Remove the order item
        $orderItem->delete();

        // Recalculate the order's total price
        $order->total = $order->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $order->save();

        // Restore stock
        $product = $orderItem->product;
        $product->increment('stock', $orderItem->quantity);

        return response()->json($order);
    }
}
