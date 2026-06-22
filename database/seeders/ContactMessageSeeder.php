<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use App\Models\ContactMessage;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create();
        $subjects = ['Private event inquiry','Wholesale coffee inquiry','Reservation request','General feedback','Product question'];
        $statuses = ['pending','read','replied'];

        for ($i = 0; $i < 20; $i++) {
            ContactMessage::create([
                'name' => $faker->name(),
                'email' => $faker->safeEmail(),
                'phone' => $faker->phoneNumber(),
                'subject' => $faker->randomElement($subjects),
                'message' => $faker->paragraphs(2, true),
                'status' => $faker->randomElement($statuses),
            ]);
        }
    }
}

