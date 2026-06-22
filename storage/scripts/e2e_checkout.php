<?php
// Simple cURL based end-to-end test: add first available menu item to cart and place order
$base = 'http://127.0.0.1:8000';
$cookie = __DIR__ . '/e2e_cookies.txt';
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
    $headers = [];
    $header_size = $info['header_size'] ?? 0;
    curl_close($ch);
    return [$res, $info];
}

list($html, $info) = curl_get($base . '/menu', $cookie);
if(!preg_match('/name="_token" value="([^"]+)"/', $html, $m)){
    echo "no_token\n"; exit(1);
}
$token = $m[1];
echo "got_menu_token\n";

// find first available menu item id from page (hidden in data or rely on id 1)
// we'll use id=1 as test
$post = ['menu_item_id' => '1','quantity'=>'1','_token'=>$token];
list($r1,$i1) = curl_post($base . '/cart/add', http_build_query($post), $cookie);
echo "cart_add_status:" . ($i1['http_code'] ?? 'NA') . "\n";

list($cartHtml,$ci) = curl_get($base . '/cart', $cookie);
if(stripos($cartHtml,'Your cart') !== false || stripos($cartHtml,'Total') !== false){ echo "cart_page_ok\n"; } else { echo "cart_page_missing\n"; }

// get checkout token
list($chkHtml,$cki) = curl_get($base . '/checkout', $cookie);
if(!preg_match('/name="_token" value="([^"]+)"/', $chkHtml, $m2)){
    echo "no_checkout_token\n"; exit(1);
}
$t2 = $m2[1];
echo "got_checkout_token\n";

$orderData = [
    'customer_name'=>'E2E Buyer',
    'phone'=>'+15550000125',
    'email'=>'order.final2@test',
    'address'=>'100 Test Blvd',
    'order_type'=>'pickup',
    'payment_method'=>'cash',
    'notes'=>'E2E automated order',
    '_token'=>$t2,
];
list($ordRes,$ordInfo) = curl_post($base . '/order', http_build_query($orderData), $cookie);
echo "order_http:" . ($ordInfo['http_code'] ?? 'NA') . "\n";
if(!empty($ordInfo['redirect_url'])){ echo "redirect:" . $ordInfo['redirect_url'] . "\n"; }
// Sometimes location header present in response headers
// check logs for created order
echo "done\n";
