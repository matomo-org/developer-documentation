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

### `__construct()` <a name="__construct"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$title`
    - `$userLogin`
- It does not return anything.

### `getOrder()` <a name="getOrder"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

### `setUserLogin()` <a name="setUserLogin"></a>

Sets (overwrites) the userLogin.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$userLogin`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; In case you set a userLogin that is not your userLogin and you are not the superUser.

### `removeAllUserSettingsForUser()` <a name="removeAllUserSettingsForUser"></a>

Remove all stored settings of the given userLogin.

#### Description

This is important to cleanup all settings for a user once he
is deleted. Otherwise a user could register with the same name afterwards and see the previous user&#039;s settings.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$userLogin`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; In case the userLogin is empty.

