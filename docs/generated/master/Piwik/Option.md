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
- [`deleteLike()`](#deleteLike) &mdash; Deletes all options that match the supplied pattern.
- [`clearCache()`](#clearCache) &mdash; Clears the option value cache and forces a reload from the Database.

<a name="get" id="get"></a>
### `get()`

Returns the option value for the requested option `$name`.

#### Signature

- It accepts the following parameter(s):
    - `$name`
- _Returns:_ The value or false, if not found.
    - `string`
    - `bool`

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
### `delete()`

Deletes an option.

#### Signature

- It accepts the following parameter(s):
    - `$name`
    - `$value`
- It does not return anything.

<a name="deletelike" id="deletelike"></a>
### `deleteLike()`

Deletes all options that match the supplied pattern.

#### Signature

- It accepts the following parameter(s):
    - `$namePattern`
    - `$value`
- It does not return anything.

<a name="clearcache" id="clearcache"></a>
### `clearCache()`

Clears the option value cache and forces a reload from the Database.

#### Description

Used in unit tests to reset the state of the object between tests.

#### Signature

- It returns a(n) `void` value.

