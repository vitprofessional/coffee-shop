<?php

namespace Database\Factories;

use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactMessageFactory extends Factory
{
    protected $model = ContactMessage::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->optional()->safeEmail(),
            'phone' => $this->faker->optional()->phoneNumber(),
            'subject' => $this->faker->sentence(3),
            'message' => $this->faker->paragraph(),
            'status' => 'new',
        ];
    }
}
