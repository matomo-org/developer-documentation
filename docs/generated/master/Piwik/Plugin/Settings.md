<small>Piwik\Plugin</small>

Settings
========

Base class of all Settings providers.

Description
-----------

Plugins that define their own settings can extend
this class to easily make their settings available to Piwik users.

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
- [`getSettingValue()`](#getsettingvalue) &mdash; Returns the current value for a setting.
- [`setSettingValue()`](#setsettingvalue) &mdash; Sets (overwrites) the value of a setting in memory.
- [`removeSettingValue()`](#removesettingvalue) &mdash; Unsets a setting value in memory.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$pluginName` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The name of the plugin these settings are for.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

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

#### Description

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

#### Description

Useful when uninstalling
a plugin.

#### Signature

- It does not return anything.

<a name="getsettingvalue" id="getsettingvalue"></a>
<a name="getSettingValue" id="getSettingValue"></a>
### `getSettingValue()`

Returns the current value for a setting.

#### Description

If no value is stored, the default value
is be returned.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$setting` ([`Setting`](../../Piwik/Settings/Setting.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `mixed` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the setting does not exist or if the current user is not allowed to change the value of this setting.

<a name="setsettingvalue" id="setsettingvalue"></a>
<a name="setSettingValue" id="setSettingValue"></a>
### `setSettingValue()`

Sets (overwrites) the value of a setting in memory.

#### Description

To persist the change, [save()](/api-reference/Piwik/Plugin/Settings#save) must be
called afterwards, otherwise the change has no effect.

Before the setting is changed, the [Settings\Setting::$validate](/api-reference/Piwik/Settings/Setting#$validate) and
[Settings\Setting::$transform](/api-reference/Piwik/Settings/Setting#$transform) closures will be invoked (if defined). If there is no validation
filter, the setting value will be casted to the appropriate data type.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$setting` ([`Setting`](../../Piwik/Settings/Setting.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$value` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the setting does not exist or if the current user is not allowed to change the value of this setting.

<a name="removesettingvalue" id="removesettingvalue"></a>
<a name="removeSettingValue" id="removeSettingValue"></a>
### `removeSettingValue()`

Unsets a setting value in memory.

#### Description

To persist the change, [save()](/api-reference/Piwik/Plugin/Settings#save) must be
called afterwards, otherwise the change has no effect.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$setting` ([`Setting`](../../Piwik/Settings/Setting.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

