---
category: Develop
---
# Plugin Settings

Plugins can define their own configuration options by using the Settings generator.

## Type of settings

 The Piwik platform differentiate between
"System Settings", "User Settings" and "Measurable Settings". "System Settings" add new sections to the
"General Settings" page, "User Settings" add new sections to the "Personal Settings" page and "Measurable Settings"


The Piwik platform differentiates between  and [UserSetting](/api-reference/Piwik/Settings/UserSetting).

**User settings** can be configured by any logged in user and each user can configure the setting independently.
The Piwik platform makes sure that settings are stored per user and that a user cannot see another users configuration.
A user will be able to change the settings on the "Personal Settings" page.

**System settings** applies to all of your users. It can be configured only by a user who has super user access.
By default, the value can be read only by a super user as well but often you want to have it readable by anyone or at
least by logged in users. If you set a setting readable the value will still be only displayed to super users but you
will always be able to access the value in the background. System Settings will appear on the "General Settings" page.

**Measurable Settings** add new fields when creating or editing a website or another measurable such as a mobile app.
The values for these settings can be changed by any user having admin access for a specific website and the settings
are saved along with each site. All fields shown in the websites manager are actually Measurable Settings and these
can be used to create whole new types such as "Mobile Apps", "Cars", "Embedded device", etc.

All these classes extend the [Settings](/api-reference/Piwik/Settings/Settings) class.

## Adding settings

### Creating a Settings class

Piwik can create the `Settings` class for you by using the [console](/guides/piwik-on-the-command-line):

```
$ ./console generate:settings
```

The command will ask you to enter the name of your plugin and ask you for the type of settings you want to create.
 Depending on the chosen type it will create a file named `UserSettings.php`, `SystemSettings.php` or
 `MeasurableSettings.php`, for example `plugins/MyPlugin/UserSettings.php`. This created file contains some examples to
 get you started. In the following example we create "System Settings". The creation of settings works the same across
 the different types.

To see the settings in action go to *Administration > General Settings* in your Piwik installation.

### Adding one or more settings

Settings are added in the `init()` method of the settings class. To do this, call the `addSetting()` and pass it a `UserSetting` or `SystemSetting` object.

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
and [FieldConfig](/api-reference/Piwik/Settings/FieldConfig) API reference.

See also the [ExampleSettingsPlugin](https://github.com/piwik/piwik/tree/master/plugins/ExampleSettingsPlugin) to see what else is possible.

### Field configuration

The field config let's you configure which form field should be shown to the user, which PHP value type you expect, etc.
You might be wondering why some properties are configured when making the setting and some properties in the callback method.
The reason for this is basically speed because we usually create all settings on each request. Everything that is configured
within the callback to configure the `FieldConfig $field` is actually only needed when the setting is going to be displayed
in the UI. All other times the field config is irrelevant and we save some time by not performing these actions. Especially since
some settings might perform API requests to get a list of available values etc.

## Reading settings values

You can access the value of a setting in a widget, in a controller, in a report or anywhere you want. To access the value create an instance of your settings class and get the value like this:

```php
$settings = new \Piwik\Plugins\MyPlugin\Settings();
$interval = $settings->refreshInterval->getValue()
```
