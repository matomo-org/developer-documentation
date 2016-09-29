<small>Piwik\Plugin\</small>

Settings
========

Base class of all plugin settings providers.

Plugins that define their own configuration settings
can extend this class to easily make their settings available to Piwik users.

Descendants of this class should implement the init() method and call the
addSetting() method for each of the plugin's settings.

For an example, see the Piwik\Plugins\ExampleSettingsPlugin\ExampleSettingsPlugin plugin.

Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getIntroduction()`](#getintroduction) &mdash; Returns the introduction text for this plugin's settings.
- [`getSettingsForCurrentUser()`](#getsettingsforcurrentuser) &mdash; Returns the settings that can be displayed for the current user.
- [`getSettings()`](#getsettings) &mdash; Returns all available settings.
- [`save()`](#save) &mdash; Saves (persists) the current setting values in the database.
- [`removeAllPluginSettings()`](#removeallpluginsettings) &mdash; Removes all settings for this plugin from the database.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$pluginName`
      

<a name="getintroduction" id="getintroduction"></a>
<a name="getIntroduction" id="getIntroduction"></a>
### `getIntroduction()`

Returns the introduction text for this plugin's settings.

#### Signature

- It returns a `string` value.

<a name="getsettingsforcurrentuser" id="getsettingsforcurrentuser"></a>
<a name="getSettingsForCurrentUser" id="getSettingsForCurrentUser"></a>
### `getSettingsForCurrentUser()`

Returns the settings that can be displayed for the current user.

#### Signature

- It returns a [`Setting[]`](../../Piwik/Settings/Setting.md) value.

<a name="getsettings" id="getsettings"></a>
<a name="getSettings" id="getSettings"></a>
### `getSettings()`

Returns all available settings.

This will include settings that are not available
to the current user (such as settings available only to the Super User).

#### Signature

- It returns a [`Setting[]`](../../Piwik/Settings/Setting.md) value.

<a name="save" id="save"></a>
<a name="save" id="save"></a>
### `save()`

Saves (persists) the current setting values in the database.

#### Signature

- It does not return anything.

<a name="removeallpluginsettings" id="removeallpluginsettings"></a>
<a name="removeAllPluginSettings" id="removeAllPluginSettings"></a>
### `removeAllPluginSettings()`

Removes all settings for this plugin from the database.

Useful when uninstalling
a plugin.

#### Signature

- It does not return anything.

