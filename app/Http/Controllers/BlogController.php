<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::published()->paginate(10);
        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = BlogPost::published()->where('slug', $slug)->firstOrFail();
        return view('blog.show', compact('post'));
    }
}
