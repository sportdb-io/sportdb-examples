"""Active +EV value candidates (requires a paid plan — signals).

Value is information computed from the market, NOT betting advice.
"""
import os
import requests

KEY = os.environ["SPORTDB_API_KEY"]
r = requests.get(
    "https://sportdb.io/v1/football/value",
    headers={"X-API-Key": KEY},
    params={"min_ev": 1, "limit": 10},
    timeout=20,
)
if r.status_code == 403:
    raise SystemExit("Signals need a paid plan (Pro+). Upgrade at https://sportdb.io/#pricing")
r.raise_for_status()

j = r.json()
for v in j["data"]:
    print(f"{v['home']} vs {v['away']} | {v['market']} {v['outcome']} @ "
          f"{v['book']} {v['odd']} (fair {v['fair_odd']}, EV {v['ev_pct']}%)")
print("\n" + j.get("disclaimer", ""))
