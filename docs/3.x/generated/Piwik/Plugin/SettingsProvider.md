<small>Piwik\Plugin\</small>

SettingsProvider
================

Base class of all plugin settings providers.

Plugins that define their own configuration settings
can extend this class to easily make their settings available to Piwik users.

Descendants of this class should implement the init() method and call the
addSetting() method for each of the plugin's settings.

For an example, see the Piwik\Plugins\ExampleSettingsPlugin\ExampleSettingsPlugin plugin.
