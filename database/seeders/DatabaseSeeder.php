<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            MenuCategorySeeder::class,
            MenuItemSeeder::class,
            BlogCategorySeeder::class,
            BlogPostSeeder::class,
            GallerySeeder::class,
            TestimonialSeeder::class,
            EventSeeder::class,
            ReservationSeeder::class,
            OrderSeeder::class,
            ContactMessageSeeder::class,
        ]);
    }
}
