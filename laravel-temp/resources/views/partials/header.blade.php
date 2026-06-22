<header class="sticky top-0 bg-white shadow z-50">
  <div class="container mx-auto px-4 py-4 flex justify-between items-center">
    <a href="{{ route('home') }}" class="text-2xl font-bold text-[#4B2E2B]">Mausé Reserve</a>
    <nav class="space-x-4">
      <a href="{{ route('menu.index') }}">Menu</a>
      <a href="{{ route('gallery.index') }}">Gallery</a>
      <a href="{{ route('events.index') }}">Events</a>
      <a href="{{ route('blog.index') }}">Blog</a>
      <a href="{{ route('contact.index') }}">Contact</a>
      <a href="{{ route('cart.index') }}" class="bg-[#C8A96B] text-white px-3 py-1 rounded">Cart</a>
    </nav>
  </div>
</header>
