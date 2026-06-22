<?php

namespace Database\Factories;

use App\Models\MenuCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MenuCategoryFactory extends Factory
{
    protected $model = MenuCategory::class;

    public function definition()
    {
        $name = $this->faker->unique()->words(2, true);
        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(),
            'image' => 'seed-images/menu-category.jpg',
            'sort_order' => $this->faker->numberBetween(0, 10),
            'is_active' => true,
        ];
    }
}
