<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        $menu = MenuItem::inRandomOrder()->first();
        $price = $menu?->price ?? $this->faker->randomFloat(2, 2, 20);
        $qty = $this->faker->numberBetween(1,3);

        return [
            'order_id' => Order::factory(),
            'menu_item_id' => $menu?->id,
            'item_name' => $menu?->name ?? $this->faker->word(),
            'price' => $price,
            'quantity' => $qty,
            'subtotal' => $price * $qty,
        ];
    }
}
