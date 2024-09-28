---
title: Getting Started
description: Getting started with Laravel NVIM
extends: _layouts.documentation
section: content
---

# Getting Started {#getting-started}

The goal of the plugin is to offer solution out of the box, just install set your keymaps and start using it.

## Install {#getting-started-install}

You need to just add it to you plugin manager

### Lazy nvim
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

> Tip: you can check the default options in the package, a powerfull way of customize and extend is setting providers as laravel does it.

---

### Providers {#getting-started-providers}

One of the goals of the plugin is to be a good experience and extensible as laravel is as php framework.

You can create your provider as a lua file.
for example the the main in the plugin but not the only one.
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
Having access and control at your disposal.

To acess just use just require laravel and take `app` property. it's the recomended way of use it.
```lua
local app = require("laravel").app

-- get all commands, print the total amount
app("commands_repository"):all():thenCall(function(commands)
  vim.print(#commands)
end)
```

### Promises {#getting-started-promises}

Something to notice from the previous example is the approach that I took was to use promises.
This is due that the calls need to be async, and after having for a lot of time callbacks that
was more paintfull.
Promises allow to more strait forward expression. more can be found [here](https://github.com/kevinhwang91/promise-async)

I know it takes some time to grasp of it, but it a proven approach.
Examples of it can be found all around the plugin code.
