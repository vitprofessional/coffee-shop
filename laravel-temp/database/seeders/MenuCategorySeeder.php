<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuCategory;

class MenuCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name'=>'Espresso','slug'=>'espresso'],
            ['name'=>'Signature Drinks','slug'=>'signature-drinks'],
            ['name'=>'Cold Brew','slug'=>'cold-brew'],
            ['name'=>'Pastries','slug'=>'pastries'],
            ['name'=>'Add-ons','slug'=>'add-ons'],
        ];

        foreach ($categories as $c) {
            MenuCategory::updateOrCreate(['slug'=>$c['slug']], array_merge($c, ['description'=>null, 'image'=>'seed-images/menu-category.jpg']));
        }
    }
}
