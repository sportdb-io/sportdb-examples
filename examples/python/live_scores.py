"""Live (in-progress) football scores."""
import os
import requests

KEY = os.environ["SPORTDB_API_KEY"]
r = requests.get(
    "https://sportdb.io/v1/football/scores/live",
    headers={"X-API-Key": KEY},
    params={"limit": 20},
    timeout=20,
)
r.raise_for_status()

data = r.json()["data"]
if not data:
    print("No live football matches right now.")
for m in data:
    s = m.get("score", {})
    print(f"{m['home']} {s.get('home', '?')}-{s.get('away', '?')} {m['away']}  "
          f"[{m.get('status_detail', '')}]  {m.get('tournament', '')}")
