#!/usr/bin/env bash
# sportdb.io — core endpoints via curl.  Usage: SPORTDB_API_KEY=... bash examples/curl.sh
set -euo pipefail
: "${SPORTDB_API_KEY:?set SPORTDB_API_KEY (get one free at https://sportdb.io/register)}"
BASE="https://sportdb.io/v1"
H="X-API-Key: ${SPORTDB_API_KEY}"

echo "# health (public)";            curl -s "$BASE/health"; echo
echo "# live football scores";       curl -s -H "$H" "$BASE/football/scores/live?limit=5"; echo
echo "# football odds (best price)"; curl -s -H "$H" "$BASE/football/odds?limit=5"; echo
echo "# Premier League standings";   curl -s -H "$H" "$BASE/football/england/premier-league/96668/standings"; echo
echo "# value bets (paid plan)";     curl -s -H "$H" "$BASE/football/value?min_ev=1&limit=5"; echo
