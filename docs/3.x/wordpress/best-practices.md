---
category: Develop
title: Best Practices
next: wordpress/data-access
---
# Matomo for WordPress - Best practices

## Checking if Matomo plugin is enabled

Before accessing any of our WordPerss PHP APIs it is recommended you check if Matomo for WordPress plugin is actually
installed and activated to prevent fatal errors:

```php
if ( is_plugin_active('matomo/matomo.php') ) {
    // enrich the plugin
}
```

## Checking for permissions

You can use WordPress capabilities to check if a user has a certain capability within WordPress:

```php
if (current_user_can('superuser_matomo') {
    // user has super user permission
}
current_user_can('admin_matomo');
current_user_can('write_matomo');
current_user_can('view_matomo');
```

Capabilities are inherited meaning a super user will automatically have view permission and an admin will also have write and view permission.

[Learn more about user permissions](https://developer.matomo/guides/permissions);