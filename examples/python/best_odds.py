"""Best price per outcome across every book, for upcoming football matches."""
import os
import requests

KEY = os.environ["SPORTDB_API_KEY"]  # https://sportdb.io/register
r = requests.get(
    "https://sportdb.io/v1/football/odds",
    headers={"X-API-Key": KEY},
    params={"limit": 10},
    timeout=20,
)
r.raise_for_status()

for ev in r.json()["data"]:
    print(f"{ev['home']} vs {ev['away']}  ({ev.get('league', '')})")
    best = ev.get("best", {})
    for outcome in ("home", "draw", "away"):
        if best.get(outcome):
            print(f"  {outcome:>4}: {best[outcome]['odd']} @ {best[outcome]['book']}")
