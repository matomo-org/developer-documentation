<small>Piwik\</small>

Config
======

Singleton that provides read & write access to Piwik's INI configuration.

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
- [`getFromGlobalConfig()`](#getfromglobalconfig)
- [`getFromCommonConfig()`](#getfromcommonconfig)
- [`getFromLocalConfig()`](#getfromlocalconfig)
- [`__set()`](#__set) &mdash; Sets a configuration value or section.
- [`forceSave()`](#forcesave) &mdash; Writes the current configuration to the **config.ini.php** file.

<a name="__get" id="__get"></a>
<a name="__get" id="__get"></a>
### `__get()`

Returns a configuration value or section by name.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       The value or section name.

- *Returns:*  `string`|`array` &mdash;
    The requested value requested. Returned by reference.
- It throws one of the following exceptions:
    - `Stmt_Namespace\Exception` &mdash; If the value requested not found in either `config.ini.php` or
                  `global.ini.php`.

<a name="getfromglobalconfig" id="getfromglobalconfig"></a>
<a name="getFromGlobalConfig" id="getFromGlobalConfig"></a>
### `getFromGlobalConfig()`

#### Signature

-  It accepts the following parameter(s):
    - `$name`
      
- It does not return anything or a mixed result.

<a name="getfromcommonconfig" id="getfromcommonconfig"></a>
<a name="getFromCommonConfig" id="getFromCommonConfig"></a>
### `getFromCommonConfig()`

#### Signature

-  It accepts the following parameter(s):
    - `$name`
      
- It does not return anything or a mixed result.

<a name="getfromlocalconfig" id="getfromlocalconfig"></a>
<a name="getFromLocalConfig" id="getFromLocalConfig"></a>
### `getFromLocalConfig()`

#### Signature

-  It accepts the following parameter(s):
    - `$name`
      
- It does not return anything or a mixed result.

<a name="__set" id="__set"></a>
<a name="__set" id="__set"></a>
### `__set()`

Sets a configuration value or section.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       This section name or value name to set.
    - `$value` (`mixed`) &mdash;
      
- It does not return anything or a mixed result.

<a name="forcesave" id="forcesave"></a>
<a name="forceSave" id="forceSave"></a>
### `forceSave()`

Writes the current configuration to the **config.ini.php** file. Only writes options whose
values are different from the default.

#### Signature

- It does not return anything or a mixed result.

