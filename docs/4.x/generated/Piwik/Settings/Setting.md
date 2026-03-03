<small>Piwik\Settings\</small>

Setting
=======

Base setting type class.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getName()`](#getname) &mdash; Get the name of the setting.
- [`getType()`](#gettype) &mdash; Get the PHP type of the setting.
- [`getDefaultValue()`](#getdefaultvalue)
- [`setDefaultValue()`](#setdefaultvalue) &mdash; Sets/overwrites the current default value
- [`setIsWritableByCurrentUser()`](#setiswritablebycurrentuser) &mdash; Set whether setting is writable or not.
- [`isWritableByCurrentUser()`](#iswritablebycurrentuser) &mdash; Returns `true` if this setting is writable for the current user, `false` if otherwise.
- [`save()`](#save) &mdash; Saves (persists) the value for this setting in the database if a value has been actually set.
- [`getValue()`](#getvalue) &mdash; Returns the previously persisted setting value.
- [`setValue()`](#setvalue) &mdash; Sets and persists this setting's value overwriting any existing value.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       The setting's persisted name. Only alphanumeric characters are allowed, eg, `'refreshInterval'`.
    - `$defaultValue` (`mixed`) &mdash;
       Default value for this setting if no value was specified.
    - `$type` (`string`) &mdash;
       Eg an array, int, ... see SettingConfig::TYPE_* constants
    - `$pluginName` (`string`) &mdash;
       The name of the plugin the setting belongs to
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

Get the name of the setting.

#### Signature

- It returns a `string` value.

<a name="gettype" id="gettype"></a>
<a name="getType" id="getType"></a>
### `getType()`

Get the PHP type of the setting.

#### Signature

- It returns a `string` value.

<a name="getdefaultvalue" id="getdefaultvalue"></a>
<a name="getDefaultValue" id="getDefaultValue"></a>
### `getDefaultValue()`

#### Signature

- It returns a `mixed` value.

<a name="setdefaultvalue" id="setdefaultvalue"></a>
<a name="setDefaultValue" id="setDefaultValue"></a>
### `setDefaultValue()`

Sets/overwrites the current default value

#### Signature

-  It accepts the following parameter(s):
    - `$defaultValue` (`string`) &mdash;
      
- It does not return anything or a mixed result.

<a name="setiswritablebycurrentuser" id="setiswritablebycurrentuser"></a>
<a name="setIsWritableByCurrentUser" id="setIsWritableByCurrentUser"></a>
### `setIsWritableByCurrentUser()`

Set whether setting is writable or not. For example to hide setting from the UI set it to false.

#### Signature

-  It accepts the following parameter(s):
    - `$isWritable` (`bool`) &mdash;
      
- It does not return anything or a mixed result.

<a name="iswritablebycurrentuser" id="iswritablebycurrentuser"></a>
<a name="isWritableByCurrentUser" id="isWritableByCurrentUser"></a>
### `isWritableByCurrentUser()`

Returns `true` if this setting is writable for the current user, `false` if otherwise. In case it returns
writable for the current user it will be visible in the Plugin settings UI.

#### Signature

- It returns a `bool` value.

<a name="save" id="save"></a>
<a name="save" id="save"></a>
### `save()`

Saves (persists) the value for this setting in the database if a value has been actually set.

#### Signature

- It does not return anything or a mixed result.

<a name="getvalue" id="getvalue"></a>
<a name="getValue" id="getValue"></a>
### `getValue()`

Returns the previously persisted setting value. If no value was set, the default value
is returned.

#### Signature

- It returns a `mixed` value.

<a name="setvalue" id="setvalue"></a>
<a name="setValue" id="setValue"></a>
### `setValue()`

Sets and persists this setting's value overwriting any existing value.

Before a value is actually set it will be made sure the current user is allowed to change the value. The value
will be first validated either via a system built-in validate method or via a set [FieldConfig::$validate](/api-reference/Piwik/Settings/FieldConfig#$validate)
custom method. Afterwards the value will be transformed via a possibly specified [FieldConfig::$transform](/api-reference/Piwik/Settings/FieldConfig#$transform)
method. Before storing the actual value, the value will be converted to the actually specified $type.

#### Signature

-  It accepts the following parameter(s):
    - `$value` (`mixed`) &mdash;
      
- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the current user is not allowed to change the value of this setting.

