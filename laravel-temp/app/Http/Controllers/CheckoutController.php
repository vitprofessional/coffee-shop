<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('checkout.index', compact('cart'));
    }

    public function store(CheckoutRequest $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->withErrors(['cart' => 'Your cart is empty']);
        }

        $order = null;
        DB::transaction(function () use ($request, $cart, &$order) {
            $subtotal = 0;
            foreach ($cart as $row) {
                $menu = MenuItem::find($row['menu_item_id']);
                if (! $menu || ! $menu->is_available) {
                    throw new \Exception('Item not available: ' . ($row['name'] ?? ''));
                }
                $price = $menu->price;
                $subtotal += $price * $row['quantity'];
            }

            $order = Order::create([
                'order_number' => strtoupper(uniqid('MSR')),
                'customer_name' => $request->customer_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'order_type' => $request->order_type,
                'payment_method' => $request->payment_method,
                'subtotal' => $subtotal,
                'delivery_charge' => 0,
                'total' => $subtotal,
                'status' => 'pending',
                'notes' => $request->notes,
            ]);

            foreach ($cart as $row) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $row['menu_item_id'],
                    'item_name' => $row['name'],
                    'price' => $row['price'],
                    'quantity' => $row['quantity'],
                    'subtotal' => $row['subtotal'],
                ]);
            }
        });

        session()->forget('cart');
        return redirect()->route('order.success', $order->order_number);
    }
}
