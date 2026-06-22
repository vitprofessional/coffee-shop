<?php
$base = 'http://127.0.0.1:8000';
$map = [
    '/' => ['label'=>'Home','patterns'=>['text-\[var\(--brand-brown\)\]','font-semibold','ring-2']],
    '/menu' => ['label'=>'Coffee','patterns'=>['text-\[var\(--brand-brown\)\]','font-semibold']],
    '/about' => ['label'=>'Our Story','patterns'=>['text-\[var\(--brand-brown\)\]','font-semibold']],
    '/gallery' => ['label'=>'Moments','patterns'=>['text-\[var\(--brand-brown\)\]','font-semibold']],
    '/blog' => ['label'=>'Journal','patterns'=>['text-\[var\(--brand-brown\)\]','font-semibold']],
    '/contact' => ['label'=>'Contact','patterns'=>['text-\[var\(--brand-brown\)\]','font-semibold']],
    '/reservation' => ['label'=>'Reserve','patterns'=>['ring-2','text-\[var\(--brand-brown\)\]','font-semibold']],
];

foreach($map as $path => $info){
    $url = rtrim($base,'/') . $path;
    $html = @file_get_contents($url);
    $ok = false;
    if($html === false){
        echo "$path -> ERROR fetching\n";
        continue;
    }
    foreach($info['patterns'] as $pat){
        // look for anchor that contains the label and the class pattern
        $regex = '/<a[^>]*class="[^"]*(' . $pat . ')[^"]*"[^>]*>[^<]*' . preg_quote($info['label'], '/') . '/i';
        if(preg_match($regex, $html)){
            $ok = true; break;
        }
    }
    echo $path . ' (' . $info['label'] . ') -> ' . ($ok ? 'ACTIVE_OK' : 'ACTIVE_MISSING') . "\n";
}
