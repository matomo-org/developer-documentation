---
category: Develop
previous: piwiks-ini-configuration
---
# Plugin Settings

Plugins can define their own configuration options by creating a class named **Settings** that extends [Piwik\Plugin\Settings](/api-reference/Piwik/Plugin/Settings). The subclass should implement the `Settings::init()` method adding settings that can be set by the user.

Plugins that do this will cause new sections to appear in the *Settings > Plugins* admin page.

## Example

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

<!-- TODO: image of result of above code -->

*See the [ExampleSettingsPlugin](https://github.com/piwik/piwik/tree/master/plugins/ExampleSettingsPlugin) to see what else is possible.*
