---
category: Develop
title: Basics
next: wordpress/data-access
---
# Matomo for WordPress - Basics

Looking for some plugin examples? [Check out our Matomo for WordPress examples repository.](https://github.com/matomo-org/matomo-wordpress-plugin-examples)

## Checking if Matomo plugin is enabled

It is recommended to check if Matomo for WordPress plugin is actually installed and activated before accessing any of our
WordPerss PHP APIs to prevent fatal errors:

```php
if ( is_plugin_active('matomo/matomo.php') ) {
    // access one of our APIs
}
```

## Checking for permissions

You can use WordPress capabilities to check if a user has a certain Matomo capability within WordPress:

```php
if (current_user_can('superuser_matomo') {
    // user has super user permission
}
current_user_can('admin_matomo');
current_user_can('write_matomo');
current_user_can('view_matomo');
```

Capabilities are inherited. This means a super user automatically also has admin, write and view permission.

[Learn more about user permissions](https://developer.matomo.org/guides/permissions)

## Generating links to Matomo app

Sometimes you might want to show links that point to the Matomo standalone app within WordPress. For example,
you might want to show a link to view a heatmap for the currently viewed page. This way, a user will be only one click away to see
related information within Matomo.

### Generating a link to a reporting page

Example:

```php
\WpMatomo\Admin\Menu::get_matomo_reporting_url( $category = 'General_Visitors', $subcategory = 'General_Overview', $additional_url_params = array() );
// This will generate a link like this:
// https://example.com/wp-content/plugins/matomo/app/index.php?module=CoreHome&action=index&idSite=1&period=day&date=yesterday#?idSite=1&period=day&date=yesterday&category=General_Visitors&subcategory=General_Overview
// You can add additional url parameters if needed, for example array('idGoal' = 1)
```

The above example would send a user right to the Visitors => Overview reporting page.

### Generating a link to other pages

Example:

```php
\WpMatomo\Admin\Menu::get_matomo_action_url( $module = 'PrivacyManager', $action = 'privacySettings', $additional_url_params = array() );
// This will generate a link like this:
// https://example.com/wp-content/plugins/matomo/app/index.php?module=PrivacyManager&action=privacySettings&idSite=1&period=day&date=yesterday
// You can add additional url parameters if needed, for example array('idGoal' = 1)
```

This link will show a specific controller action that is defined in a Matomo plugin.
