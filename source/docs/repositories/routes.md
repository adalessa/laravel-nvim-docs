---
title: Routes Repository
description: Getting application routes
extends: _layouts.documentation
section: content
---

# Routes Repository {#routes-repository}

Given that the routes are the entry point of you application
is very usefull to interact with them.
The plugin use it for route info feature, routes picker, and completion

```lua
local app = require("laravel").app

app("routes_repository"):all():thenCall(function(routes)
  vim.print(#routes)
end)
```

Depending on the configuration this may be an expense operation
Because of that I would advie to use the cache version of it.


```lua
local app = require("laravel").app

app("cache_routes_repository"):all():thenCall(function(routes)
  vim.print(#routes)
end)
```

In case you need to invalidate the cache the method `clear` can be use

```lua
local app = require("laravel").app

app("cache_routes_repository"):clear()
```

## Source  {#routes-repository-source}

The source of this is running `artisan routes:list --json` there you can
take a look all values possible.
