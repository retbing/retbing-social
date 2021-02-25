<?php

namespace Database\Seeders;

use App\Models\UserPublicInfo;
use App\Models\User;
use App\Models\Image;
use Database\Factories\ImageFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(20)->create()->each(function ($user) {
            $user_public_info = UserPublicInfo::factory()->makeOne();
            $user->user_public_info()->save($user_public_info);
            $image = Image::factory()->makeOne();
            $user->user_public_info->image()->save($image);
        });
    }
}