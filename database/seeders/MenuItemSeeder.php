<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\MenuItem;
use App\Models\MenuCategory;
use Faker\Factory as FakerFactory;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create();

        $categories = MenuCategory::pluck('id', 'name')->all();

        $items = [
            ['Signature Coffee','House Reserve Blend'],
            ['Signature Coffee','House Espresso Blend'],
            ['Single Origin','Ethiopian Yirgacheffe'],
            ['Single Origin','Colombian Supremo'],
            ['Single Origin','Kenyan AA'],
            ['Espresso','Vanilla Latte'],
            ['Espresso','Cappuccino'],
            ['Espresso','Flat White'],
            ['Cold Brew','Caramel Cold Brew'],
            ['Cold Brew','Nitro Cold Brew'],
            ['Cold Brew','Citrus Cold Brew'],
            ['Pastries','Chocolate Croissant'],
            ['Pastries','Cinnamon Roll'],
            ['Pastries','Almond Croissant'],
            ['Pastries','Blueberry Muffin'],
            ['Seasonal Specials','Pumpkin Spice Latte'],
            ['Seasonal Specials','Gingerbread Latte'],
            ['Seasonal Specials','Holiday Blend'],
            ['Signature Coffee','Single Origin Flight'],
            ['Espresso','Cortado'],
            ['Cold Brew','Vanilla Cold Brew'],
            ['Signature Coffee','Decaf Reserve'],
            ['Single Origin','Guatemalan Huehuetenango'],
            ['Single Origin','Brazilian Santos'],
            ['Pastries','Walnut Scone'],
            ['Pastries','Lemon Tart'],
            ['Seasonal Specials','Maple Latte'],
            ['Espresso','Mocha'],
            ['Signature Coffee','Barista Special'],
            ['Cold Brew','Iced Latte'],
        ];

        // images from public/images/menu
        $imageFiles = [];
        $menuPath = public_path('images/menu');
        if (is_dir($menuPath)) {
            foreach (glob($menuPath . '/*') as $f) {
                $imageFiles[] = 'images/menu/' . basename($f);
            }
        }

        foreach ($items as $spec) {
            [$categoryName, $title] = $spec;
            $categoryId = $categories[$categoryName] ?? null;
            if (! $categoryId) continue;

            $slug = Str::slug($title);
            // ensure unique
            $base = $slug;
            $i = 1;
            while (MenuItem::where('slug', $slug)->exists()) {
                $slug = $base . '-' . $i++;
            }

            $image = null;
            if (!empty($imageFiles)) {
                $image = $faker->randomElement($imageFiles);
            }

            MenuItem::create([
                'menu_category_id' => $categoryId,
                'name' => $title,
                'slug' => $slug,
                'description' => $faker->sentence(12),
                'price' => $faker->randomFloat(2, 4.5, 29.9),
                'image' => $image,
                'is_featured' => $faker->boolean(20),
                'is_popular' => $faker->boolean(30),
                'is_available' => true,
                'sort_order' => 0,
            ]);
        }

        // ensure we have at least 30 items: generate additional
        $existing = MenuItem::count();
        while ($existing < 30) {
            $categoryId = $faker->randomElement(array_values($categories));
            $title = ucfirst($faker->words(3, true));
            $slug = Str::slug($title) . '-' . $faker->unique()->numberBetween(1,9999);
            $image = !empty($imageFiles) ? $faker->randomElement($imageFiles) : null;

            MenuItem::create([
                'menu_category_id' => $categoryId,
                'name' => $title,
                'slug' => $slug,
                'description' => $faker->sentence(12),
                'price' => $faker->randomFloat(2, 4.5, 29.9),
                'image' => $image,
                'is_featured' => $faker->boolean(10),
                'is_popular' => $faker->boolean(25),
                'is_available' => $faker->boolean(90),
                'sort_order' => 0,
            ]);

            $existing++;
        }
    }
}

