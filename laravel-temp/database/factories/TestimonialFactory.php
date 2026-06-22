<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition()
    {
        return [
            'customer_name' => $this->faker->name(),
            'customer_image' => 'seed-images/customer.jpg',
            'rating' => $this->faker->numberBetween(4,5),
            'review' => $this->faker->paragraph(),
            'is_active' => true,
        ];
    }
}
