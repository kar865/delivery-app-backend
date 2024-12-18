<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return response()->json(['message' => 'Not enough stock', 'available_stock' => $product->stock], 400);
        }

        $cartItem = CartItem::create([
            'user_id' => auth('sanctum')->id(),
            'product_id' => $product->id,
            'quantity' => $request->quantity,
        ]);

        return response()->json($cartItem, 201);
    }

    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', auth('sanctum')->id())
            ->get();
        return response()->json($cartItems);
    }


    public function update(Request $request, $cartItemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::findOrFail($cartItemId);
        $product = $cartItem->product;

        if ($product->stock < $request->quantity) {
            return response()->json(['message' => 'Not enough stock', 'available_stock' => $product->stock], 400);
        }

        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return response()->json($cartItem);
    }

    public function destroy($cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->delete();

        return response()->json(['message' => 'Item removed from cart']);
    }
}
