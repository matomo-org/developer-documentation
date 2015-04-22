<small>Piwik\Settings\</small>

UserSetting
===========

Describes a per user setting.

Each user will be able to change this setting for themselves,
but not for other users.

Properties
----------

This class defines the following properties:

- [`$type`](#$type) &mdash; Describes the setting's PHP data type. Inherited from [`Setting`](../../Piwik/Settings/Setting.md)
- [`$uiControlType`](#$uicontroltype) &mdash; Describes what HTML element should be used to manipulate the setting through Piwik's UI. Inherited from [`Setting`](../../Piwik/Settings/Setting.md)
- [`$uiControlAttributes`](#$uicontrolattributes) &mdash; Name-value mapping of HTML attributes that will be added HTML form control, eg, `array('size' => 3)`. Inherited from [`Setting`](../../Piwik/Settings/Setting.md)
- [`$availableValues`](#$availablevalues) &mdash; The list of all available values for this setting. Inherited from [`Setting`](../../Piwik/Settings/Setting.md)
- [`$introduction`](#$introduction) &mdash; Text that will appear above this setting's section in the _Plugin Settings_ admin page. Inherited from [`Setting`](../../Piwik/Settings/Setting.md)
- [`$description`](#$description) &mdash; Text that will appear directly underneath the setting title in the _Plugin Settings_ admin page. Inherited from [`Setting`](../../Piwik/Settings/Setting.md)
- [`$inlineHelp`](#$inlinehelp) &mdash; Text that will appear next to the setting's section in the _Plugin Settings_ admin page. Inherited from [`Setting`](../../Piwik/Settings/Setting.md)
- [`$validate`](#$validate) &mdash; A closure that does some custom validation on the setting before the setting is persisted. Inherited from [`Setting`](../../Piwik/Settings/Setting.md)
- [`$transform`](#$transform) &mdash; A closure that transforms the setting value. Inherited from [`Setting`](../../Piwik/Settings/Setting.md)
- [`$defaultValue`](#$defaultvalue) &mdash; Default value of this setting. Inherited from [`Setting`](../../Piwik/Settings/Setting.md)
- [`$title`](#$title) &mdash; This setting's display name, for example, `'Refresh Interval'`. Inherited from [`Setting`](../../Piwik/Settings/Setting.md)

<a name="$type" id="$type"></a>
<a name="type" id="type"></a>
### `$type`

Describes the setting's PHP data type.

When saved, setting values will always be casted to this
type.

See [Settings](/api-reference/Piwik/Plugin/Settings) for a list of supported data types.

#### Signature

- It is a `string` value.

<a name="$uicontroltype" id="$uicontroltype"></a>
<a name="uiControlType" id="uiControlType"></a>
### `$uiControlType`

Describes what HTML element should be used to manipulate the setting through Piwik's UI.

See [Settings](/api-reference/Piwik/Plugin/Settings) for a list of supported control types.

#### Signature

- It is a `string` value.

<a name="$uicontrolattributes" id="$uicontrolattributes"></a>
<a name="uiControlAttributes" id="uiControlAttributes"></a>
### `$uiControlAttributes`

Name-value mapping of HTML attributes that will be added HTML form control, eg, `array('size' => 3)`.

Attributes will be escaped before outputting.

#### Signature

- It is a `array` value.

<a name="$availablevalues" id="$availablevalues"></a>
<a name="availableValues" id="availableValues"></a>
### `$availableValues`

The list of all available values for this setting.

If null, the setting can have any value.

If supplied, this field should be an array mapping available values with their prettified
display value. Eg, if set to `array('nb_visits' => 'Visits', 'nb_actions' => 'Actions')`,
the UI will display **Visits** and **Actions**, and when the user selects one, Piwik will
set the setting to **nb_visits** or **nb_actions** respectively.

The setting value will be validated if this field is set. If the value is not one of the
available values, an error will be triggered.

_Note: If a custom validator is supplied (see [$validate](/api-reference/Piwik/Settings/UserSetting#$validate)), the setting value will
not be validated._

#### Signature

- It can be one of the following types:
    - `null`
    - `array`

<a name="$introduction" id="$introduction"></a>
<a name="introduction" id="introduction"></a>
### `$introduction`

Text that will appear above this setting's section in the _Plugin Settings_ admin page.

#### Signature

- It can be one of the following types:
    - `null`
    - `string`

<a name="$description" id="$description"></a>
<a name="description" id="description"></a>
### `$description`

Text that will appear directly underneath the setting title in the _Plugin Settings_ admin page.

If set, should be a short description of the setting.

#### Signature

- It can be one of the following types:
    - `null`
    - `string`

<a name="$inlinehelp" id="$inlinehelp"></a>
<a name="inlineHelp" id="inlineHelp"></a>
### `$inlineHelp`

Text that will appear next to the setting's section in the _Plugin Settings_ admin page.

If set,
it should contain information about the setting that is more specific than a general description,
such as the format of the setting value if it has a special format.

#### Signature

- It can be one of the following types:
    - `null`
    - `string`

<a name="$validate" id="$validate"></a>
<a name="validate" id="validate"></a>
### `$validate`

A closure that does some custom validation on the setting before the setting is persisted.

The closure should take two arguments: the setting value and the [Setting](/api-reference/Piwik/Settings/Setting) instance being
validated. If the value is found to be invalid, the closure should throw an exception with
a message that describes the error.

**Example**

    $setting->validate = function ($value, Setting $setting) {
        if ($value > 60) {
            throw new \Exception('The time limit is not allowed to be greater than 60 minutes.');
        }
    }

#### Signature

- It can be one of the following types:
    - `null`
    - [`Closure`](http://php.net/class.Closure)

<a name="$transform" id="$transform"></a>
<a name="transform" id="transform"></a>
### `$transform`

A closure that transforms the setting value.

If supplied, this closure will be executed after
the setting has been validated.

_Note: If a transform is supplied, the setting's [$type](/api-reference/Piwik/Settings/UserSetting#$type) has no effect. This means the
transformation function will be responsible for casting the setting value to the appropriate
data type._

**Example**

    $setting->transform = function ($value, Setting $setting) {
        if ($value > 30) {
            $value = 30;
        }

        return (int) $value;
    }

#### Signature

- It can be one of the following types:
    - `null`
    - [`Closure`](http://php.net/class.Closure)

<a name="$defaultvalue" id="$defaultvalue"></a>
<a name="defaultValue" id="defaultValue"></a>
### `$defaultValue`

Default value of this setting.

The default value is not casted to the appropriate data type. This means _**you**_ have to make
sure the value is of the correct type.

#### Signature

- It is a `mixed` value.

<a name="$title" id="$title"></a>
<a name="title" id="title"></a>
### `$title`

This setting's display name, for example, `'Refresh Interval'`.

#### Signature

- It is a `string` value.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getName()`](#getname) &mdash; Returns the setting's persisted name, eg, `'refreshInterval'`. Inherited from [`Setting`](../../Piwik/Settings/Setting.md)
- [`isWritableByCurrentUser()`](#iswritablebycurrentuser) &mdash; Returns `true` if this setting can be displayed for the current user, `false` if otherwise.
- [`isReadableByCurrentUser()`](#isreadablebycurrentuser) &mdash; Returns `true` if this setting can be displayed for the current user, `false` if otherwise.
- [`setStorage()`](#setstorage) &mdash; Sets the object used to persist settings. Inherited from [`Setting`](../../Piwik/Settings/Setting.md)
- [`getStorage()`](#getstorage) Inherited from [`Setting`](../../Piwik/Settings/Setting.md)
- [`setPluginName()`](#setpluginname) &mdash; Sets th name of the plugin the setting belongs to Inherited from [`Setting`](../../Piwik/Settings/Setting.md)
- [`getValue()`](#getvalue) &mdash; Returns the previously persisted setting value. Inherited from [`Setting`](../../Piwik/Settings/Setting.md)
- [`removeValue()`](#removevalue) &mdash; Returns the previously persisted setting value. Inherited from [`Setting`](../../Piwik/Settings/Setting.md)
- [`setValue()`](#setvalue) &mdash; Sets and persists this setting's value overwriting any existing value. Inherited from [`Setting`](../../Piwik/Settings/Setting.md)
- [`getKey()`](#getkey) &mdash; Returns the unique string key used to store this setting. Inherited from [`Setting`](../../Piwik/Settings/Setting.md)
- [`getOrder()`](#getorder) &mdash; Returns the display order.
- [`setUserLogin()`](#setuserlogin) &mdash; Sets the name of the user this setting will be set for.
- [`removeAllUserSettingsForUser()`](#removeallusersettingsforuser) &mdash; Unsets all settings for a user.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       The setting's persisted name.
    - `$title` (`string`) &mdash;
       The setting's display name.
    - `$userLogin` (`null`|`string`) &mdash;
       The user this setting applies to. Will default to the current user login.

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

Returns the setting's persisted name, eg, `'refreshInterval'`.

#### Signature

- It returns a `string` value.

<a name="iswritablebycurrentuser" id="iswritablebycurrentuser"></a>
<a name="isWritableByCurrentUser" id="isWritableByCurrentUser"></a>
### `isWritableByCurrentUser()`

Returns `true` if this setting can be displayed for the current user, `false` if otherwise.

#### Signature

- It returns a `bool` value.

<a name="isreadablebycurrentuser" id="isreadablebycurrentuser"></a>
<a name="isReadableByCurrentUser" id="isReadableByCurrentUser"></a>
### `isReadableByCurrentUser()`

Returns `true` if this setting can be displayed for the current user, `false` if otherwise.

#### Signature

- It returns a `bool` value.

<a name="setstorage" id="setstorage"></a>
<a name="setStorage" id="setStorage"></a>
### `setStorage()`

Sets the object used to persist settings.

#### Signature

-  It accepts the following parameter(s):
    - `$storage` (`Piwik\Settings\StorageInterface`) &mdash;
      
- It does not return anything.

<a name="getstorage" id="getstorage"></a>
<a name="getStorage" id="getStorage"></a>
### `getStorage()`

#### Signature

- It returns a `Piwik\Settings\StorageInterface` value.

<a name="setpluginname" id="setpluginname"></a>
<a name="setPluginName" id="setPluginName"></a>
### `setPluginName()`

Sets th name of the plugin the setting belongs to

#### Signature

-  It accepts the following parameter(s):
    - `$pluginName` (`string`) &mdash;
      
- It does not return anything.

<a name="getvalue" id="getvalue"></a>
<a name="getValue" id="getValue"></a>
### `getValue()`

Returns the previously persisted setting value.

If no value was set, the default value
is returned.

#### Signature

- It returns a `mixed` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the current user is not allowed to change the value of this setting.

<a name="removevalue" id="removevalue"></a>
<a name="removeValue" id="removeValue"></a>
### `removeValue()`

Returns the previously persisted setting value.

If no value was set, the default value
is returned.

#### Signature

- It returns a `mixed` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the current user is not allowed to change the value of this setting.

<a name="setvalue" id="setvalue"></a>
<a name="setValue" id="setValue"></a>
### `setValue()`

Sets and persists this setting's value overwriting any existing value.

#### Signature

-  It accepts the following parameter(s):
    - `$value` (`mixed`) &mdash;
      
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the current user is not allowed to change the value of this setting.

<a name="getkey" id="getkey"></a>
<a name="getKey" id="getKey"></a>
### `getKey()`

Returns the unique string key used to store this setting.

#### Signature

- It returns a `string` value.

<a name="getorder" id="getorder"></a>
<a name="getOrder" id="getOrder"></a>
### `getOrder()`

Returns the display order.

User settings are displayed after system settings.

#### Signature

- It returns a `int` value.

<a name="setuserlogin" id="setuserlogin"></a>
<a name="setUserLogin" id="setUserLogin"></a>
### `setUserLogin()`

Sets the name of the user this setting will be set for.

#### Signature

-  It accepts the following parameter(s):
    - `$userLogin` (`Piwik\Settings\$userLogin`) &mdash;
      
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the current user does not have permission to set the setting value of `$userLogin`.

<a name="removeallusersettingsforuser" id="removeallusersettingsforuser"></a>
<a name="removeAllUserSettingsForUser" id="removeAllUserSettingsForUser"></a>
### `removeAllUserSettingsForUser()`

Unsets all settings for a user.

The settings will be removed from the database. Used when
a user is deleted.

#### Signature

-  It accepts the following parameter(s):
    - `$userLogin` (`string`) &mdash;
      
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the `$userLogin` is empty.

