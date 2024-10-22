---
title: Route Info
description: Information where you need it
extends: _layouts.documentation
section: content
---

# Route Info {#route-info}

Working with in a controller it is normal to wonder what the url is, which parameters does it have,
what middleware is set for the route.

In order to achieve this the plugin uses `virtual_text` to display it.

![route_info_top](/assets/img/route_info_top.png)

This is the default style, but it can be changed to be on the right side by changing your config:

```lua
{
  features = {
    route_info = {
      enable = true,
      view = "right",
    },
  },
}
```

or you can disable it if you don't want it at all

If you are using a really wide monitor I recommend putting it on the right-hand side.

![route_info_right](/assets/img/route_info_right.png)

# Customization {#route-info-customization}

As we know customization is the sauce of neovim, you will for sure want to have different styles, different
colors.
The plugin will allow you to simply set what ever you prefer using the container system.

To modify it you change your configuration after laravel has been loaded or add a `user_provider` in the
configuration (recommended), but all the options are at your use.

```lua
local app = require("laravel").app

local route_info_view = {}

function route_info_view:get(route)
      return {
        virt_text = {
          { "[",                                                "comment" },
          { "Method: ",                                         "comment" },
          { table.concat(route.methods, "|"),                   "@enum" },
          { " Uri: ",                                           "comment" },
          { route.uri,                                          "@enum" },
          { "]",                                                "comment" },
        },
      }
end

app:instance("route_info_view", route_info_view)
```

After this code is executed the plugin will use this new definition of the route_info_view, no need to reboot,
this makes testing faster, as you just need to focus the buffer again to trigger the autocommand.
This verions looks like

![route_info_custom](/assets/img/route_info_custom.png)


The plugin gets this information from the artisan command `route:list --json` you can explore it to see what variables
are available.

# Missing Method {#route-info-missing-method}

A common situation is that you defined a route but it is not yet implemented, the plugin doesn't want you
to miss it or forget about it so it will use vim diagnostic to let you know about it.

![route_info_missing_route](/assets/img/route_info_missing_route.png)
