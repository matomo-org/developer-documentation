<small>Piwik</small>

Option
======

Convenient key-value storage for user specified options and temporary data that needs to be persisted beyond one request.

Description
-----------

### Examples

**Setting and getting options**

    $optionValue = Option::get('MyPlugin.MyOptionName');
    if ($optionValue === false) {
        // if not set, set it
        Option::set('MyPlugin.MyOptionName', 'my option value');
    }

**Storing user specific options**

    $userName = // ...
    Option::set('MyPlugin.MyOptionName.' . $userName, 'my option value');

**Clearing user specific options**

    Option::deleteLike('MyPlugin.MyOptionName.%');

Methods
-------

The class defines the following methods:

- [`get()`](#get) &mdash; Returns the option value for the requested option `$name`.
- [`set()`](#set) &mdash; Sets an option value by name.
- [`delete()`](#delete) &mdash; Deletes an option.
- [`deleteLike()`](#deletelike) &mdash; Deletes all options that match the supplied pattern.

<a name="get" id="get"></a>
<a name="get" id="get"></a>
### `get()`

Returns the option value for the requested option `$name`.

#### Signature

- It accepts the following parameter(s):
    - `$name` (`string`) &mdash; The option name.
- _Returns:_ The value or false, if not found.
    - `string`
    - `bool`

<a name="set" id="set"></a>
<a name="set" id="set"></a>
### `set()`

Sets an option value by name.

#### Signature

- It accepts the following parameter(s):
    - `$name`
    - `$value`
    - `$autoload`
- It does not return anything.

<a name="delete" id="delete"></a>
<a name="delete" id="delete"></a>
### `delete()`

Deletes an option.

#### Signature

- It accepts the following parameter(s):
    - `$name` (`string`) &mdash; Option name to match exactly.
    - `$value` (`string`) &mdash; If supplied the option will be deleted only if its value matches this value.
- It does not return anything.

<a name="deletelike" id="deletelike"></a>
<a name="deleteLike" id="deleteLike"></a>
### `deleteLike()`

Deletes all options that match the supplied pattern.

#### Signature

- It accepts the following parameter(s):
    - `$namePattern` (`string`) &mdash; Pattern of key to match. `'%'` characters should be used as wildcards, and literal `'_'` characters should be escaped.
    - `$value` (`string`) &mdash; If supplied options will be deleted only if their value matches this value.
- It does not return anything.

