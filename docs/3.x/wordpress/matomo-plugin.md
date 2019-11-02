---
category: Develop
title: Matomo Plugin
---
# Matomo Plugin within WordPress


## When you already have a Matomo plugin

* If you have built a Matomo plugin, and it is available on our Matomo Marketplace, and you don't want to make any special adjustments for WordPress, then your plugin will be automatically compatible with WordPress and it will work on a regular Matomo On-Premise installation as well as on WordPress.
* If you have already built a Matomo plugin and you want to integrate your plugin better with WordPress,
* or when your WordPress' plugin sole purpose is to integrate Matomo, then you can define a Matomo plugin as below.

If you have not yet already built a Matomo plugin, [start creating a regular Matomo plugin](/guides/getting-started-part-1).

To hook into WordPress within your Matomo plugin, you need to add below code at the beginning of your plugin file. Say your Matomo plugin is named `ClassicCounter`, then you add this code to the beginning of `ClassicCounter.php`:

```php
<?php
/**
 * Plugin Name: Classic Counter
 * Description: This plugin lets you do something
 * Author: My Name
 * Author URI: https://www.example.com
 * Version: 1.0.0
 */

if (defined( 'ABSPATH') && function_exists('add_action')) {
    $path = '/matomo/app/core/Plugin.php';
    if (defined('WP_PLUGIN_DIR') && WP_PLUGIN_DIR && file_exists(WP_PLUGIN_DIR . $path)) {
        require_once WP_PLUGIN_DIR . $path;
    } elseif (defined('WPMU_PLUGIN_DIR') && WPMU_PLUGIN_DIR && file_exists(WPMU_PLUGIN_DIR . $path)) {
        require_once WPMU_PLUGIN_DIR . $path;
    } else {
    	return; // do nothing if Matomo for WordPress is not installed
    }
    add_action('plugins_loaded', function () {
        $is_matomo_activated = function_exists('add_matomo_plugin');
        if ($is_matomo_activated) {
            add_matomo_plugin(__DIR__, __FILE__);
        }
    });
}
```

You can now simply copy your Matomo plugin within the `wp-content/plugins` folder of your WordPress and use it.

[View a plugin Example](https://github.com/matomo-org/matomo-wordpress-plugin-examples/tree/master/MatomoPluginAddingWordpressSupport)

### Example 1
Now you can for example add below code to hook into WordPress and it will only be executed if the plugin runs within WordPress.

```php
if (defined( 'ABSPATH') && function_exists('add_action')) {
    // the Matomo plugin is used within wordpress...
    apply_filters('post_row_actions', function ($actions, $post) {
        $actions['link_to_my_plugin'] = '<a target="_blank" href="'.\WpMatomo\Admin\Menu::make_matomo_action_link('MyPlugin', 'index').'">View My Matomo Plugin</a>';
        return $actions;
    }, 10, 2);
}
```

### Example 2
Say you are creating a plugin which lets you embed an image to view the number of visitors on your page. Then you could for example offer WordPress users a shortcode to embed the visitor counter image easily into their website using a shortcode:

```php
if (defined( 'ABSPATH') && function_exists('add_action')) {
    add_shortcode( 'matomo_visitor_counter_image', function () {
        return \WpMatomo\Admin\Menu::make_matomo_action_link('MyPlugin', 'index');
    } );
}
```

## Adding a Matomo plugin to a WordPress plugin

If you want to add, customise, or remove behaviour within Matomo, you may want to create a Matomo plugin within your WordPress plugin.

You can do this by editing your WordPress plugin file. If the name of your WordPress plugin is `matomo_custom_exclude_visits`,
then you need to add below code to the `matomo_custom_exclude_visits.php` file.

```php
$path = '/matomo/app/core/Plugin.php';
$is_matomo_installed = false;
if (defined('WP_PLUGIN_DIR') && WP_PLUGIN_DIR && file_exists(WP_PLUGIN_DIR . $path)) {
    require_once WP_PLUGIN_DIR . $path;
    $is_matomo_installed = true;
} elseif (defined('WPMU_PLUGIN_DIR') && WPMU_PLUGIN_DIR && file_exists(WPMU_PLUGIN_DIR . $path)) {
    require_once WPMU_PLUGIN_DIR . $path;
    $is_matomo_installed = true;
}

if ($is_matomo_installed) {

    add_action('plugins_loaded', function () {
        $is_matomo_activated = function_exists('add_matomo_plugin');
        if ($is_matomo_activated) {
            add_matomo_plugin(__DIR__, __FILE__);
        }
    });

    class matomo_custom_exclude_visits extends \Piwik\Plugin
    {

        /**
         * @see \Piwik\Plugin::registerEvents
         */
        public function registerEvents()
        {
            return array(
                'Tracker.isExcludedVisit' => 'is_excluded_visit',
            );
        }

        public function is_excluded_visit (&$excluded, $tracking_request) {
            if ($tracking_request.getParam('foobar') == 1) {
                $excluded = true; // exclude visits when foobar tracking parameter is present
            }
        }
    }
}
```

You will also need to define a file named `plugin.json` in your WordPress plugin folder. This file lets Matomo know that
it should load your plugin within Matomo.

```json
{
    "name": "matomo_custom_exclude_visits",
    "description": "Exclude specific visits from being tracked",
    "require": {}
}
```

[See the documentation for all available configuration options](/guides/distributing-your-plugin#pluginjson-file)

