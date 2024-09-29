---
title: Repositories
description: Getting information
extends: _layouts.documentation
section: content
---

# Repositories {#repositories}

First of all this do not relate to the repository pattern in your application.
This is the approach that the plugin takes to group classes that read information
of your application.

- [Commands](/docs/repositories/commands)
- [Routes](/docs/repositories/routes)
- [Views](/docs/repositories/views)
- [Configs](/docs/repositories/configs)
- [Resources](/docs/repositories/resources)

Each of them have a `cache` decorated version.
This is recomended way to interact but not limited, since you may have the use
case where you don't want the cache.
