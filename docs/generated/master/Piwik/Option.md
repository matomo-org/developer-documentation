<small>Piwik</small>

Option
======

Convenient key-value storage for user specified options and temporary data that needs to be persisted beyond one request.

Description
-----------

### Examples

**Setting and getting options**

    $optionValue = Option::get(&#039;MyPlugin.MyOptionName&#039;);
    if ($optionValue === false) {
        // if not set, set it
        Option::set(&#039;MyPlugin.MyOptionName&#039;, &#039;my option value&#039;);
    }

**Storing user specific options**

    $userName = // ...
    Option::set(&#039;MyPlugin.MyOptionName.&#039; . $userName, &#039;my option value&#039;);

**Clearing user specific options**

    Option::deleteLike(&#039;MyPlugin.MyOptionName.%&#039;);


Methods
-------

The class defines the following methods:

- [`get()`](#get) &mdash; Returns the option value for the requested option `$name`.
- [`set()`](#set) &mdash; Sets an option value by name.
- [`delete()`](#delete) &mdash; Deletes an option.
- [`deleteLike()`](#deleteLike) &mdash; Deletes all options that match the supplied pattern.
- [`clearCache()`](#clearCache) &mdash; Clears the option value cache and forces a reload from the Database.

### `get()` <a name="get"></a>

Returns the option value for the requested option `$name`.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$name`
- _Returns:_ The value or false, if not found.
    - `string`
    - `bool`

### `set()` <a name="set"></a>

Sets an option value by name.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$name`
    - `$value`
    - `$autoload`
- It does not return anything.

### `delete()` <a name="delete"></a>

Deletes an option.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$name`
    - `$value`
- It does not return anything.

### `deleteLike()` <a name="deleteLike"></a>

Deletes all options that match the supplied pattern.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$namePattern`
    - `$value`
- It does not return anything.

### `clearCache()` <a name="clearCache"></a>

Clears the option value cache and forces a reload from the Database.

#### Description

Used in unit tests to reset the state of the object between tests.

#### Signature

- It is a **public static** method.
- It returns a(n) `void` value.

