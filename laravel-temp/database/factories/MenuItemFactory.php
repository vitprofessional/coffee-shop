<?php

namespace Database\Factories;

use App\Models\MenuItem;
use App\Models\MenuCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MenuItemFactory extends Factory
{
    protected $model = MenuItem::class;

    public function definition()
    {
        $name = $this->faker->unique()->words(3, true);
        return [
            'menu_category_id' => MenuCategory::inRandomOrder()->first()?->id ?? MenuCategory::factory(),
            'name' => ucfirst($name),
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1, 9999),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 2, 25),
            'image' => 'seed-images/menu-item.jpg',
            'is_featured' => $this->faker->boolean(15),
            'is_popular' => $this->faker->boolean(20),
            'is_available' => true,
            'sort_order' => $this->faker->numberBetween(0, 100),
        ];
    }
}
