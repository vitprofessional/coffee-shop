<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition()
    {
        $title = $this->faker->sentence(6);
        return [
            'blog_category_id' => BlogCategory::inRandomOrder()->first()?->id ?? BlogCategory::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1,9999),
            'excerpt' => $this->faker->paragraph(),
            'content' => $this->faker->paragraphs(4, true),
            'image' => 'seed-images/blog.jpg',
            'is_published' => true,
            'published_at' => now()->subDays($this->faker->numberBetween(0,30)),
        ];
    }
}
