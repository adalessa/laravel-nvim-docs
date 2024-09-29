---
title: Configs Repository
description: Getting application configuration
extends: _layouts.documentation
section: content
---

# Configs Repository {#configs-repository}

The config keys and values are usefull for completion and for route picker
to get the current url to open the selected route.

```lua
local app = require("laravel").app

app("configs_repository"):all():thenCall(function(configs)
  vim.print(#configs)
end)

app("configs_repository"):get('app.url'):thenCall(function(value)
  vim.print(value)
end)
```

Depending on the configuration this may be an expense operation
Because of that I would advie to use the cache version of it.


```lua
local app = require("laravel").app

app("cache_configs_repository"):all():thenCall(function(configs)
  vim.print(#configs)
end)

app("cache_configs_repository"):get('app.url'):thenCall(function(value)
  vim.print(value)
end)
```

In case you need to invalidate the cache the method `clear` can be use

```lua
local app = require("laravel").app

app("cache_configs_repository"):clear()
```

## Source  {#routes-repository-source}

To get this tinker is essential running php code
```php
// all keys
echo json_encode(array_keys(Arr::dot(Config::all())));

// specif value
echo json_encode(config('app.url'));
```
