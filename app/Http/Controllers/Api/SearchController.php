<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\StoreResource;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->query('query');

        if (!$query) {
            return response()->json(['error' => 'Search query is required'], 400);
        }

        $products = Product::where('name', 'LIKE', '%' . $query . '%')->get();
        $stores = Store::where('name', 'LIKE', '%' . $query . '%')->get();

        return response()->json([
            'products'=>ProductResource::collection($products),
            'stores' => StoreResource::collection($stores)
        ]);
    }
}
