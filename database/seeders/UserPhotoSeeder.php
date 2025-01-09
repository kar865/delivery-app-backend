<?php

namespace Database\Seeders;

use App\Models\UserPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserPhoto::create([
            'id'=>1,
            'photo_url' => 'storage/profile_photos/Avatar1.png',
        ]);

        UserPhoto::create([
            'id'=>2,
            'photo_url' => 'storage/profile_photos/Avatar2.png',
        ]);

        UserPhoto::create([
            'id'=>3,
            'photo_url' => 'storage/profile_photos/Avatar3.png',
        ]);

        UserPhoto::create([
            'id'=>4,
            'photo_url' => 'storage/profile_photos/Avatar4.png',
        ]);

        UserPhoto::create([
            'id'=>5,
            'photo_url' => 'storage/profile_photos/Avatar5.png',
        ]);

        UserPhoto::create([
            'id'=>6,
            'photo_url' => 'storage/profile_photos/Avatar6.png',
        ]);

        UserPhoto::create([
            'id'=>11,
            'photo_url' => 'storage/profile_photos/default_avatar.png',
        ]);
    }
}
