---
category: Develop
title: Best Practices
next: wordpress/data-access
---
# Matomo for WordPress - Best practices

## Checking if Matomo plugin is enabled

Before accessing any of our APIs it is recommended you check if Matomo for WordPress plugin is actually installed and
activated:

```php
if ( is_plugin_active('matomo/matomo.php') ) {
    // enrich the plugin
}
```

## Checking for permissions

You can use WordPress capabilities to check if a user has a certain capability:

```php
if (current_user_can(\WpMatomo\Capabilities::KEY_SUPERUSER) {
    // user has super user permission
}
current_user_can(\WpMatomo\Capabilities::KEY_ADMIN);
current_user_can(\WpMatomo\Capabilities::KEY_WRITE);
current_user_can(\WpMatomo\Capabilities::KEY_VIEW);
```

Capabilities are inherited meaning a super user will automatically have view permission. And an admin will also have write and view permission.
