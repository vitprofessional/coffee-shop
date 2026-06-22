<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Brewing Guides',
            'Coffee Origins',
            'Roastery Notes',
            'Events & Tastings',
        ];

        foreach ($names as $name) {
            BlogCategory::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($name)],
                ['name' => $name, 'slug' => \Illuminate\Support\Str::slug($name)]
            );
        }
    }
}
