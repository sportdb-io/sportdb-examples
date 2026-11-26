<?php
// Live (in-progress) football scores.  php examples/php/live_scores.php
$key = getenv('SPORTDB_API_KEY') ?: exit("set SPORTDB_API_KEY\n");
$ch = curl_init('https://sportdb.io/v1/football/scores/live?limit=20');
curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_HTTPHEADER => ["X-API-Key: $key"]]);
$data = json_decode(curl_exec($ch), true)['data'] ?? [];

if (!$data) {
    echo "No live football matches right now.\n";
}
foreach ($data as $m) {
    $s = $m['score'] ?? [];
    echo "{$m['home']} " . ($s['home'] ?? '?') . "-" . ($s['away'] ?? '?') . " {$m['away']}  [{$m['status_detail']}]\n";
}
