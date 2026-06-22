<?php
$base = 'http://127.0.0.1:8000';
$cookie = __DIR__ . '/e2e_test_cookies.txt';
@unlink($cookie);

function curl_get($url, $cookie){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    $res = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    return [$res, $info];
}

function curl_post($url, $data, $cookie){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    $res = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    return [$res, $info];
}

list($html, $info) = curl_get($base . '/menu', $cookie);
if(!preg_match('/name="_token" value="([^"]+)"/', $html, $m)){
    echo "no_token\n"; exit(1);
}
$token = $m[1];

// add item id=1
$post = ['menu_item_id' => '1','quantity'=>'1','_token'=>$token];
list($r1,$i1) = curl_post($base . '/cart/add', http_build_query($post), $cookie);
echo "cart_add_status:" . ($i1['http_code'] ?? 'NA') . "\n";

// update cart item 1 to quantity 3
$update = ['items[1]' => '3', '_token' => $token];
list($uRes,$uInfo) = curl_post($base . '/cart/update', http_build_query($update), $cookie);
echo "cart_update_status:" . ($uInfo['http_code'] ?? 'NA') . "\n";

list($cartHtml,$ci) = curl_get($base . '/cart', $cookie);
if(strpos($cartHtml,'value="3"') !== false){
    echo "update_reflected\n";
} else {
    echo "update_not_reflected\n";
}

// try remove via POST
$remove = ['id'=>'1','_token'=>$token];
list($rRem,$rInfo) = curl_post($base . '/cart/remove', http_build_query($remove), $cookie);
echo "remove_status:" . ($rInfo['http_code'] ?? 'NA') . "\n";

list($cartHtml2,$ci2) = curl_get($base . '/cart', $cookie);
if(stripos($cartHtml2,'Your cart is currently empty') !== false || stripos($cartHtml2,'Your cart is empty') !== false){
    echo "remove_reflected\n";
} else {
    echo "remove_not_reflected\n";
}

echo "done\n";
