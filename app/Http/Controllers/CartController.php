<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $key = 'cart';

    public function index()
    {
        $cart = session()->get($this->key, []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate(['menu_item_id' => 'required|integer|exists:menu_items,id','quantity'=>'nullable|integer|min:1']);
        $menu = MenuItem::findOrFail($request->menu_item_id);
        if (! $menu->is_available) {
            return back()->withErrors(['item' => 'Item not available']);
        }
        $qty = max(1, (int) $request->quantity);
        $cart = session()->get($this->key, []);
        $id = $menu->id;
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
            $cart[$id]['subtotal'] = $cart[$id]['quantity'] * $cart[$id]['price'];
        } else {
            $cart[$id] = [
                'menu_item_id' => $menu->id,
                'name' => $menu->name,
                'price' => (float) $menu->price,
                'quantity' => $qty,
                'subtotal' => $qty * (float) $menu->price,
            ];
        }
        session()->put($this->key, $cart);
        return redirect()->route('cart.index')->with('success','Added to cart');
    }

    public function update(Request $request)
    {
        $request->validate(['items' => 'required|array']);
        $cart = session()->get($this->key, []);
        foreach ($request->items as $id => $qty) {
            if (isset($cart[$id])) {
                $qty = (int) max(0, $qty);
                if ($qty === 0) {
                    unset($cart[$id]);
                } else {
                    $cart[$id]['quantity'] = $qty;
                    $cart[$id]['subtotal'] = $qty * $cart[$id]['price'];
                }
            }
        }
        session()->put($this->key, $cart);
        return back()->with('success','Cart updated');
    }

    public function remove(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $cart = session()->get($this->key, []);
        unset($cart[$request->id]);
        session()->put($this->key, $cart);
        return back()->with('success','Item removed');
    }
}
