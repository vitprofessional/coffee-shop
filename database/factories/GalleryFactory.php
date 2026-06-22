<?php

namespace Database\Factories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    protected $model = Gallery::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'image' => 'seed-images/gallery.jpg',
            'category' => $this->faker->randomElement(['interior','coffee','staff', null]),
            'sort_order' => $this->faker->numberBetween(0,50),
            'is_active' => true,
        ];
    }
}
