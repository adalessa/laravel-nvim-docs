---
title: User Command
description: User Commands
extends: _layouts.documentation
section: content
---

# User Command

The plugin offers a single command `Laravel`

This is the entry point of all actions

## Structure

The command is built around multiple pieces of logic divided in files in
`laravel.services.commands`.
This is not a hard rule and can be extended by just tagging the element
that you want to be a command.

for example the `routes` command is built like this:
```lua
---@type LaravelApp
local app = require('laravel').app

local routes = {}

function routes:new()
  local instance = {}
  setmetatable(instance, self)
  self.__index = self

  return instance
end

function routes:commands()
  return { "routes" }
end

function routes:handle()
  if app:has('routes_picker') then
    app('routes_picker'):run()
    return
  end
  vim.notify("No picker defined", vim.log.levels.ERROR)
end

function routes:complete()
  return {}
end

return routes
```

and the associated command like this:
```lua
app:bindIf("routes_command", "laravel.services.commands.routes", { tags = { "command" } })
```

The three methods `commands` `handle` and `complete` are require to operate fully.

The User command will forward the calls and parameters to each method as need.

## Composer
Command to interact with composer like `update`, `install`, `require`, `remove` are all possible

## Artisan
Interact with artisan commands, if none provider open it in the picker if available

## Routes
Opens the routes picker if available

## Make
Opens the picker of artisan commands only related to make.

## Related
Meant to be only use in models, will open a picker for the relations of the model.

## Commands
Commands picker, are defined in the options like:

```lua
{
    user_commands = {
      artisan = {
        ["db:fresh"] = {
          cmd = { "migrate:fresh", "--seed" },
          desc = "Re-creates the db and seed's it",
        },
      },
      npm = {
        build = {
          cmd = { "run", "build" },
          desc = "Builds the javascript assets",
        },
        dev = {
          cmd = { "run", "dev" },
          desc = "Builds the javascript assets",
        },
      },
      composer = {
        autoload = {
          cmd = { "dump-autoload" },
          desc = "Dumps the composer autoload",
        },
      },
    }
}
```
These are really useful to save common commands that you want to run quickly

## Resources
Open a picker with the common laravel directories like `Controllers`, `Migrations`, etc.
It can be customized in options like this:
```lua
{
    resources = {
        name = "path"
    }
}
```

## View Finder
Command to bind, that will look for views in the current file if only one  is found will jump into it,
When run in a view it will search for the usage to quickly switch from usage and implementation.

## Serve
To run the `php artisan serve`. Will spawn the process, which can be stopped with the `stop` sub command `:Laravel serve stop`

## Assets
To run the `npm run dev`. Will span the assets build process, which can be stopped with `stop` sub command `:Laravel assets stop`
