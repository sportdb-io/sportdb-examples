# sportdb.io examples

Tiny, runnable examples for the [sportdb.io](https://sportdb.io) Sports Data &
Odds API — live scores, fixtures, standings and bookmaker odds (20+ books +
exchanges, with the **best price per outcome**) plus value / arbitrage /
dropping-odds signals, across football, basketball, tennis and ice hockey.

Clone, add a free API key, run — in your language of choice, in the browser, or
straight from an AI agent via MCP.

## 1. Get a free API key
Create a free account at **https://sportdb.io/register** (100 requests/day, no
card). Then:

```bash
cp .env.example .env
# edit .env and set SPORTDB_API_KEY=sdb_live_...
export SPORTDB_API_KEY=sdb_live_...   # or use your shell/profile
```

## 2. Run an example

**curl**
```bash
bash examples/curl.sh
```

**Python** (`pip install -r examples/python/requirements.txt`)
```bash
python examples/python/best_odds.py
python examples/python/live_scores.py
python examples/python/value_bets.py     # needs a paid plan (signals)
```

**Node** (18+)
```bash
node examples/node/best_odds.mjs
node examples/node/live_scores.mjs
```

**PHP**
```bash
php examples/php/best_odds.php
```

## 3. Browser demo — odds comparison
Open `demo/odds-comparison.html` in your browser, paste your key, and get a
best-price comparison table across every book. No build step.

## 4. Use it from an AI agent (MCP)
sportdb.io ships a remote **MCP server**. See [`mcp/README.md`](mcp/README.md) to
connect Claude / Cursor and let your agent call live scores, odds and signals as
tools.

## API basics
- Base URL: `https://sportdb.io/v1`
- Auth header: `X-API-Key: sdb_live_...`
- Sport-first routes: `/v1/{sport}/odds`, `/v1/{sport}/scores`,
  `/v1/{sport}/fixtures`, `/v1/{sport}/{country}/{competition}/{season}/standings`, …
- Docs: https://sportdb.io/docs · Reference: https://sportdb.io/reference

> Value / arbitrage / dropping-odds are signals computed from the market. They
> are information, **not betting advice or a guarantee of profit**.

MIT licensed.
