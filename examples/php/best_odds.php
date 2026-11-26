<?php
// Best price per outcome across every book.  php examples/php/best_odds.php
$key = getenv('SPORTDB_API_KEY') ?: exit("set SPORTDB_API_KEY\n");
$ch = curl_init('https://sportdb.io/v1/football/odds?limit=10');
curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_HTTPHEADER => ["X-API-Key: $key"]]);
$data = json_decode(curl_exec($ch), true)['data'] ?? [];

foreach ($data as $ev) {
    echo "{$ev['home']} vs {$ev['away']} ({$ev['league']})\n";
    foreach (['home', 'draw', 'away'] as $o) {
        if (!empty($ev['best'][$o])) {
            echo "  $o: {$ev['best'][$o]['odd']} @ {$ev['best'][$o]['book']}\n";
        }
    }
}
