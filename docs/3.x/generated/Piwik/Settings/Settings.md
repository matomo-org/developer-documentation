<small>Piwik\Settings\</small>

Settings
========

Base class of all settings providers.

Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct)
- [`getSetting()`](#getsetting)
- [`getSettingsWritableByCurrentUser()`](#getsettingswritablebycurrentuser) &mdash; Returns the settings that can be displayed for the current user.
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

- It returns a [`Setting[]`](../../Piwik/Settings/Setting.md) value.

<a name="save" id="save"></a>
<a name="save" id="save"></a>
### `save()`

Saves (persists) the current setting values in the database.

#### Signature

- It does not return anything.

