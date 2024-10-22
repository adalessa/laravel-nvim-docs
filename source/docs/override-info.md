---
title: Override Info
description: Information where you need it
extends: _layouts.documentation
section: content
---

# Override Info {#override-info}

This was requested by the community, a user wanted to have information when a method in a class
was being overridden by the class.

![override](/assets/img/override_info.png)

Of course you can customize the sign, this is using the native neovim one so it's easier.

```lua
vim.fn.sign_define("LaravelOverride", { text = "@", texthl = "String" })

```

Change the text and the highlight to match your theme and style.

# Configuration {#override-info-configuration}

You can disable this if you don't want it by changing the configuration:
```lua
{
  features = {
    override = {
      enable = true,
    },
  },
}
```
