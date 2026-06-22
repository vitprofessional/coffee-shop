<?php
require __DIR__ . '/../../vendor/autoload.php';
$app = require __DIR__ . '/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Order;
$res = Order::where('email','order.final2@test')->orderBy('id','desc')->first();
if($res) echo "found:" . $res->id . " number:" . $res->order_number . "\n"; else echo "not_found\n";
