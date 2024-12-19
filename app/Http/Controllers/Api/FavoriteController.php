<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;


class FavoriteController extends Controller
{
    public function index()
    {
        $user = auth('sanctum')->user();
        $favorites = Favorite::where('user_id', $user->id)->with('product')->get();

        return response()->json(['favorites' => $favorites]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = auth('sanctum')->user();
        $productId = $request->input('product_id');

        $favorite = Favorite::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($favorite) {
            return response()->json([
                'message' => 'This product is already in your favorites.'
            ], 400);
        }

        Favorite::create([
            'user_id' => $user->id,
            'product_id' => $productId,
        ]);

        return response()->json([
            'message' => 'Product added to favorites successfully.'
        ]);
    }
}