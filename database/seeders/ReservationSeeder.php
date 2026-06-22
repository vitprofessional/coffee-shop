<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create();
        $statuses = ['pending','approved','cancelled'];

        for ($i = 0; $i < 25; $i++) {
            $date = $faker->dateTimeBetween('-30 days', '+30 days');
            Reservation::create([
                'name' => $faker->name(),
                'phone' => $faker->phoneNumber(),
                'email' => $faker->optional()->safeEmail(),
                'reservation_date' => $date->format('Y-m-d'),
                'reservation_time' => $date->format('H:i:00'),
                'guests' => $faker->numberBetween(1,8),
                'seating_preference' => $faker->randomElement(['Inside','Outside','Window','Bar']),
                'special_request' => $faker->optional()->sentence(),
                'status' => $faker->randomElement($statuses),
            ]);
        }
    }
}

