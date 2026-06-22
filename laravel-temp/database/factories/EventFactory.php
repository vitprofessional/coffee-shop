<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        $title = $this->faker->sentence(4);
        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1,9999),
            'description' => $this->faker->paragraphs(3, true),
            'image' => 'seed-images/event.jpg',
            'event_date' => $this->faker->dateTimeBetween('+1 days', '+60 days')->format('Y-m-d'),
            'event_time' => $this->faker->optional()->time(),
            'location' => $this->faker->city(),
            'price' => $this->faker->optional()->randomFloat(2, 0, 100),
            'is_active' => true,
        ];
    }
}
