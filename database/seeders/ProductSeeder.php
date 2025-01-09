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
            'McDonald\'s' => [
                ['name' => 'Big Mac', 'price' => 5.99, 'stock' => 100],
                ['name' => 'McChicken', 'price' => 3.99, 'stock' => 80],
                ['name' => 'Fries', 'price' => 2.99, 'stock' => 150],
                ['name' => 'Apple Pie', 'price' => 1.99, 'stock' => 200],
            ],
            'Starbucks' => [
                ['name' => 'Hot Chocolate', 'price' => 2.99, 'stock' => 120],
                ['name' => 'Cappuccino', 'price' => 4.49, 'stock' => 90],
                ['name' => 'Coffee', 'price' => 3.99, 'stock' => 150],
                ['name' => 'Iced Coffee', 'price' => 3.49, 'stock' => 110],
            ],
            'Samsung' => [
                ['name' => 'Samsung Galaxy S21', 'price' => 799.99, 'stock' => 40],
                ['name' => 'Samsung QLED TV', 'price' => 1200.99, 'stock' => 10],
                ['name' => 'Samsung Gear S3', 'price' => 299.99, 'stock' => 25],
                ['name' => 'Samsung Galaxy Tab S7', 'price' => 649.99, 'stock' => 30],
            ],
            'Apple Store' => [
                ['name' => 'iPhone 13 Pro', 'price' => 999.99, 'stock' => 30],
                ['name' => 'Apple Watch ', 'price' => 399.99, 'stock' => 45],
                ['name' => 'AirPods Max', 'price' => 549.99, 'stock' => 20],
                ['name' => 'iPad Pro', 'price' => 799.99, 'stock' => 35],
                ['name' => 'Mac Mini', 'price' => 699.99, 'stock' => 50],
            ],
            'Zara' => [
                ['name' => 'Women\'s Leather Jacket', 'price' => 129.99, 'stock' => 25],
                ['name' => 'Black Leather Boots', 'price' => 69.99, 'stock' => 55],
                ['name' => 'Men\'s Shirt', 'price' => 34.99, 'stock' => 65],
                ['name' => 'High Heel Shoes', 'price' => 79.99, 'stock' => 50],
            ],
            'Adidas' => [
                ['name' => 'Adidas Jacket', 'price' => 79.99, 'stock' => 40],
                ['name' => 'Adidas T-shirt', 'price' => 29.99, 'stock' => 85],
                ['name' => 'Adidas Backpack', 'price' => 34.99, 'stock' => 30],
                ['name' => 'Adidas Gym Bag', 'price' => 39.99, 'stock' => 45],
            ],
            'Books-A-Million' => [
                ['name' => 'The Lord of the Rings', 'price' => 19.99, 'stock' => 50],
                ['name' => 'Harry Potter and the Sorcerer\'s Stone', 'price' => 24.99, 'stock' => 30],
                ['name' => 'A Game of Thrones', 'price' => 13.99, 'stock' => 45],
                ['name' => 'Crime and Punishment', 'price' => 17.99, 'stock' => 45]
            ],
            'Target' => [
                ['name' => 'Electric Grill', 'price' => 59.99, 'stock' => 80],
                ['name' => 'Comforter Set', 'price' => 49.99, 'stock' => 100],
                ['name' => 'Iron', 'price' => 29.99, 'stock' => 75],
                ['name' => 'Vacuum Cleaner', 'price' => 89.99, 'stock' => 60],
                ['name' => 'Coffee Maker', 'price' => 39.99, 'stock' => 120],
            ],
            'IKEA' => [
                ['name' => 'Sofa Bed', 'price' => 199.99, 'stock' => 50],
                ['name' => 'Dining Table', 'price' => 149.99, 'stock' => 40],
                ['name' => 'Bookshelf', 'price' => 89.99, 'stock' => 70],
                ['name' => 'Chair', 'price' => 39.99, 'stock' => 100],
                ['name' => 'Desk Lamp', 'price' => 24.99, 'stock' => 150],
            ],
            'Ashley Furniture' => [
                ['name' => 'King Size Bed', 'price' => 499.99, 'stock' => 30],
                ['name' => 'Leather Sofa', 'price' => 799.99, 'stock' => 25],
                ['name' => 'Coffee Table', 'price' => 149.99, 'stock' => 50],
                ['name' => 'Dining Chair Set', 'price' => 189.99, 'stock' => 40],
                ['name' => 'Nightstand', 'price' => 79.99, 'stock' => 100],
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
