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
            'Food' => [
                ['name' => 'Pizza Hut', 'photo_url' => 'storage/store_photos/pizza_hut.png'],
                ['name' => 'McDonald\'s', 'photo_url' => 'storage/store_photos/mcdonalds.png'],
                ['name' => 'Starbucks', 'photo_url' => 'storage/store_photos/starbucks.png'],
            ],
            'Electronics' => [
                ['name' => 'Apple Store', 'photo_url' => 'storage/store_photos/apple_store.png'],
                ['name' => 'Samsung', 'photo_url' => 'storage/store_photos/samsung.png'],
            ],
            'Fashion' => [
                ['name' => 'Zara', 'photo_url' => 'storage/store_photos/zara.png'],
                ['name' => 'Adidas', 'photo_url' => 'storage/store_photos/adidas.png'],
            ],
            'Books' => [
                ['name' => 'Books-A-Million', 'photo_url' => 'storage/store_photos/books_a_million.png'],
            ],
            'Home Appliances' => [
                ['name' => 'Target', 'photo_url' => 'storage/store_photos/target.png'],
            ],
            'Furniture' => [
                ['name' => 'IKEA', 'photo_url' => 'storage/store_photos/ikea.png'],
                ['name' => 'Ashley Furniture', 'photo_url' => 'storage/store_photos/ashley_furniture.png'],
            ],
        ];

        foreach ($stores as $categoryName => $storeDetails) {
            $category = Category::where('name', $categoryName)->first();

            foreach ($storeDetails as $storeDetail) {
                Store::create([
                    'name' => $storeDetail['name'],
                    'category_id' => $category->id,
                    'photo_url' => asset($storeDetail['photo_url']),
                ]);
            }
        }
    }
}
