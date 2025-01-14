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
                ['name' => 'Neapolitan Pizza', 'price' => 10.99, 'stock' => 25, 'photo_url' => 'storage/product_photos/pizza_hut_neapolitan.png', 'description' => 'A pizza with fresh cheese, tomato sauce. Simple and tasty.'],
                ['name' => 'Cheese Pizza', 'price' => 8.99, 'stock' => 20, 'photo_url' => 'storage/product_photos/pizza_hut_cheese.png', 'description' => 'A pizza with lots of melted cheese. Perfect for cheese lovers.'],
                ['name' => 'Garlic Bread', 'price' => 4.99, 'stock' => 45, 'photo_url' => 'storage/product_photos/pizza_hut_garlic_bread.png', 'description' => 'Soft bread with garlic and butter. It’s delicious and crispy.'],
            ],
            'McDonald\'s' => [
                ['name' => 'Big Mac', 'price' => 5.99, 'stock' => 100, 'photo_url' => 'storage/product_photos/mcdonalds_big_mac.png', 'description' => 'A burger with two beef , cheese, lettuce, pickles, and special sauce. A classic burger.'],
                ['name' => 'McChicken', 'price' => 3.99, 'stock' => 80, 'photo_url' => 'storage/product_photos/mcdonalds_mcchicken.png', 'description' => 'A crispy chicken sandwich with lettuce and mayo. Tasty and simple.'],
                ['name' => 'Fries', 'price' => 2.99, 'stock' => 150, 'photo_url' => 'storage/product_photos/mcdonalds_fries.png', 'description' => 'Crispy and golden fries, perfect with any meal.'],
                ['name' => 'Apple Pie', 'price' => 1.99, 'stock' => 200, 'photo_url' => 'storage/product_photos/mcdonalds_apple_pie.png', 'description' => 'A warm pie filled with sweet apples. A great dessert after your meal.'],
            ],
            'Starbucks' => [
                ['name' => 'Hot Chocolate', 'price' => 2.99, 'stock' => 120, 'photo_url' => 'storage/product_photos/starbucks_hot_chocolate.png', 'description' => 'A warm, sweet chocolate drink topped with cream. Perfect for cold days.'],
                ['name' => 'Cappuccino', 'price' => 4.49, 'stock' => 90, 'photo_url' => 'storage/product_photos/starbucks_cappuccino.png', 'description' => 'A coffee drink with milk on top. Tasty and smooth.'],
                ['name' => 'Coffee', 'price' => 3.99, 'stock' => 150, 'photo_url' => 'storage/product_photos/starbucks_coffee.png', 'description' => 'A fresh cup of hot coffee to help you wake up and feel energized.'],
                ['name' => 'Iced Coffee', 'price' => 3.49, 'stock' => 110, 'photo_url' => 'storage/product_photos/starbucks_iced_coffee.png', 'description' => 'Cold coffee with ice. A refreshing drink for hot days.'],
            ],
            'Samsung' => [
                ['name' => 'Samsung Galaxy S21', 'price' => 799.99, 'stock' => 40, 'photo_url' => 'storage/product_photos/samsung_s21.png', 'description' => 'A smartphone with a great camera, fast speed, and a nice screen.'],
                ['name' => 'Samsung QLED TV', 'price' => 1200.99, 'stock' => 10, 'photo_url' => 'storage/product_photos/samsung_qled_tv.png', 'description' => 'A TV with bright colors and clear images. Great for watching movies and shows.'],
                ['name' => 'Samsung Gear S3', 'price' => 299.99, 'stock' => 25, 'photo_url' => 'storage/product_photos/samsung_gear_s3.png', 'description' => 'A smart watch to track your fitness and stay connected.'],
                ['name' => 'Samsung Galaxy Tab S7', 'price' => 649.99, 'stock' => 30, 'photo_url' => 'storage/product_photos/samsung_tab_s7.png', 'description' => 'A powerful tablet that can be used for work or fun.'],
            ],
            'Apple Store' => [
                ['name' => 'iPhone 13 Pro', 'price' => 999.99, 'stock' => 30, 'photo_url' => 'storage/product_photos/iphone_13_pro.png', 'description' => 'A smartphone with a fast processor and a great camera. Perfect for any task.'],
                ['name' => 'Apple Watch', 'price' => 399.99, 'stock' => 45, 'photo_url' => 'storage/product_photos/apple_watch.png', 'description' => 'A smart watch to help you track fitness, time, and stay connected.'],
                ['name' => 'AirPods Max', 'price' => 549.99, 'stock' => 20, 'photo_url' => 'storage/product_photos/airpods_max.png', 'description' => 'High-quality headphones for clear sound and noise cancellation.'],
                ['name' => 'iPad Pro', 'price' => 799.99, 'stock' => 35, 'photo_url' => 'storage/product_photos/ipad_pro.png', 'description' => 'A tablet that’s great for work, play, and creativity. Fast and powerful.'],
                ['name' => 'Mac Mini', 'price' => 699.99, 'stock' => 50, 'photo_url' => 'storage/product_photos/mac_mini.png', 'description' => 'A small computer with a fast processor. Great for home or office work.'],
            ],
            'Zara' => [
                ['name' => 'Women\'s Leather Jacket', 'price' => 129.99, 'stock' => 25, 'photo_url' => 'storage/product_photos/zara_womens_leather_jacket.png', 'description' => 'A stylish leather jacket that adds a cool touch to any outfit.'],
                ['name' => 'Black Leather Boots', 'price' => 69.99, 'stock' => 55, 'photo_url' => 'storage/product_photos/zara_black_leather_boots.png', 'description' => 'Comfortable and chic black boots that go well with any casual outfit.'],
                ['name' => 'Men\'s Shirt', 'price' => 34.99, 'stock' => 65, 'photo_url' => 'storage/product_photos/zara_mens_shirt.png', 'description' => 'A simple and stylish shirt for everyday wear.'],
                ['name' => 'High Heel Shoes', 'price' => 79.99, 'stock' => 50, 'photo_url' => 'storage/product_photos/zara_high_heel_shoes.png', 'description' => 'Elegant high heels perfect for formal occasions.'],
            ],
            'Adidas' => [
                ['name' => 'Adidas T-shirt', 'price' => 29.99, 'stock' => 85, 'photo_url' => 'storage/product_photos/adidas_tshirt.png', 'description' => 'A simple and breathable t-shirt for active wear or casual days.'],
                ['name' => 'Adidas Backpack', 'price' => 34.99, 'stock' => 30, 'photo_url' => 'storage/product_photos/adidas_backpack.png', 'description' => 'A durable backpack to carry your essentials comfortably.'],
                ['name' => 'Adidas Gym Bag', 'price' => 39.99, 'stock' => 45, 'photo_url' => 'storage/product_photos/adidas_gym_bag.png', 'description' => 'A spacious gym bag to carry all your workout gear.'],
            ],
            'Books-A-Million' => [
                ['name' => 'Harry Potter and the Sorcerer\'s Stone', 'price' => 24.99, 'stock' => 30, 'photo_url' => 'storage/product_photos/harry_potter_sorcerers_stone.png', 'description' => 'The first book in the Harry Potter series filled with magic and mystery.'],
                ['name' => 'A Song Of Ice And Fire', 'price' => 13.99, 'stock' => 45, 'photo_url' => 'storage/product_photos/song_of_ice_and_fire.png', 'description' => 'A thrilling fantasy book full of political drama.'],
                ['name' => 'Crime and Punishment', 'price' => 17.99, 'stock' => 45, 'photo_url' => 'storage/product_photos/crime_and_punishment.png', 'description' => 'A classic novel exploring morality, guilt, and redemption.'],
            ],
            'Target' => [
                ['name' => 'Electric Grill', 'price' => 59.99, 'stock' => 80, 'photo_url' => 'storage/product_photos/electric_grill.png', 'description' => 'A small electric grill perfect for cooking indoors with ease.'],
                ['name' => 'Microwave', 'price' => 49.99, 'stock' => 100, 'photo_url' => 'storage/product_photos/microwave.png', 'description' => 'A microwave to quickly heat up your food with just the press of a button.'],
                ['name' => 'Washing Machine', 'price' => 29.99, 'stock' => 75, 'photo_url' => 'storage/product_photos/washing_machine.png', 'description' => 'A basic washing machine for your everyday laundry needs.'],
                ['name' => 'Vacuum Cleaner', 'price' => 89.99, 'stock' => 60, 'photo_url' => 'storage/product_photos/vacuum_cleaner.png', 'description' => 'A powerful vacuum to keep your home clean and dust-free.'],
            ],
            'IKEA' => [
                ['name' => 'Sofa Bed', 'price' => 199.99, 'stock' => 50, 'photo_url' => 'storage/product_photos/sofa_bed.png', 'description' => 'A comfortable sofa that can be turned into a bed.'],
                ['name' => 'Dining Table', 'price' => 149.99, 'stock' => 40, 'photo_url' => 'storage/product_photos/dining_table.png', 'description' => 'A simple and modern dining table for your home.'],
                ['name' => 'Bookshelf', 'price' => 89.99, 'stock' => 70, 'photo_url' => 'storage/product_photos/bookshelf.png', 'description' => 'A spacious bookshelf to store your books or decorations.'],
                ['name' => 'Chair', 'price' => 39.99, 'stock' => 100, 'photo_url' => 'storage/product_photos/chair.png', 'description' => 'A sturdy chair for sitting comfortably anywhere in your home.'],
                ['name' => 'Desk Lamp', 'price' => 24.99, 'stock' => 150, 'photo_url' => 'storage/product_photos/desk_lamp.png', 'description' => 'A simple desk lamp to brighten up your workspace.'],
            ],
            'Ashley Furniture' => [
                ['name' => 'King Size Bed', 'price' => 499.99, 'stock' => 30, 'photo_url' => 'storage/product_photos/king_size_bed.png', 'description' => 'A large and comfortable bed perfect for a good night’s sleep.'],
                ['name' => 'Leather Sofa', 'price' => 799.99, 'stock' => 25, 'photo_url' => 'storage/product_photos/leather_sofa.png', 'description' => 'A stylish and comfortable leather sofa for your living room.'],
                ['name' => 'Coffee Table', 'price' => 149.99, 'stock' => 50, 'photo_url' => 'storage/product_photos/coffee_table.png', 'description' => 'A modern coffee table that fits perfectly in any living room.'],
                ['name' => 'Nightstand', 'price' => 79.99, 'stock' => 100, 'photo_url' => 'storage/product_photos/nightstand.png', 'description' => 'A simple nightstand with drawers to store your belongings.'],
            ],
        ];
        

        foreach ($products as $storeName => $productList) {
            $store = Store::where('name', $storeName)->first();

            foreach ($productList as $product) {
                Product::create([
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'stock' => $product['stock'],
                    'description' => $product['description'],
                    'store_id' => $store->id,
                    'photo_url' => asset($product['photo_url']), 
                ]);
            }
        }
    }
}
