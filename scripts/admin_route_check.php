<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
// Bootstrap the application so facades work (console kernel bootstrap)
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
// Create http kernel for handling requests later
$httpKernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Authenticate user id 1
Auth::loginUsingId(1);

$urls = [
    '/admin/menu-items/create',
    '/admin/events/create',
    '/admin/blog-posts/create',
    '/admin/galleries/create',
    '/admin/orders',
    '/admin/reservations',
];

foreach ($urls as $u) {
    $request = Request::create($u, 'GET');
    $response = $httpKernel->handle($request);
    $status = $response->getStatusCode();
    $content = method_exists($response, 'getContent') ? $response->getContent() : '';
    $hasServerError = preg_match('/Whoops|exception|Fatal error|ErrorException|<title>500/i', $content) ? 'yes' : 'no';
    $hasNotFound = ($status === 404 || preg_match('/404|Not Found/i', $content)) ? 'yes' : 'no';
    // try to extract title
    if (preg_match('/<title\s*>\s*([^<]+)\s*<\/title>/i', $content, $m)) {
        $title = trim($m[1]);
    } else {
        $title = '';
    }
    echo "$u | status=$status | title=" . ($title?:'(none)') . " | server_error=$hasServerError | not_found=$hasNotFound\n";
}

$httpKernel->terminate($request, $response);
