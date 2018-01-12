---
category: Develop
---
# Plugin Settings

## Type of settings

The Piwik platform differentiate between "System Settings", "User Settings" and "Measurable Settings":

**User Settings** can be configured by any logged in user and each user can configure the setting independently.
The Piwik platform makes sure that settings are stored per user and that a user cannot see another user's configuration.
A user will be able to change the settings on the "Personal Settings" page.

**System Settings** applies to all of your users. It can be configured only by a user who has super user access.
System Settings will appear on the "General Settings" page.

**Measurable Settings** add new fields when creating or editing a website or another measurable such as a mobile app.
The values for these settings can be changed by any user having admin access for a specific website and the settings
are saved separately for each site. All fields shown in the websites manager are actually Measurable Settings and these
can be used to create whole new types such as "Mobile Apps", "Cars", "Embedded device", etc.

All these classes extend the [Settings](/api-reference/Piwik/Settings/Settings) class.

## Adding settings

### Creating a Settings class

Piwik can create the `Settings` class for you by using the [console](/guides/piwik-on-the-command-line):

```
$ ./console generate:settings
```

The command will ask you to enter the name of your plugin and for the type of settings you want to create.
 Depending on the chosen type it will create a file named `UserSettings.php`, `SystemSettings.php` or
 `MeasurableSettings.php`, for example `plugins/MyPlugin/SystemSettings.php`. This created file contains some examples to
 get you started. The creation and definition of settings works the same across the different types.

To see the settings in action go to *Administration > General Settings* in your Piwik installation.

### Adding one or more settings

Settings are added in the `init()` method of the settings class. To do this, call the `makeSetting()` and pass in the
internal name of the setting, the default value, which PHP type the setting should return and a callback to configure
the UI representation of the form field.

For example:

```php
class SystemSettings extends \Piwik\Settings\Plugin\SystemSettings
{
    /** @var Setting */
    public $autoRefresh;

    /** @var Setting */
    public $refreshInterval;

    protected function init()
    {
        $this->autoRefresh = $this->createAutoRefreshSetting();
        $this->refreshInterval = $this->createRefreshIntervalSetting();
    }

    private function createAutoRefreshSetting()
    {
        return $this->makeSetting('autoRefresh', $default = false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
            $field->title = 'Auto refresh';
            $field->uiControl = FieldConfig::UI_CONTROL_CHECKBOX;
            $field->description = 'If enabled, the value will be automatically refreshed depending on the specified interval';
        });
    }

    private function createRefreshIntervalSetting()
    {
        return $this->makeSetting('refreshInterval', $default = '3', FieldConfig::TYPE_INT, function (FieldConfig $field) {
            $field->title = 'Refresh Interval';
            $field->uiControl = FieldConfig::UI_CONTROL_TEXT;
            $field->uiControlAttributes = array('size' => 3);
            $field->inlineHelp = 'Enter a number which is >= 15';
            $field->introduction = 'New group of settings';
            $field->description = 'Defines how often the value should be updated';
            $field->validate = function ($value, $setting) {
                if ($value < 15) {
                    throw new \Exception('Value is invalid');
                }
            };
        });
    }
}
```

For a list of possible properties for each setting have a look at the [Setting](/api-reference/Piwik/Settings/Setting)
and [FieldConfig](/api-reference/Piwik/Settings/FieldConfig) API reference. See also the
[ExampleSettingsPlugin](https://github.com/matomo-org/matomo/tree/master/plugins/ExampleSettingsPlugin) to see what else is possible.

### Field configuration

You might be wondering why some properties are configured as parameters when making the setting and some properties in
the callback method. The reason for this is performance because we usually create all settings on each request.
Everything that is configured within the callback to configure the `FieldConfig $field` is only needed when the setting
is going to be displayed in the UI. All other times the field config is irrelevant, and we save time by not executing
these actions. Especially since some settings might perform API requests to get a list of available values etc. within
 this callback.

### Configuring the value for a system setting in the config file

System settings cannot be only configured via the UI but also via the `config/config.ini.php` file. For example for
the plugin `MyPlugin` it is possible to configure the value for a setting `refreshInterval` like this:

```ini
[MyPlugin]
refreshInterval = 15
```

As soon as a value in the config file is configured, it won't be possible to change the value for that setting anymore
in the UI and the setting will not be even displayed.

### Limiting who can configure a setting in the UI

For example a system setting can be only configured by a user with super user access by default. However, you can
customize this behaviour by using the `setIsWritableByCurrentUser` method. For example, you can define to let only a user
named "MyRootUser" change the setting. All other users would not be able to see the value for that setting and neither
would they be able to change it.

```php
$this->autoRefresh = $this->createAutoRefreshSetting();
$login = \Piwik\Piwik::getCurrentUserLogin();
$this->autoRefresh->setIsWritableByCurrentUser($login == 'MyRootUser');
```

### Removing a setting from the UI

Sometimes you might want to create a setting but not have it visible in the UI at all. This is for example useful if you
make the visibility of a setting dependent on another setting or you only want users to configure it via the
`config/config.ini.php`. To make sure a setting cannot be changed via the UI call `setIsWritableByCurrentUser(false)`.

```php
$this->autoRefresh = $this->createAutoRefreshSetting();
$login = \Piwik\Piwik::getCurrentUserLogin();
$this->autoRefresh->setIsWritableByCurrentUser(false);
```

### Showing or hiding a setting in the UI dynamically

Sometimes you might have a bit more complicated form where a setting should be only visible when another setting
is configured in a certain way. Piwik can show or hide settings dynamically without reloading based on a certain
condition. Say we wanted to have the setting `refreshInterval` only visible if `autoRefresh` is enabled, then
we can do this as follows:

```php
$this->makeSetting('refreshInterval', $default = '3', FieldConfig::TYPE_INT, function (FieldConfig $field) {
    $field->condition = 'autoRefresh';
    // instead it was also possible to write eg 'autoRefresh == 1' or 'autoRefresh == true'
    // multiple conditions can be combined such as 'autoRefresh == 1 && anotherSetting == "foobar"'
});
```

## Reading settings values

You can access the value of a setting in a widget, in a controller, in a report or anywhere you want. To access the value create an instance of your settings class and get the value like this:

```php
$settings = new \Piwik\Plugins\MyPlugin\Settings();
$interval = $settings->refreshInterval->getValue()
```
