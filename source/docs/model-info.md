---
title: Model Info
description: Information where you need it
extends: _layouts.documentation
section: content
---

# Model Info {#model-info}

Given how Eloquent works you don't know which fields are available in the model.
you need to rely on your memory or checking migration, or opening the table.
To solve this issue the plugin uses `virtual_text` to show this information on it.

![model_info](/assets/img/model_info.png)

# Configuration {#model-info-configuration}

You can disable if you don't want this by changing the configuration
```lua
{
  features = {
    model_info = {
      enable = true,
    },
  },
}
```

# Customization {#model-info-customization}

To customize how is display use the container approach

```lua
local app = require("laravel").app

local model_info_view = {}

function model_info_view:get(model)
  local virt_lines = {
    { { "[", "comment" } },
    { { " Database: ", "comment" },  { model.database, "@enum" } },
    { { " Table: ", "comment" },     { model.table, "@enum" } },
    { { " Attributes: ", "comment" } },
  }

  for _, attribute in ipairs(model.attributes) do
    table.insert(virt_lines, {
      { "   " .. attribute.name,                                                     "@enum" },
      { " " .. (attribute.type or "null") .. (attribute.nullable and "|null" or ""), "comment" },
      attribute.cast and { " -> " .. attribute.cast, "@enum" } or nil,
    })
  end

  table.insert(virt_lines, { { "]", "comment" } })

  return {
    virt_lines = virt_lines,
    virt_lines_above = true,
  }
end

app:instance("model_info_view", model_info_view)
```

The plugin gets this information from the artisan command `model:show --json` you can explore it to see what variables
are available.
