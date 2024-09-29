---
title: Commands Repository
description: Getting started with Laravel NVIM
extends: _layouts.documentation
section: content
---

# Commands Repository {#commands-repository}

An essential part of the plugin is to retrieve the commands available
to interact with, because of this this exists.

```lua
local app = require("laravel").app

app("commands_repository"):all():thenCall(function(commands)
  vim.print(#commands)
end)
```

Depending on the configuration this may be an expense operation
Because of that I would advie to use the cache version of it.


```lua
local app = require("laravel").app

app("cache_commands_repository"):all():thenCall(function(commands)
  vim.print(#commands)
end)
```

In case you need to invalidate the cache the method `clear` can be use

```lua
local app = require("laravel").app

app("cache_commands_repository"):clear()
```

## Source  {#commands-repository-source}

The source of this is running `artisan list --format=json` there you can
take a look all values possible, for sannity the repository filters out
the hidden commands.
