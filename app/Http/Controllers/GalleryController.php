<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $items = Gallery::active()->paginate(12);
        return view('gallery.index', compact('items'));
    }
}
