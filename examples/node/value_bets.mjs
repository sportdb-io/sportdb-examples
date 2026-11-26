// Active +EV value candidates (requires a paid plan). Information, not advice.
const KEY = process.env.SPORTDB_API_KEY;
if (!KEY) throw new Error("set SPORTDB_API_KEY");

const res = await fetch("https://sportdb.io/v1/football/value?min_ev=1&limit=10", {
  headers: { "X-API-Key": KEY },
});
if (res.status === 403) {
  console.error("Signals need a paid plan (Pro+): https://sportdb.io/#pricing");
  process.exit(1);
}
if (!res.ok) throw new Error(`HTTP ${res.status}`);
const j = await res.json();

for (const v of j.data) {
  console.log(`${v.home} vs ${v.away} | ${v.market} ${v.outcome} @ ${v.book} ${v.odd} (fair ${v.fair_odd}, EV ${v.ev_pct}%)`);
}
console.log("\n" + (j.disclaimer ?? ""));
