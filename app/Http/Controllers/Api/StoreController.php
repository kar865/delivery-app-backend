<?php

namespace App\Http\Controllers\Api; 
use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index($categoryId)
    {
        $stores = Store::where('category_id', $categoryId)->get();
        return StoreResource::collection($stores);  
    }
}
