<?php
// Active +EV value candidates (requires a paid plan). Information, not advice.
$key = getenv('SPORTDB_API_KEY') ?: exit("set SPORTDB_API_KEY\n");
$ch = curl_init('https://sportdb.io/v1/football/value?min_ev=1&limit=10');
curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_HTTPHEADER => ["X-API-Key: $key"]]);
$resp = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($code === 403) {
    exit("Signals need a paid plan (Pro+): https://sportdb.io/#pricing\n");
}
$j = json_decode($resp, true);

foreach (($j['data'] ?? []) as $v) {
    echo "{$v['home']} vs {$v['away']} | {$v['market']} {$v['outcome']} @ {$v['book']} {$v['odd']} (fair {$v['fair_odd']}, EV {$v['ev_pct']}%)\n";
}
echo "\n" . ($j['disclaimer'] ?? '') . "\n";
