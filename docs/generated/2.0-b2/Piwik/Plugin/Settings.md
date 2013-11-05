<small>Piwik\Plugin</small>

Settings
========

Settings class that plugins can extend in order to create settings for their plugins.


Constants
---------

This abstract class defines the following constants:

- TYPE_INT
- TYPE_FLOAT
- TYPE_STRING
- TYPE_BOOL
- TYPE_ARRAY
- FIELD_RADIO
- FIELD_TEXT
- FIELD_TEXTAREA
- FIELD_CHECKBOX
- FIELD_PASSWORD
- FIELD_MULTI_SELECT
- FIELD_SINGLE_SELECT

Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct)
- [`getIntroduction()`](#getintroduction)
- [`getSettingsForCurrentUser()`](#getsettingsforcurrentuser) &mdash; Returns only settings that can be displayed for current user.
- [`getSettings()`](#getsettings) &mdash; Get all available settings without checking any permissions.
- [`save()`](#save) &mdash; Saves (persists) the current setting values in the database.
- [`removeAllPluginSettings()`](#removeallpluginsettings) &mdash; Removes all settings for this plugin.
- [`getSettingValue()`](#getsettingvalue) &mdash; Gets the current value for this setting.
- [`setSettingValue()`](#setsettingvalue) &mdash; Sets (overwrites) the value for the given setting.
- [`removeSettingValue()`](#removesettingvalue) &mdash; Removes the value for the given setting.

<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

- It accepts the following parameter(s):
    - `$pluginName`
- It does not return anything.

<a name="getintroduction" id="getintroduction"></a>
### `getIntroduction()`

#### Signature

- It does not return anything.

<a name="getsettingsforcurrentuser" id="getsettingsforcurrentuser"></a>
### `getSettingsForCurrentUser()`

Returns only settings that can be displayed for current user.

#### Description

For instance a regular user won't see get
any settings that require super user permissions.

#### Signature

- It returns a(n) `Piwik\Settings\Setting` value.

<a name="getsettings" id="getsettings"></a>
### `getSettings()`

Get all available settings without checking any permissions.

#### Signature

- It returns a(n) `Piwik\Settings\Setting` value.

<a name="save" id="save"></a>
### `save()`

Saves (persists) the current setting values in the database.

#### Signature

- It does not return anything.

<a name="removeallpluginsettings" id="removeallpluginsettings"></a>
### `removeAllPluginSettings()`

Removes all settings for this plugin.

#### Description

Useful for instance while uninstalling the plugin.

#### Signature

- It does not return anything.

<a name="getsettingvalue" id="getsettingvalue"></a>
### `getSettingValue()`

Gets the current value for this setting.

#### Description

If no value is specified, the default value will be returned.

#### Signature

- It accepts the following parameter(s):
    - `$setting` (`Piwik\Settings\Setting`)
- It returns a(n) `mixed` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; In case the setting does not exist or if the current user is not allowed to change the value of this setting.

<a name="setsettingvalue" id="setsettingvalue"></a>
### `setSettingValue()`

Sets (overwrites) the value for the given setting.

#### Description

Make sure to call `save()` afterwards, otherwise the change
has no effect. Before the value is saved a possibly define `validate` closure and `filter` closure will be
called. Alternatively the value will be casted to the specfied setting type.

#### Signature

- It accepts the following parameter(s):
    - `$setting` (`Piwik\Settings\Setting`)
    - `$value`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; In case the setting does not exist or if the current user is not allowed to change the value of this setting.

<a name="removesettingvalue" id="removesettingvalue"></a>
### `removeSettingValue()`

Removes the value for the given setting.

#### Description

Make sure to call `save()` afterwards, otherwise the removal has no
effect.

#### Signature

- It accepts the following parameter(s):
    - `$setting` (`Piwik\Settings\Setting`)
- It does not return anything.

