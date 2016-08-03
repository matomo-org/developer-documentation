<small>Piwik\Settings\Plugin\</small>

UserSettings
============

Base class of all plugin settings providers.

Plugins that define their own configuration settings
can extend this class to easily make their settings available to Piwik users.

Descendants of this class should implement the init() method and call the
addSetting() method for each of the plugin's settings.

For an example, see Piwik\Plugins\ExampleSettingsPlugin\UserSettings.

$userSettings = new Piwik\Plugins\ExampleSettingsPlugin\UserSettings(); // get instance via dependency injection
$userSettings->yourSetting->getValue();

Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct)
- [`getSetting()`](#getsetting) Inherited from [`Settings`](../../../Piwik/Settings/Settings.md)
- [`getSettingsWritableByCurrentUser()`](#getsettingswritablebycurrentuser) &mdash; Returns the settings that can be displayed for the current user. Inherited from [`Settings`](../../../Piwik/Settings/Settings.md)
- [`save()`](#save) &mdash; Saves (persists) the current setting values in the database.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature


<a name="getsetting" id="getsetting"></a>
<a name="getSetting" id="getSetting"></a>
### `getSetting()`

#### Signature

-  It accepts the following parameter(s):
    - `$name`
      
- It does not return anything.

<a name="getsettingswritablebycurrentuser" id="getsettingswritablebycurrentuser"></a>
<a name="getSettingsWritableByCurrentUser" id="getSettingsWritableByCurrentUser"></a>
### `getSettingsWritableByCurrentUser()`

Returns the settings that can be displayed for the current user.

#### Signature

- It returns a [`Setting[]`](../../../Piwik/Settings/Setting.md) value.

<a name="save" id="save"></a>
<a name="save" id="save"></a>
### `save()`

Saves (persists) the current setting values in the database.

#### Signature

- It does not return anything.

