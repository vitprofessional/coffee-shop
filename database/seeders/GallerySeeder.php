<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;
use Faker\Factory as FakerFactory;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create();

        $categories = ['Coffee','Roastery','Café','Events'];

        $images = [];
        $galleryPath = public_path('images/gallery');
        if (is_dir($galleryPath)) {
            foreach (glob($galleryPath . '/*') as $f) {
                $images[] = 'images/gallery/' . basename($f);
            }
        }

        $count = max(20, count($images));
        for ($i = 0; $i < 20; $i++) {
            Gallery::create([
                'title' => ucfirst($faker->words(3, true)),
                'image' => $images[$i % max(1, count($images))] ?? null,
                'category' => $faker->randomElement($categories),
                'sort_order' => $i,
                'is_active' => true,
            ]);
        }
    }
}

