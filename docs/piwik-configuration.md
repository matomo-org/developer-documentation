# Piwik Configuration

<!-- Meta (to be deleted)
Purpose: describe INI configuration system, describe plugin settings stuff, describe use of options table (discourage use)

Audience: developers that want to know how to add configuration to their own plugins

Expected Result: 

Notes: 

What's missing? (stuff in my list that was not in when I wrote the 1st draft)
-->

## About this guide

**Read this guide if**

* you'd like to know **how your plugin can define its own configuration settings**
* you'd like to know **how the INI configuration system works**

**Guide assumptions**

This guide assumes that you:

* can code in PHP,
* and have a general understanding of extending Piwik (if not, read our [Getting Started](#) guide).

## Piwik Configuration

Piwik uses to mtehods to store configuration settings, the INI files in the **config** folder and **Options** which are persisted to the database. These methods are used by **Piwik Core** and should not be used by plugins. Plugins use a separate method of configuration [described below](#plugin-configuration).

### The INI files

INI configuration options are stored in both the **config/config.ini.php** and **config/global.ini.php** files. The **global.ini.php** file contains the default values for configuration options. If an option does not exist in **config.ini.php** the value in **global.ini.php** is used.

Plugins and other code can access and modify INI config options using the [Piwik\Config](#) class.

_To learn more about individual configuration options, read the documentation in [global.ini.php](#https://github.com/piwik/piwik/blob/master/config/global.ini.php)._

### Options

Some Piwik configuration settings are stored as **Options**. **Options** are just key value pairs that are persisted in the database. To learn more about options, read the docs for the [Option](#) class.

TODO: this helps people w/ distributed setups correct? need to find out how

_To learn about how options are persisted in the MySQL backend Piwik uses, read our [Persistence & the MySQL Backend](#) guide.

<a name="plugin-configuration"></a>
## Plugin Configuration

Plugins can define their own configuration options by creating a class named **Settings** that extends [Piwik\Plugin\Settings](#). The subclass should implement the [Settings::init](#) method adding settings that can be set by the user. For example,

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

Plugins that do this will cause new sections to appear in the _Settings > Plugins_ admin page:

TODO: image of result of above code

TODO: how do you access plugin settings?

_See the [ExampleSettingsPlugin](#) to see what other things can be done._