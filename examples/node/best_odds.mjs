// Best price per outcome across every book (Node 18+, built-in fetch).
const KEY = process.env.SPORTDB_API_KEY; // https://sportdb.io/register
if (!KEY) throw new Error("set SPORTDB_API_KEY");

const res = await fetch("https://sportdb.io/v1/football/odds?limit=10", {
  headers: { "X-API-Key": KEY },
});
if (!res.ok) throw new Error(`HTTP ${res.status}`);
const { data } = await res.json();

for (const ev of data) {
  console.log(`${ev.home} vs ${ev.away} (${ev.league ?? ""})`);
  for (const o of ["home", "draw", "away"]) {
    if (ev.best?.[o]) console.log(`  ${o}: ${ev.best[o].odd} @ ${ev.best[o].book}`);
  }
}
