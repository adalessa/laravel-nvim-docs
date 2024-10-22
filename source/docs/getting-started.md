---
title: Getting Started
description: Getting started with Laravel NVIM
extends: _layouts.documentation
section: content
---

# Getting Started {#getting-started}

The goal of the plugin is to offer a solution out of the box, just install the plugin, set your keymaps and start using it.

## Install {#getting-started-install}

You need to just add it to you plugin manager

### Lazy nvim
Just in case you need a suggestion you can use [lazy](https://github.com/folke/lazy.nvim)
```lua
{
  "adalessa/laravel.nvim",
  dependencies = {
    "tpope/vim-dotenv",
    "nvim-telescope/telescope.nvim",
    "MunifTanjim/nui.nvim",
    "kevinhwang91/promise-async",
  },
  cmd = { "Laravel" },
  keys = {
    { "<leader>la", ":Laravel artisan<cr>" },
    { "<leader>lr", ":Laravel routes<cr>" },
    { "<leader>lm", ":Laravel related<cr>" },
  },
  event = { "VeryLazy" },
  opts = {},
  config = true,
}
```

> Tip: you can check the default options in the package, a powerful way of customizing and extending it is setting providers as Laravel does.

---

### Providers {#getting-started-providers}

One of the goals of the plugin is to be a good experience and extensible as laravel is as a php framework.

You can create your own provider as a lua file.
for example here is the main provider for the plugin: 
```lua
---@class LaravelProvider
local laravel_provider = {}

---@param app LaravelApp
function laravel_provider:register(app)
  app:bindIf("api", "laravel.api")
  app:bindIf("tinker", "laravel.tinker")
  app:bindIf("templates", "laravel.templates")

  -- SERVICES
  app:bindIf("artisan", "laravel.services.artisan")
  app:bindIf("class", "laravel.services.class")
  app:bindIf("composer", "laravel.services.composer")
  app:bindIf("php", "laravel.services.php")
  app:bindIf("runner", "laravel.services.runner")
  app:bindIf("ui_handler", "laravel.services.ui_handler")
  app:bindIf("view_finder", "laravel.services.view_finder")
  app:bindIf("views", "laravel.services.views")

  app:singeltonIf("cache", "laravel.services.cache")
  app:singeltonIf("env", "laravel.services.environment")
end

---@param app LaravelApp
function laravel_provider:boot(app)
  app("env"):boot()

  require("laravel.treesitter_queries")

  local group = vim.api.nvim_create_augroup("laravel", {})

  vim.api.nvim_create_autocmd({ "DirChanged" }, {
    group = group,
    callback = function()
      app("env"):boot()
    end,
  })
end

return laravel_provider
```

You only need to add them to the `user_providers` config and they will be loaded.

register as laravel it's a place where you can define elements for the container system, even you
can override current implementation given that the ones defined by the plugin are only conditional.

---

### App {#getting-started-app}

Inspire by Laravel the plugin has an `app` helper that allows you to quickly use it in keymaps, plugins, etc.
Having access and control of it at your disposal.

To access it just require laravel and take `app` property. it's the recomended way of using it.
```lua
local app = require("laravel").app

-- get all commands, print the total amount
app("commands_repository"):all():thenCall(function(commands)
  vim.print(#commands)
end)
```

### Promises {#getting-started-promises}

Something to note from the previous example is the approach that I took using promises.
This is due to the fact that the calls needed to be async
Promises allow for more strait-forward expression. more can be found [here](https://github.com/kevinhwang91/promise-async)

I know it takes some time to grasp, but it is a proven approach.
Examples of it can be found are all around the plugin code.
