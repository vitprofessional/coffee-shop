<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Testimonial;
use App\Models\Gallery;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Cache::remember('home.featured', 60, function () {
            return MenuItem::with('category')->available()->featured()->limit(6)->get();
        });

        $testimonials = Testimonial::active()->limit(6)->get();
        $gallery = Gallery::active()->limit(6)->get();

        return view('pages.home', compact('featured','testimonials','gallery'));
    }
}
