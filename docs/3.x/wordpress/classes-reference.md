---
category: API Reference
---
# WordPress Classes

This is the API Reference for developers who want to enrich the [Matomo for WordPress](/guides/wordpress/getting-started) plugin.

## `\WpMatomo\Bootstrap`

* `::doBootstap()` - Lets you bootstrap Matomo application within WordPress. Once Matomo is bootstrapped, you can access all [Matomo PHP API's](https://developer.matomo.org/api-reference/classes).

## `\WpMatomo\Site`

* `get_current_matomo_site_id()` - Retrieve the idSite for the currently active blog

## `\WpMatomo\User`

* `get_current_matomo_user_login()` - Get the user login name the current user has in Matomo. The user login is usually the same as in WordPress but may differ.

## `\WpMatomo\Capabilities`

* `const KEY_VIEW` - Check if user has view permissions in Matomo
* `const KEY_WRITE` - Check if user has at least write permissions in Matomo
* `const KEY_ADMIN` - Check if user has at least admin permissions in Matomo
* `const KEY_SUPERUSER` - Check if user has super user permissions in Matomo

Example:

```php
if (current_user_can(\WpMatomo\Capabilities::KEY_SUPERUSER) {
    // user has super user permission
}
```

## `\WpMatomo\API`

* `register_route ( $api_module, $api_method )` - Makes the given Matomo API method available through the WordPress Rest API

## `\WpMatomo\Settings`

* `is_network_enabled()` - Detect if MultiSite is enabled and Matomo is network enabled
* `get_global_option()` - Get a global configuration option. If Matomo is network enabled, then these options are not stored per blog but on network level and the same option applies to all blogs
* `get_option()` - Get a configuration option. These options are always stored per blog.
* `apply_changes( $settings )` - Update the given configuration options, eg `array('track_mode' => 'disabled')`.
* `apply_tracking_related_changes( $settings )` - Same as `apply_changes()` but regenerates the tracking code afterwards. Should be used if tracking related options are being changed.

## `\WpMatomo\Admin\Menu`

* `make_matomo_reporting_link( $category, $subcategory, $params = array() )` - Generate a URL to a specific report in the standalone Matomo reporting UI
* `make_matomo_action_link( $module, $action, $params = array() )` - Generate a URL to a specific controller action in the standalone Matomo UI


## Need additional APIs?

[Let us know by creating an issue on our issue tracker](https://github.com/matomo-org/wp-matomo/issues)