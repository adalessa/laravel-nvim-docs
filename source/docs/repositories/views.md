---
title: Views Repository
description: Getting application views
extends: _layouts.documentation
section: content
---

# Views Repository {#views-repository}

You will have to interact with views, so we need it, for `view_finder` and
for completion

```lua
local app = require("laravel").app

app("views_repository"):all():thenCall(function(views)
  vim.print(#views)
end)
```

Depending on the configuration this may be an expense operation
Because of that I would advie to use the cache version of it.


```lua
local app = require("laravel").app

app("cache_views_repository"):all():thenCall(function(views)
  vim.print(#views)
end)
```

In case you need to invalidate the cache the method `clear` can be use

```lua
local app = require("laravel").app

app("cache_views_repository"):clear()
```

## Source  {#routes-repository-source}

The views are a bit more tricky, but the gist of it, get the resource path
using tinker and command `resource_path` for `views`.
With that scan the directory and parse it. Each view has `name` and `path`.
