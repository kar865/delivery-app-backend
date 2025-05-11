<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Store;

class ProductController extends Controller
{
    public function index($storeId)
    {
        $products = Product::where('store_id', $storeId)->get();
        return ProductResource::collection($products);
    }

    public function show($storeId, $productId)
    {
        $store = Store::findOrFail($storeId);
        $product = $store->products()->findOrFail($productId);
        return new ProductResource($product);
    }
    public function home()
    {
        $products = Product::latest()->take(10)->get();

        return ProductResource::collection($products);
    }
}
