<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$email = 'admin@mausereserve.test';
$user = User::where('email', $email)->first();
if ($user) {
    echo "Admin already exists: {$user->email}\n";
    exit;
}

$user = User::create([
    'name' => 'Admin User',
    'email' => $email,
    'password' => 'password',
    'is_admin' => true,
]);

echo "Created admin: {$user->email} with password 'password'\n";
