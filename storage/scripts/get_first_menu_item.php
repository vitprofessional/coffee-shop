<?php
require __DIR__ . '/../../vendor/autoload.php';
$app = require __DIR__ . '/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\MenuItem;
$m = MenuItem::where('is_available',true)->first();
if($m) echo "id:" . $m->id . " slug:" . ($m->slug ?? '') . " name:" . $m->name . "\n"; else echo "none\n";