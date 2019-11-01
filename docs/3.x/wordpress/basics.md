---
category: Develop
title: Basics
next: wordpress/data-access
---
# Matomo for WordPress - Basics

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

[Learn more about user permissions](https://developer.matomo/guides/permissions)

## Generating links to Matomo app

Sometimes you might want to add links within WordPress that point to the Matomo standalone app within WordPress. For example,
you might want to show a link to view a heatmap for the currently viewed page. This way, a user will be only one click away to see
related information within Matomo.

### Generating a link to a reporting page

Example:

```php
\WpMatomo\Admin\Menu::make_matomo_reporting_link( $category = 'General_Visitors', $subcategory = 'General_Overview', $additional_url_params = array() );
// This will generate a link like this:
// https://example.com/wp-content/plugins/matomo/app/index.php?module=CoreHome&action=index&idSite=1&period=day&date=yesterday#?idSite=1&period=day&date=yesterday&category=General_Visitors&subcategory=General_Overview
// You can add additional url parameters if needed, for example array('idGoal' = 1)
```

The above example would send a user right to the Visitors => Overview reporting page.

### Generating a link to other pages

Example:

```php
\WpMatomo\Admin\Menu::make_matomo_action_link( $module = 'PrivacyManager', $action = 'privacySettings', $additional_url_params = array() );
// This will generate a link like this:
// https://example.com/wp-content/plugins/matomo/app/index.php?module=PrivacyManager&action=privacySettings&idSite=1&period=day&date=yesterday
// You can add additional url parameters if needed, for example array('idGoal' = 1)
```

This link will show a specific controller action that is defined in a Matomo plugin.