<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use App\Models\BlogPost;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        BlogCategory::factory()->count(3)->create();
        BlogPost::factory()->count(4)->create();
    }
}
