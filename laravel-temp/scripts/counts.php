<?php
require __DIR__ . '/..\vendor\autoload.php';
$app = require __DIR__ . '/..\bootstrap\app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
\Illuminate\Support\Facades\DB::listen(function () {});
echo 'menu_categories:' . App\Models\MenuCategory::count() . PHP_EOL;
echo 'menu_items:' . App\Models\MenuItem::count() . PHP_EOL;
echo 'galleries:' . App\Models\Gallery::count() . PHP_EOL;
echo 'testimonials:' . App\Models\Testimonial::count() . PHP_EOL;
echo 'blog_posts:' . App\Models\BlogPost::count() . PHP_EOL;
echo 'events:' . App\Models\Event::count() . PHP_EOL;
echo 'reservations:' . App\Models\Reservation::count() . PHP_EOL;
echo 'orders:' . App\Models\Order::count() . PHP_EOL;
echo 'contact_messages:' . App\Models\ContactMessage::count() . PHP_EOL;
echo 'users:' . App\Models\User::count() . PHP_EOL;
echo 'admin_count:' . App\Models\User::where('is_admin', true)->count() . PHP_EOL;
