---
category: DevelopInDepth
---

# Marketplace HTTP API

## Endpoint:

https://plugins.matomo.org/api/

## Versions

* Version 1: Initial version
* Version 2: Also returns paid plugins and / or hidden plugins (when authenticated via access token)

To set a version for an API call define the respecting verion right after the endpoint. For example:

* https://plugins.matomo.org/api/1.0
* https://plugins.matomo.org/api/2.0

## Authentication

To authenticate send an `access_token` parameter via POST (providing `access_token` using a GET query parameter does not work). Eg

*  curl --data "access_token=123456789..." https://plugins.matomo.org/api/2.0/plugins

This is only needed for accessing purchased premium features.

## Methods

### From Version 1
* https://plugins.matomo.org/api/1.0/plugins
* https://plugins.matomo.org/api/1.0/themes
* https://plugins.matomo.org/api/1.0/plugins/checkUpdates
* https://plugins.matomo.org/api/1.0/plugins/:pluginname/info
* https://plugins.matomo.org/api/1.0/plugins/:pluginname/download/:pluginversion
* https://plugins.matomo.org/api/1.0/plugins/:pluginname/download/:pluginversion
* https://plugins.matomo.org/api/1.0/(developer|artist)/:owner

### From Version 2
* https://plugins.matomo.org/api/2.0/consumer (requires authentication)
