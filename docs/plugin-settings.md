---
category: Develop
previous: piwiks-ini-configuration
---
# Plugin Settings

Plugins can define their own configuration options by creating a class named **Settings** that extends [Piwik\Plugin\Settings](/api-reference/Piwik/Plugin/Settings).

Plugins that do this will cause new sections to appear in the *Settings > Plugins* admin page.

## Type of settings

The Piwik platform differentiates between [SystemSetting](/api-reference/Piwik/Settings/SystemSetting) and [UserSetting](/api-reference/Piwik/Settings/UserSetting).

**User settings** can be configured by any logged in user and each user can configure the setting independently. The Piwik platform makes sure that settings are stored per user and that a user cannot see another users configuration.

**System settings** applies to all of your users. It can be configured only by a user who has super user access. By default, the value can be read only by a super user as well but often you want to have it readable by anyone or at least by logged in users. If you set a setting readable the value will still be only displayed to super users but you will always be able to access the value in the background.

Imagine you are building a widget that fetches data from a third party system where you need to configure an API URL and token. While no regular user should see the value of both settings, the value should still be readable by any logged in user. Otherwise when logged in users cannot read the setting value then the data cannot be fetched in the background when this user wants to see the content of the widget. Solve this by making the setting readable by the current user:

```php
$setting->readableByCurrentUser = !Piwik::isUserIsAnonymous();
```

## Adding settings

### Creating a Settings class

Piwik can create the `Settings` class for you by using the [console](/guides/piwik-on-the-command-line):

```
$ ./console generate:settings
```

The command will ask you to enter the name of your plugin and will create a `plugins/MyPlugin/Settings.php` file. This file contains some examples to get you started.

To see the settings in action go to *Settings > Plugin settings* in your Piwik installation.

### Adding one or more settings

Settings are added in the `init()` method of the settings class. To do this, call the `addSetting()` and pass it a `UserSetting` or `SystemSetting` object.

For example:

```php
class Settings extends \Piwik\Plugin\Settings
{
    /** @var UserSetting */
    public $autoRefresh;

    /** @var UserSetting */
    public $refreshInterval;

    protected function init()
    {
        $this->setIntroduction('Here you can specify the settings for this plugin.');

        $this->createAutoRefreshSetting();
        $this->createRefreshIntervalSetting();
    }

    private function createAutoRefreshSetting()
    {
        $this->autoRefresh        = new UserSetting('autoRefresh', 'Auto refresh');
        $this->autoRefresh->type  = static::TYPE_BOOL;
        $this->autoRefresh->uiControlType = static::CONTROL_CHECKBOX;
        $this->autoRefresh->description   = 'If enabled, the value will be automatically refreshed depending on the specified interval';
        $this->autoRefresh->defaultValue  = false;

        $this->addSetting($this->autoRefresh);
    }

    private function createRefreshIntervalSetting()
    {
        $this->refreshInterval        = new UserSetting('refreshInterval', 'Refresh Interval');
        $this->refreshInterval->type  = static::TYPE_INT;
        $this->refreshInterval->uiControlType = static::CONTROL_TEXT;
        $this->refreshInterval->uiControlAttributes = array('size' => 3);
        $this->refreshInterval->description     = 'Defines how often the value should be updated';
        $this->refreshInterval->inlineHelp      = 'Enter a number which is >= 15';
        $this->refreshInterval->defaultValue    = '30';
        $this->refreshInterval->validate = function ($value, $setting) {
            if ($value < 15) {
                throw new \Exception('Value is invalid');
            }
        };

        $this->addSetting($this->refreshInterval);
    }
}
```

For a list of possible properties have a look at the [SystemSetting](/api-reference/Piwik/Settings/SystemSetting) and [UserSetting](/api-reference/Piwik/Settings/UserSetting) API reference.

See also the [ExampleSettingsPlugin](https://github.com/piwik/piwik/tree/master/plugins/ExampleSettingsPlugin) to see what else is possible.

## Reading settings values

You can access the value of a setting in a widget, in a controller, in a report or anywhere you want. To access the value create an instance of your settings class and get the value like this:

```php
$settings = new \Piwik\Plugins\MyPlugin\Settings();
$interval = $settings->refreshInterval->getValue()
```
