<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;
use App\Models\BlogPost;
use App\Models\BlogCategory;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create();

        $categories = BlogCategory::pluck('id')->all();
        $titles = [
            'How to Brew the Perfect Pour Over',
            'Understanding Single Origin Coffee',
            'Behind the Roaster: Our Process',
            'Choosing Coffee Beans for Espresso',
            'The Science of Coffee Extraction',
            'Cold Brew: Methods and Recipes',
            'Latte Art Basics',
            'Sustainable Sourcing Explained',
            'Cupping 101: Tasting Coffee Like a Pro',
            'How Roast Levels Affect Flavor',
            'Espresso vs Filter: When to Choose Which',
            'Storing Coffee to Preserve Freshness',
            'Grind Size and Brew Time Guide',
            'The History of Coffee in Our Region',
            'Micro-lots and What They Mean',
            'Brewing with Hard Water',
            'Home Espresso Machine Maintenance',
            'How We Develop New Blends',
            'Sourdough + Coffee: Pairing Guide',
            'Preparing Coffee for Events',
        ];

        // images
        $imageFiles = [];
        $blogPath = public_path('images/blog');
        if (is_dir($blogPath)) {
            foreach (glob($blogPath . '/*') as $f) {
                $imageFiles[] = 'images/blog/' . basename($f);
            }
        }

        foreach ($titles as $i => $title) {
            $slug = Str::slug($title);
            $excerpt = $faker->sentence(18);
            $content = $faker->paragraphs(6, true);
            $image = $imageFiles[$i % count($imageFiles)] ?? null;
            $is_published = $faker->boolean(80);
            $published_at = $is_published ? $faker->dateTimeBetween('-90 days', 'now') : null;

            BlogPost::create([
                'blog_category_id' => $faker->randomElement($categories) ?? 1,
                'title' => $title,
                'slug' => $slug . '-' . ($i+1),
                'excerpt' => $excerpt,
                'content' => $content,
                'image' => $image,
                'is_published' => $is_published,
                'published_at' => $published_at,
            ]);
        }
    }
}
