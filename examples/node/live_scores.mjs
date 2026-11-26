// Live (in-progress) football scores (Node 18+).
const KEY = process.env.SPORTDB_API_KEY;
if (!KEY) throw new Error("set SPORTDB_API_KEY");

const res = await fetch("https://sportdb.io/v1/football/scores/live?limit=20", {
  headers: { "X-API-Key": KEY },
});
if (!res.ok) throw new Error(`HTTP ${res.status}`);
const { data } = await res.json();

if (!data.length) console.log("No live football matches right now.");
for (const m of data) {
  const s = m.score ?? {};
  console.log(`${m.home} ${s.home ?? "?"}-${s.away ?? "?"} ${m.away}  [${m.status_detail ?? ""}]`);
}
