<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::factory()->count(5)->create()->each(function ($order) {
            $items = MenuItem::inRandomOrder()->limit(3)->get();
            $subtotal = 0;
            foreach ($items as $menu) {
                $qty = rand(1,3);
                $price = $menu->price ?? 5;
                $subtotal += $price * $qty;
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $menu->id,
                    'item_name' => $menu->name,
                    'price' => $price,
                    'quantity' => $qty,
                    'subtotal' => $price * $qty,
                ]);
            }
            $order->update(['subtotal' => $subtotal, 'total' => $subtotal + $order->delivery_charge]);
        });
    }
}
