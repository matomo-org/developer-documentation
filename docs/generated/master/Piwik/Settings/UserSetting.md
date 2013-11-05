<small>Piwik\Settings</small>

UserSetting
===========

Per user setting.

Description
-----------

Each user will be able to change this setting but each user can set a different value. That means
a changed value does not effect any other users.


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`getOrder()`](#getOrder)
- [`setUserLogin()`](#setUserLogin) &mdash; Sets (overwrites) the userLogin.
- [`removeAllUserSettingsForUser()`](#removeAllUserSettingsForUser) &mdash; Remove all stored settings of the given userLogin.

<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

- It accepts the following parameter(s):
    - `$name`
    - `$title`
    - `$userLogin`
- It does not return anything.

<a name="getorder" id="getorder"></a>
### `getOrder()`

#### Signature

- It does not return anything.

<a name="setuserlogin" id="setuserlogin"></a>
### `setUserLogin()`

Sets (overwrites) the userLogin.

#### Signature

- It accepts the following parameter(s):
    - `$userLogin`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; In case you set a userLogin that is not your userLogin and you are not the superUser.

<a name="removeallusersettingsforuser" id="removeallusersettingsforuser"></a>
### `removeAllUserSettingsForUser()`

Remove all stored settings of the given userLogin.

#### Description

This is important to cleanup all settings for a user once he
is deleted. Otherwise a user could register with the same name afterwards and see the previous user's settings.

#### Signature

- It accepts the following parameter(s):
    - `$userLogin`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; In case the userLogin is empty.

