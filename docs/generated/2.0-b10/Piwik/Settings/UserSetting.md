<small>Piwik\Settings</small>

UserSetting
===========

Describes a per user setting.

Description
-----------

Each user will be able to change this setting but each user
can set a different value. Changes from one user will not affect other users.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getOrder()`](#getorder) &mdash; Returns the display order.
- [`setUserLogin()`](#setuserlogin) &mdash; Sets the name of the user this setting will be set for.
- [`removeAllUserSettingsForUser()`](#removeallusersettingsforuser) &mdash; Unsets all settings for a user.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$name` (`string`) &mdash; The setting's persisted name.
    - `$title` (`string`) &mdash; The setting's display name.
    - `$userLogin` (`null`|`string`) &mdash; The user this setting applies to. Will default to the current user login.

<a name="getorder" id="getorder"></a>
<a name="getOrder" id="getOrder"></a>
### `getOrder()`

Returns the display order.

#### Description

User settings are displayed after system settings.

#### Signature

- It returns a `int` value.

<a name="setuserlogin" id="setuserlogin"></a>
<a name="setUserLogin" id="setUserLogin"></a>
### `setUserLogin()`

Sets the name of the user this setting will be set for.

#### Signature

- It accepts the following parameter(s):
    - `$userLogin` (`Piwik\Settings\$userLogin`)
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the current user does not have permission to set the setting value of `$userLogin`.

<a name="removeallusersettingsforuser" id="removeallusersettingsforuser"></a>
<a name="removeAllUserSettingsForUser" id="removeAllUserSettingsForUser"></a>
### `removeAllUserSettingsForUser()`

Unsets all settings for a user.

#### Description

The settings will be removed from the database. Used when
a user is deleted.

#### Signature

- It accepts the following parameter(s):
    - `$userLogin` (`string`)
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the `$userLogin` is empty.

