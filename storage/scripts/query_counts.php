<?php
require __DIR__ . '/../../vendor/autoload.php';
$app = require __DIR__ . '/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\ContactMessage;
use App\Models\Reservation;
use App\Models\Order;

echo "contact:" . ContactMessage::count() . PHP_EOL;
echo "reservation:" . Reservation::count() . PHP_EOL;
try { echo "order:" . Order::count() . PHP_EOL; } catch (Throwable $e) { echo "order:0" . PHP_EOL; }
