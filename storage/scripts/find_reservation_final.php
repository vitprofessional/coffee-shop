<?php
require __DIR__ . '/../../vendor/autoload.php';
$app = require __DIR__ . '/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Reservation;
$res = Reservation::where('email','reserve.final@test')->orderBy('id','desc')->first();
if($res) echo "found:" . $res->id . "\n"; else echo "not_found\n";