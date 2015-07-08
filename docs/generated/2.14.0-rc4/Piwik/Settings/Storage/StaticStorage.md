<small>Piwik\Settings\Storage\</small>

StaticStorage
=============

Static / temporary storage where a value will never be persisted meaning it will use the default value for each request until configured differently.

Useful for tests.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) Inherited from [`Storage`](../../../Piwik/Settings/Storage.md)
- [`save()`](#save) &mdash; Saves (persists) the current setting values in the database.
- [`deleteAllValues()`](#deleteallvalues) &mdash; Removes all settings for this plugin from the database. Inherited from [`Storage`](../../../Piwik/Settings/Storage.md)
- [`getValue()`](#getvalue) &mdash; Returns the current value for a setting. Inherited from [`Storage`](../../../Piwik/Settings/Storage.md)
- [`setValue()`](#setvalue) &mdash; Sets (overwrites) the value of a setting in memory. Inherited from [`Storage`](../../../Piwik/Settings/Storage.md)
- [`deleteValue()`](#deletevalue) &mdash; Unsets a setting value in memory. Inherited from [`Storage`](../../../Piwik/Settings/Storage.md)
- [`getOptionKey()`](#getoptionkey) Inherited from [`Storage`](../../../Piwik/Settings/Storage.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

-  It accepts the following parameter(s):
    - `$pluginName`
      

<a name="save" id="save"></a>
<a name="save" id="save"></a>
### `save()`

Saves (persists) the current setting values in the database.

#### Signature

- It does not return anything.

<a name="deleteallvalues" id="deleteallvalues"></a>
<a name="deleteAllValues" id="deleteAllValues"></a>
### `deleteAllValues()`

Removes all settings for this plugin from the database.

Useful when uninstalling
a plugin.

#### Signature

- It does not return anything.

<a name="getvalue" id="getvalue"></a>
<a name="getValue" id="getValue"></a>
### `getValue()`

Returns the current value for a setting.

If no value is stored, the default value
is be returned.

#### Signature

-  It accepts the following parameter(s):
    - `$setting` ([`Setting`](../../../Piwik/Settings/Setting.md)) &mdash;
      
- It returns a `mixed` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the setting does not exist or if the current user is not allowed to change the value of this setting.

<a name="setvalue" id="setvalue"></a>
<a name="setValue" id="setValue"></a>
### `setValue()`

Sets (overwrites) the value of a setting in memory.

To persist the change, [save()](/api-reference/Piwik/Settings/Storage/StaticStorage#save) must be
called afterwards, otherwise the change has no effect.

Before the setting is changed, the [Setting::$validate](/api-reference/Piwik/Settings/Setting#$validate) and
[Setting::$transform](/api-reference/Piwik/Settings/Setting#$transform) closures will be invoked (if defined). If there is no validation
filter, the setting value will be casted to the appropriate data type.

#### Signature

-  It accepts the following parameter(s):
    - `$setting` ([`Setting`](../../../Piwik/Settings/Setting.md)) &mdash;
      
    - `$value` (`string`) &mdash;
      
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the setting does not exist or if the current user is not allowed to change the value of this setting.

<a name="deletevalue" id="deletevalue"></a>
<a name="deleteValue" id="deleteValue"></a>
### `deleteValue()`

Unsets a setting value in memory.

To persist the change, [save()](/api-reference/Piwik/Settings/Storage/StaticStorage#save) must be
called afterwards, otherwise the change has no effect.

#### Signature

-  It accepts the following parameter(s):
    - `$setting` ([`Setting`](../../../Piwik/Settings/Setting.md)) &mdash;
      
- It does not return anything.

<a name="getoptionkey" id="getoptionkey"></a>
<a name="getOptionKey" id="getOptionKey"></a>
### `getOptionKey()`

#### Signature

- It does not return anything.

