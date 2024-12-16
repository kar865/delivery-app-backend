<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;
use App\Models\Store;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();


        $products = [
            'Pizza Hut' => [
                ['name' => 'Neapolitan Pizza', 'price' => 10.99, 'stock' => 25],
                ['name' => 'Cheese Pizza', 'price' => 8.99, 'stock' => 20],
                ['name' => 'Garlic Bread', 'price' => 4.99, 'stock' => 45]
            ],
            'Best Buy' => [
                ['name' => 'Samsung Galaxy S21', 'price' => 799.99, 'stock' => 10],
                ['name' => 'Sony TV 55 inch', 'price' => 499.99, 'stock' => 4],
                ['name' => 'Apple MacBook Pro', 'price' => 1299.99, 'stock' => 75]
            ],
            'Nike' => [
                ['name' => 'Air Max Sneakers', 'price' => 129.99, 'stock' => 23],
                ['name' => 'Nike Hoodie', 'price' => 49.99, 'stock' => 35],
                ['name' => 'Nike Running Shorts', 'price' => 29.99, 'stock' => 28]
            ],

        ];


        foreach ($products as $storeName => $productList) {
            $store = Store::where('name', $storeName)->first();

            foreach ($productList as $product) {
                Product::create([
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'stock' => $product['stock'],
                    'description' => $faker->sentence,
                    'store_id' => $store->id,
                    'image_url' => $faker->imageUrl(640, 480, 'business', true, 'Product'),
                ]);
            }
        }
    }
}
