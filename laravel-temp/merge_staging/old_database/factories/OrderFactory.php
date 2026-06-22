<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        $items = MenuItem::inRandomOrder()->limit(2)->get();
        $subtotal = $items->sum(fn($i) => $i->price ?? 5);

        return [
            'order_number' => strtoupper(Str::random(10)),
            'customer_name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->optional()->safeEmail(),
            'address' => $this->faker->optional()->address(),
            'order_type' => 'pickup',
            'payment_method' => 'cash',
            'subtotal' => $subtotal,
            'delivery_charge' => 0,
            'total' => $subtotal,
            'status' => 'pending',
        ];
    }
}
