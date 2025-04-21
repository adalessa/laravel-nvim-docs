---
title: Pickers
description: The best way to interact with laravel
extends: _layouts.documentation
section: content
---

# Pickers {#pickers}

Any picker is a core part of the neovim configuration and this plugin don't forget about it.

## Supported Providers
- Telescope
- Snacks
- FzfLua
- Select

## Available Pickers
- artisan
- commands
- composer
- history
- make
- related
- resources
- routes

## Config
To enable the pickers set the config
```lua
opts = {
    features = {
        pickers = {
            enable = true,
            provider = "telescope|snacks|fzf-lua|ui.select",
        }
    }
}
```

To call the pickers can use the normal commands `Laravel artisan`
The commands will use the config provider when no sub command is provided.
