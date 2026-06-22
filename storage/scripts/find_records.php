<?php
require __DIR__ . '/../../vendor/autoload.php';
$app = require __DIR__ . '/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\ContactMessage;
use App\Models\Reservation;
use App\Models\Order;

$contact = ContactMessage::where('email','test.user@example.test')->orderBy('id','desc')->first();
$res = Reservation::where('email','reserve@test.example')->orderBy('id','desc')->first();
$order = Order::where('email','order@test.example')->orderBy('id','desc')->first();

if($contact) echo "contact_found:" . $contact->id . PHP_EOL; else echo "contact_found:0".PHP_EOL;
if($res) echo "reservation_found:" . $res->id . PHP_EOL; else echo "reservation_found:0".PHP_EOL;
if($order) echo "order_found:" . ($order? $order->id : 0) . PHP_EOL; else echo "order_found:0".PHP_EOL;
