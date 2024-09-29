---
title: Resources Repository
description: Getting application resource directory
extends: _layouts.documentation
section: content
---

# Resources Repository {#resources-repository}

For example the views can be in any directory set by the user.
to avoid extra configuration the plugin relies on the application to
return the path using the `resource_path` helper.

The plugin will map it from the `cwd` than possible container usage.

```lua
local app = require("laravel").app

app("resources_repository"):get('views'):thenCall(function(path)
  vim.print(path)
end)
```

Depending on the configuration this may be an expense operation
Because of that I would advie to use the cache version of it.


```lua
local app = require("laravel").app

app("cache_resources_repository"):get('views'):thenCall(function(path)
  vim.print(path)
end)
```

In case you need to invalidate the cache the method `clear` can be use

```lua
local app = require("laravel").app

app("cache_resources_repository"):clear()
```

## Source  {#routes-repository-source}

To get this tinker is essential running php code
```php
echo resource_path('views');
```
