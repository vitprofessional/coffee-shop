<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $items = MenuItem::with('category')->available()->paginate(12);
        $categories = MenuCategory::active()->get();
        return view('menu.index', compact('items','categories'));
    }

    public function show($slug)
    {
        $item = MenuItem::with('category')->where('slug', $slug)->available()->firstOrFail();
        return view('menu.show', compact('item'));
    }
}
