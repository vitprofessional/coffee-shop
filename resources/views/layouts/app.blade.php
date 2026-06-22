<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Mausé Reserve — Crafted Beyond Seasons">
    <title>@yield('title','Mausé Reserve — Crafted Beyond Seasons')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        :root{
            --brand-brown:#4B2E2B;
            --brand-cream:#F5F1EA;
            --brand-espresso:#1B1B1B;
            --brand-gold:#C8A96B;
        }
    </style>
    @stack('head')
</head>
<body class="antialiased text-gray-900 bg-[var(--brand-cream)] font-body" x-data="{mobile:false, selectedMenu:'All'}">
    <header class="sticky top-0 z-40 bg-white/60 backdrop-blur-md shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                <a href="{{ url('/') }}" class="flex items-center gap-3 focus-ring" aria-label="Mausé Reserve home">
                    <div class="w-10 h-10 rounded-full" style="background:var(--brand-brown);"></div>
                    <div>
                        <div class="text-lg font-heading text-2xl" style="color:var(--brand-espresso)">Mausé Reserve</div>
                        <div class="text-xs tracking-wide font-body" style="color:var(--brand-brown)">Crafted Beyond Seasons</div>
                    </div>
                </a>
                <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[var(--brand-brown)] font-semibold' : 'hover:text-gray-700' }}">Home</a>
                    <a href="{{ route('menu.index') }}" class="{{ request()->routeIs('menu.*') ? 'text-[var(--brand-brown)] font-semibold' : 'hover:text-gray-700' }}">Coffee</a>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-[var(--brand-brown)] font-semibold' : 'hover:text-gray-700' }}">Our Story</a>
                    <a href="{{ route('gallery.index') }}" class="{{ request()->routeIs('gallery.*') ? 'text-[var(--brand-brown)] font-semibold' : 'hover:text-gray-700' }}">Moments</a>
                    <a href="{{ route('events.index') }}" class="{{ request()->routeIs('events.*') ? 'text-[var(--brand-brown)] font-semibold' : 'hover:text-gray-700' }}">Events</a>
                    <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'text-[var(--brand-brown)] font-semibold' : 'hover:text-gray-700' }}">Journal</a>
                    <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.*') ? 'text-[var(--brand-brown)] font-semibold' : 'hover:text-gray-700' }}">Contact</a>
                </nav>
                <div class="flex items-center gap-3">
                    <a href="{{ route('reservation.index') }}" class="{{ request()->routeIs('reservation.*') ? 'hidden md:inline-block px-4 py-2 rounded-md transition-smooth focus-ring ring-2 ring-[var(--brand-brown)]' : 'hidden md:inline-block px-4 py-2 rounded-md transition-smooth focus-ring' }}" style="background:var(--brand-brown);color:var(--brand-cream)">Reserve</a>
                    <button @click="mobile=!mobile" class="md:hidden p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
        </div>
                <div x-show="mobile" x-transition class="md:hidden bg-white border-t">
                <div class="px-4 py-4 flex flex-col gap-2 font-body">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'py-2 font-semibold text-[var(--brand-brown)]' : 'py-2' }}">Home</a>
                <a href="{{ route('menu.index') }}" class="{{ request()->routeIs('menu.*') ? 'py-2 font-semibold text-[var(--brand-brown)]' : 'py-2' }}">Coffee</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'py-2 font-semibold text-[var(--brand-brown)]' : 'py-2' }}">Our Story</a>
                <a href="{{ route('gallery.index') }}" class="{{ request()->routeIs('gallery.*') ? 'py-2 font-semibold text-[var(--brand-brown)]' : 'py-2' }}">Moments</a>
                <a href="{{ route('events.index') }}" class="{{ request()->routeIs('events.*') ? 'py-2 font-semibold text-[var(--brand-brown)]' : 'py-2' }}">Events</a>
                <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'py-2 font-semibold text-[var(--brand-brown)]' : 'py-2' }}">Journal</a>
                <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.*') ? 'py-2 font-semibold text-[var(--brand-brown)]' : 'py-2' }}">Contact</a>
                <a href="{{ route('reservation.index') }}" class="{{ request()->routeIs('reservation.*') ? 'py-2 font-semibold text-[var(--brand-brown)]' : 'py-2 font-semibold' }}" style="color:var(--brand-brown)">Reserve</a>
            </div>
        </div>
    </header>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-[var(--brand-espresso)] text-[var(--brand-cream)]">
                <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="text-2xl font-heading">Mausé Reserve</div>
                <p class="mt-3 text-sm font-body">Crafted Beyond Seasons — a premium coffee experience celebrating beans, craft, and hospitality.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-3 font-body">Explore</h4>
                <ul class="space-y-2 text-sm font-body">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('menu.index') }}">Coffee</a></li>
                    <li><a href="{{ route('about') }}">Our Story</a></li>
                    <li><a href="{{ route('gallery.index') }}">Moments</a></li>
                    <li><a href="{{ route('events.index') }}">Events</a></li>
                    <li><a href="{{ route('blog.index') }}">Journal</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-3 font-body">Contact</h4>
                <p class="text-sm font-body">Email: hello@mause-reserve.test</p>
                <p class="text-sm mt-2 font-body">Address: Luxury Coffee House</p>
            </div>
        </div>
        <div class="border-t border-white/10 py-4 text-center text-xs font-body">© {{ date('Y') }} Mausé Reserve — Crafted Beyond Seasons</div>
    </footer>

        @stack('scripts')
    </body>
    </html>
