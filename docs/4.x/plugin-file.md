---
category: Develop
---
# Plugin file

Each plugin can have a special file named `$PluginName.php` where you need to replace `$PluginName` with the name of your plugin. For example, if the name of your plugin is `CustomAlerts`, then this file would be `plugins/CustomAlerts/CustomAlerts.php`. Any such plugin class needs to extend `Piwik\Plugin`.

```php
namespace Piwik\Plugins\CustomAlerts;

class CustomAlerts extends \Piwik\Plugin
{
}
```

Such a file doesn't need to exist in a plugin but most plugins do have such a file because they are listening to [events](/guides/events).

## Plugin hooks

There are special methods that can be overwritten in each plugin class. 

For detailed information about below hooks and all the available plugin methods have a look at the [Plugin API reference](/api-reference/Piwik/Plugin).

```php
// Allows you to listen to Matomo events.
public function registerEvents(): array;

// Defines whether the whole plugin requires a working internet connection. If set to true, the plugin will be automatically unloaded if `enable_internet_features` is 0, even if the plugin is activated.
public function requiresInternetConnection(): bool;

// Override this method in your plugin class if you want your plugin to be loaded during tracking. If you define your own dimension or listen to a tracking event, your plugin will be detected as a tracker plugin automatically.
public function isTrackerPlugin(): bool;

// Executed when the plugin is being installed. Useful to create or update DB tables or to set configurations.
public function install();

// Executed every time the plugin is activated.
public function activate();

// Executed on every request after a plugin was loaded.
public function postLoad();

// Executed every time the plugin is deactivated.
public function deactivate();

// Executed when the plugin is being uninstalled. Useful to undo everything that was done in the install hook like removing a DB table.
public function uninstall();
```

If your plugin needs to change the database schema then you might also find our [extending the database guide](/guides/extending-database) useful.
