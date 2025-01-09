<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Store;
use App\Models\Category;

class StoreSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $stores = [
            'Food' => ['Pizza Hut', 'McDonald\'s', 'Starbucks'],
            'Electronics' => [ 'Apple Store', 'Samsung'],
            'Fashion' => ['Zara','Adidas'],
            'Books' => ['Books-A-Million'],
            'Home Appliances' => ['Target'],
            'Furniture' => ['IKEA', 'Ashley Furniture'],
        ];

        foreach ($stores as $categoryName => $storeNames) {
            $category = Category::where('name', $categoryName)->first();

            foreach ($storeNames as $storeName) {
                Store::create([
                    'name' => $storeName,
                    'category_id' => $category->id, 
                ]);
            }
        }
    }
}
