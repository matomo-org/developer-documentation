<small>Piwik\Settings\</small>

Settings
========

Base class of all settings providers.

Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct)
- [`getTitle()`](#gettitle)
- [`getSettingsWritableByCurrentUser()`](#getsettingswritablebycurrentuser) &mdash; Returns the settings that can be displayed for the current user.
- [`addSetting()`](#addsetting) &mdash; Adds a new setting to the settings container.
- [`save()`](#save) &mdash; Saves (persists) the current setting values in the database.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature


<a name="gettitle" id="gettitle"></a>
<a name="getTitle" id="getTitle"></a>
### `getTitle()`

#### Signature

- It does not return anything.

<a name="getsettingswritablebycurrentuser" id="getsettingswritablebycurrentuser"></a>
<a name="getSettingsWritableByCurrentUser" id="getSettingsWritableByCurrentUser"></a>
### `getSettingsWritableByCurrentUser()`

Returns the settings that can be displayed for the current user.

#### Signature

- It returns a [`Setting[]`](../../Piwik/Settings/Setting.md) value.

<a name="addsetting" id="addsetting"></a>
<a name="addSetting" id="addSetting"></a>
### `addSetting()`

Adds a new setting to the settings container.

#### Signature

-  It accepts the following parameter(s):
    - `$setting` ([`Setting`](../../Piwik/Settings/Setting.md)) &mdash;
      
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If there is a setting with the same name that already exists. If the name contains non-alphanumeric characters.

<a name="save" id="save"></a>
<a name="save" id="save"></a>
### `save()`

Saves (persists) the current setting values in the database.

#### Signature

- It does not return anything.

