<small>Piwik</small>

Config
======

Singleton that provides read &amp; write access to Piwik&#039;s INI configuration.

Description
-----------

This class reads and writes to the `config/config.ini.php` file. If config
options are missing from that file, this class will look for their default
values in `config/global.ini.php`.

### Examples

**Getting a value:**

    // read the minimum_memory_limit option under the [General] section
    $minValue = Config::getInstance()->General['minimum_memory_limit'];

**Setting a value:**

    // set the minimum_memory_limit option
    Config::getInstance()->General['minimum_memory_limit'] = 256;
    Config::getInstance()->forceSave();

**Setting an entire section:**

    Config::getInstance()->MySection = array('myoption' => 1);
    Config::getInstance()->forceSave();


Methods
-------

The class defines the following methods:

- [`__get()`](#__get) &mdash; Returns a configuration value or section by name.
- [`__set()`](#__set) &mdash; Sets a configuration value or section.
- [`forceSave()`](#forceSave) &mdash; Writes the current configuration to `config.ini.php`.

### `__get()` <a name="__get"></a>

Returns a configuration value or section by name.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- _Returns:_ The requested value requested. Returned by reference.
    - `string`
    - `array`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the value requested not found in either `config.ini.php` or `global.ini.php`.

### `__set()` <a name="__set"></a>

Sets a configuration value or section.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$value`
- It does not return anything.

### `forceSave()` <a name="forceSave"></a>

Writes the current configuration to `config.ini.php`.

#### Signature

- It is a **public** method.
- It does not return anything.

