---
title: Route Info
description: Information where you need it
extends: _layouts.documentation
section: content
---

# Route Info {#route-info}

Working with in the controller is normal to wonder how the url was, which parameter did it have,
what middleware are set for this route.

In order to achieve this the plugin uses `virtual_text` to display it.

![route_info_top](/assets/img/route_info_top.png)

This is the default style, but it can be chant to be on the right by config

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

or it can be disable if you don't want it at all

If you are using a really wide monitor and want to put it into use the right option is for you

![route_info_right](/assets/img/route_info_right.png)

# Customization {#route-info-customization}

As we know customization is the sauce of neovim, you will like for sure different styles, different
colors and the plugin will not be able to just have a different one for each user,
but the plugin will allow you to simple set what ever you like using the container system.

To modified you can do it in your configuration after laravel has been loaded or as a `user_provider` in the
configuration which is the intended way, but all the options are at your use.

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

after this code is executed the plugin will use this new definition of the route_info_view, no need to reboot,
this makes it testing it faster, you just need to focus the buffer again to trigger the autocommand.
This verions looks like

![route_info_custom](/assets/img/route_info_custom.png)

# Missing Method {#route-info-missing-method}

A common situation is that you defined a route but not implemented, the plugin doesn't want you
to miss it or forget about it so it will use vim diagnostic to let you know about it

![route_info_missing_route](/assets/img/route_info_missing_route.png)
