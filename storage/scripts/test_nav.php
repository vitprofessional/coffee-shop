<?php
$base = 'http://127.0.0.1:8000';
$paths = ['/' , '/menu', '/about', '/gallery', '/blog', '/contact', '/reservation'];
foreach($paths as $p){
    $url = rtrim($base,'/') . $p;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    echo $p . ' -> ' . ($info['http_code'] ?? 'NA') . "\n";
}
