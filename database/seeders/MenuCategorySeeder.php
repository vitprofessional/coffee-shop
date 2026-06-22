<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuCategory;

class MenuCategorySeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Signature Coffee',
            'Single Origin',
            'Espresso',
            'Cold Brew',
            'Pastries',
            'Seasonal Specials',
        ];

        foreach ($names as $name) {
            MenuCategory::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($name)],
                ['name' => $name, 'slug' => \Illuminate\Support\Str::slug($name), 'is_active' => true]
            );
        }
    }
}

