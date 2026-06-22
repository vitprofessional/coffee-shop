<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->optional()->safeEmail(),
            'reservation_date' => $this->faker->dateTimeBetween('+1 days', '+30 days')->format('Y-m-d'),
            'reservation_time' => $this->faker->time('H:i'),
            'guests' => $this->faker->numberBetween(1,6),
            'seating_preference' => $this->faker->randomElement([null,'window','booth','outdoor']),
            'special_request' => $this->faker->optional()->sentence(),
            'status' => 'pending',
        ];
    }
}
