<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            1 => 'Food', 
            2 => 'Electronics', 
            3 => 'Fashion', 
            4 => 'Books', 
            5 => 'Home Appliances', 
            6 => 'Furniture', 
        ];

        foreach ($categories as $id => $category) {
            Category::create([
                'id' => $id,
                'name' => $category
            ]);
        }
    }
}

