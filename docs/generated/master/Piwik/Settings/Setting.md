<small>Piwik\Settings\</small>

Setting
=======

Base setting type class.

Properties
----------

This abstract class defines the following properties:

- [`$type`](#$type) &mdash; Describes the setting's PHP data type.
- [`$uiControlType`](#$uicontroltype) &mdash; Describes what HTML element should be used to manipulate the setting through Piwik's UI.
- [`$uiControlAttributes`](#$uicontrolattributes) &mdash; Name-value mapping of HTML attributes that will be added HTML form control, eg, `array('size' => 3)`.
- [`$availableValues`](#$availablevalues) &mdash; The list of all available values for this setting.
- [`$introduction`](#$introduction) &mdash; Text that will appear above this setting's section in the _Plugin Settings_ admin page.
- [`$description`](#$description) &mdash; Text that will appear directly underneath the setting title in the _Plugin Settings_ admin page.
- [`$inlineHelp`](#$inlinehelp) &mdash; Text that will appear next to the setting's section in the _Plugin Settings_ admin page.
- [`$validate`](#$validate) &mdash; A closure that does some custom validation on the setting before the setting is persisted.
- [`$transform`](#$transform) &mdash; A closure that transforms the setting value.
- [`$defaultValue`](#$defaultvalue) &mdash; Default value of this setting.
- [`$title`](#$title) &mdash; This setting's display name, for example, `'Refresh Interval'`.

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

_Note: If a custom validator is supplied (see [$validate](/api-reference/Piwik/Settings/Setting#$validate)), the setting value will
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

_Note: If a transform is supplied, the setting's [$type](/api-reference/Piwik/Settings/Setting#$type) has no effect. This means the
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

The abstract class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getName()`](#getname) &mdash; Returns the setting's persisted name, eg, `'refreshInterval'`.
- [`isWritableByCurrentUser()`](#iswritablebycurrentuser) &mdash; Returns `true` if this setting is writable for the current user, `false` if otherwise.
- [`isReadableByCurrentUser()`](#isreadablebycurrentuser) &mdash; Returns `true` if this setting can be displayed for the current user, `false` if otherwise.
- [`setStorage()`](#setstorage) &mdash; Sets the object used to persist settings.
- [`getValue()`](#getvalue) &mdash; Returns the previously persisted setting value.
- [`setValue()`](#setvalue) &mdash; Sets and persists this setting's value overwriting any existing value.
- [`getKey()`](#getkey) &mdash; Returns the unique string key used to store this setting.
- [`getOrder()`](#getorder) &mdash; Returns the display order.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The setting's persisted name. Only alphanumeric characters are allowed, eg, `'refreshInterval'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$title` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The setting's display name, eg, `'Refresh Interval'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

Returns the setting's persisted name, eg, `'refreshInterval'`.

#### Signature

- It returns a `string` value.

<a name="iswritablebycurrentuser" id="iswritablebycurrentuser"></a>
<a name="isWritableByCurrentUser" id="isWritableByCurrentUser"></a>
### `isWritableByCurrentUser()`

Returns `true` if this setting is writable for the current user, `false` if otherwise.

In case it returns
writable for the current user it will be visible in the Plugin settings UI.

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

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$storage` (`Piwik\Settings\StorageInterface`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `Piwik\Settings\StorageInterface` value.

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

<a name="setvalue" id="setvalue"></a>
<a name="setValue" id="setValue"></a>
### `setValue()`

Sets and persists this setting's value overwriting any existing value.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$value` (`mixed`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
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

The lower the return value, the earlier the setting will be displayed.

#### Signature

- It returns a `int` value.

