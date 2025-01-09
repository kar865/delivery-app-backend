<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;


class FavoriteController extends Controller
{
    public function index()
    {
        $user = auth('sanctum')->user();
    
        $favorites = Favorite::where('user_id', $user->id)
            ->with(['product.store.category']) 
            ->get();
    
        $groupedFavorites = $favorites->groupBy(function ($favorite) {
            return $favorite->category_id; 
        });
    
        $categories = [];
    
        foreach ($groupedFavorites as $categoryId => $categoryFavorites) {
            $category = Category::find($categoryId);
    
            $categories[] = [
                'category_name' => $category->name,
                'favorites' => $categoryFavorites,
            ];
        }
    
        return response()->json(['categories' => $categories]);
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

        $product = Product::find($productId);
        $categoryId = $product->store->category->id; 

        Favorite::create([
            'user_id' => $user->id,
            'product_id' => $productId,
            'category_id' => $categoryId, 
        ]);

        return response()->json([
            'message' => 'Product added to favorites successfully.'
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = auth('sanctum')->user();
        $productId = $request->input('product_id');

        $favorite = Favorite::where('user_id', $user->id)->where('product_id', $productId)->first();

        if (!$favorite) {
            return response()->json([
                'message' => 'This product is not in your favorites.'
            ], 404);
        }

        $favorite->delete();

        return response()->json([
            'message' => 'Product removed from favorites successfully.'
        ]);
    }
}
