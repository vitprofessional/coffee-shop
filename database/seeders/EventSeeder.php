<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create();

        $titles = [
            'Coffee Tasting Night',
            'Latte Art Workshop',
            'Roastery Tour',
            'Brewing Masterclass',
            'Seasonal Blend Release',
            'Barista Basics',
            'Advanced Cupping Session',
            'Cold Brew Clinic',
            'Sustainable Sourcing Talk',
            'Home Brewing Techniques',
            'Coffee & Pastry Pairing',
            'Community Open House',
        ];

        $images = [];
        $eventsPath = public_path('images/events');
        if (is_dir($eventsPath)) {
            foreach (glob($eventsPath . '/*') as $f) {
                $images[] = 'images/events/' . basename($f);
            }
        }

        for ($i = 0; $i < 12; $i++) {
            $dt = $faker->dateTimeBetween('now', '+90 days');
            Event::create([
                'title' => $titles[$i % count($titles)],
                'slug' => \Illuminate\Support\Str::slug($titles[$i % count($titles)]) . '-' . ($i+1),
                'description' => $faker->paragraph(4),
                'image' => $images[$i % max(1, count($images))] ?? null,
                'event_date' => $dt->format('Y-m-d'),
                'event_time' => $dt->format('H:i:00'),
                'location' => $faker->address(),
                'price' => $faker->randomFloat(2, 0, 75),
                'is_active' => true,
            ]);
        }
    }
}

