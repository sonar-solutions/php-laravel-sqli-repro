# PHP / Laravel SQL-injection review

Flag as a **blocking security issue (CWE-89)** any PR that passes request-controlled or otherwise untrusted data into SQL text assembled by interpolation or concatenation, including Laravel `whereRaw`, `orWhereRaw`, `selectRaw`, `orderByRaw`, `havingRaw`, `DB::raw`, `DB::statement`, and PDO/query APIs.

Unsafe examples include:
- `whereRaw("name LIKE '%$search%'")`
- `whereRaw('id = ' . $request->id)`

Do not flag Laravel query-builder values passed through ordinary `where`/`orWhere`, or raw SQL placeholders whose values are supplied separately as bindings, such as `whereRaw('name LIKE ?', [$pattern])`.

Explain the source-to-sink flow and recommend placeholders/bindings. Treat wildcard concatenation performed outside SQL text as safe when the resulting value is bound.
