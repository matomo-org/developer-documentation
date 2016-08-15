<small>Piwik\Settings\Measurable\</small>

MeasurableSettings
==================

Base class of all measurable settings providers.

Plugins that define their own configuration settings
can extend this class to easily make their measurable settings available to Piwik users.

Descendants of this class should implement the init() method and call the
makeSetting() method for each of the measurable's settings.

For an example, see the Piwik\Plugins\ExampleSettingsPlugin\MeasurableSettings plugin.

$settingsProvider   = new Piwik\Plugin\SettingsProvider(); // get this instance via dependency injection
$measurableSettings = $settingProvider->getMeasurableSettings($yourPluginName, $idsite, $idType = null);
$measurableSettings->yourSetting->getValue();

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

-  It accepts the following parameter(s):
    - `$idSite` (`int`) &mdash;
       If creating settings for a new site that is not created yet, use idSite = 0
    - `$idMeasurableType` (`string`|`null`) &mdash;
       If null, idType will be detected from idSite

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

