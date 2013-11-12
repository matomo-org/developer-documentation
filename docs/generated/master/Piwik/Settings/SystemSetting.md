<small>Piwik\Settings</small>

SystemSetting
=============

Describes a system wide setting.

Description
-----------

Only the super user can change this type of setting and
the value of this setting will affect all users.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getOrder()`](#getorder) &mdash; Returns the display order.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$name` (`string`) &mdash; The persisted name of the setting.
    - `$title` (`string`) &mdash; The display name of the setting.

<a name="getorder" id="getorder"></a>
<a name="getOrder" id="getOrder"></a>
### `getOrder()`

Returns the display order.

#### Description

User settings are displayed after system settings.

#### Signature

- It returns a `int` value.

