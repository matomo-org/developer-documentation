<small>Piwik\Plugin\</small>

SettingsProvider
================

Base class of all plugin settings providers.

Descendants of this class should implement the init() method and call the
addSetting() method for each of the plugin's settings.

For an example, see the Piwik\Plugins\ExampleSettingsPlugin\ExampleSettingsPlugin plugin.

Methods
-------

The class defines the following methods:

- [`getMeasurableSettings()`](#getmeasurablesettings)
- [`getAllMeasurableSettings()`](#getallmeasurablesettings)

<a name="getmeasurablesettings" id="getmeasurablesettings"></a>
<a name="getMeasurableSettings" id="getMeasurableSettings"></a>
### `getMeasurableSettings()`

#### Signature

-  It accepts the following parameter(s):
    - `$pluginName` (`string`) &mdash;
       The name of a plugin.
    - `$idSite` (`int`) &mdash;
       The ID of a site. If a site is about to be created pass idSite = 0.
    - `$idType` (`string`|`null`) &mdash;
       If null, idType will be detected automatically if the site already exists. Only needed to set a value when idSite = 0 (this is the case when a site is about) to be created.

- *Returns:*  `Piwik\Plugin\MeasurableSettings`|`null` &mdash;
    Returns null if no MeasurableSettings implemented by this plugin or when plugin
                                 is not loaded and activated. Returns an instance of the settings otherwise.

<a name="getallmeasurablesettings" id="getallmeasurablesettings"></a>
<a name="getAllMeasurableSettings" id="getAllMeasurableSettings"></a>
### `getAllMeasurableSettings()`

#### Signature

-  It accepts the following parameter(s):
    - `$idSite` (`int`) &mdash;
       The ID of a site. If a site is about to be created pass idSite = 0.
    - `$idMeasurableType` (`string`|`null`) &mdash;
       If null, idType will be detected automatically if the site already exists. Only needed to set a value when idSite = 0 (this is the case when a site is about) to be created.
- It returns a `Piwik\Plugin\MeasurableSettings` value.

