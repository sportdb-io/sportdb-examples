# Use sportdb.io from an AI agent (MCP)

sportdb.io ships a remote **MCP server** (Model Context Protocol) over Streamable
HTTP, so Claude, Cursor and other MCP clients can call the API as native tools.

- Endpoint: `https://sportdb.io/v1/mcp`
- Auth: your `X-API-Key` (get a free key at https://sportdb.io/register)
- Tools: `live_scores`, `fixtures`, `odds`, `value_bets`, `arbitrage`,
  `dropping_odds`, `countries`, `competitions`, `standings`

## Connect (clients without native remote MCP — via the mcp-remote bridge)
```json
{
  "mcpServers": {
    "sportdb": {
      "command": "npx",
      "args": ["mcp-remote", "https://sportdb.io/v1/mcp",
               "--header", "X-API-Key:sdb_live_YOUR_KEY"]
    }
  }
}
```

## Connect (clients with native remote / HTTP MCP)
```json
{
  "mcpServers": {
    "sportdb": {
      "type": "http",
      "url": "https://sportdb.io/v1/mcp",
      "headers": { "X-API-Key": "sdb_live_YOUR_KEY" }
    }
  }
}
```

(Claude Desktop: add this to `claude_desktop_config.json`. Cursor: Settings → MCP.)

## Try these prompts
- "Using sportdb, what are the live football scores right now?"
- "Get the best 1x2 odds for upcoming Premier League matches."
- "Any value bets in football with EV over 2%?"
- "Show the current Premier League standings."

## Raw JSON-RPC (debug)
```bash
curl -s https://sportdb.io/v1/mcp \
  -H "X-API-Key: sdb_live_YOUR_KEY" -H "Content-Type: application/json" \
  -d '{"jsonrpc":"2.0","id":1,"method":"tools/list"}'
```

> value / arbitrage / dropping-odds are market-derived information, not betting
> advice or a guarantee of profit.
