<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create();

        $names = [
            'Sarah Mitchell','Michael Carter','Emma Thompson','Daniel Brooks','Olivia Reed',
            'Liam Johnson','Sophia Brown','Ethan Davis','Isabella Wilson','Noah Miller',
            'Mia Anderson','James Taylor','Charlotte Harris','Benjamin Clark','Amelia Lee'
        ];

        foreach ($names as $i => $name) {
            Testimonial::create([
                'customer_name' => $name,
                'customer_image' => null,
                'rating' => $faker->numberBetween(4,5),
                'review' => $faker->sentences(3, true),
                'is_active' => true,
            ]);
        }
    }
}

