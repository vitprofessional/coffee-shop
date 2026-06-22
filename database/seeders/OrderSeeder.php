<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create();
        $menuItems = MenuItem::all();
        if ($menuItems->isEmpty()) return;

        $statuses = ['pending','preparing','completed','cancelled'];

        for ($i = 0; $i < 50; $i++) {
            $customer = $faker->name();
            $order = Order::create([
                'order_number' => 'MSR' . strtoupper(Str::random(8)) . ($i+1),
                'customer_name' => $customer,
                'phone' => $faker->phoneNumber(),
                'email' => $faker->optional()->safeEmail(),
                'address' => $faker->optional()->address(),
                'order_type' => $faker->randomElement(['pickup','delivery','dine-in']),
                'payment_method' => $faker->randomElement(['cash','card','online']),
                'subtotal' => 0,
                'delivery_charge' => $faker->randomFloat(2, 0, 5),
                'total' => 0,
                'status' => $faker->randomElement($statuses),
                'notes' => $faker->optional()->sentence(),
            ]);

            $itemsCount = $faker->numberBetween(1,5);
            $subtotal = 0;
            for ($j = 0; $j < $itemsCount; $j++) {
                $mi = $menuItems->random();
                $qty = $faker->numberBetween(1,4);
                $price = $mi->price;
                $line = $price * $qty;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $mi->id,
                    'item_name' => $mi->name,
                    'price' => $price,
                    'quantity' => $qty,
                    'subtotal' => $line,
                ]);

                $subtotal += $line;
            }

            $delivery = $order->delivery_charge ?: 0;
            $order->subtotal = $subtotal;
            $order->total = $subtotal + $delivery;
            $order->save();
        }
    }
}

