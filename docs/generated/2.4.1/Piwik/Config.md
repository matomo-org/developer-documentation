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

- [`getInstance()`](#getinstance) &mdash; Returns the singleton instance for the derived class.
- [`__get()`](#__get) &mdash; Returns a configuration value or section by name.
- [`__set()`](#__set) &mdash; Sets a configuration value or section.
- [`forceSave()`](#forcesave) &mdash; Writes the current configuration to the **config.ini.php** file.

<a name="getinstance" id="getinstance"></a>
<a name="getInstance" id="getInstance"></a>
### `getInstance()`

Returns the singleton instance for the derived class.

If the singleton instance
has not been created, this method will create it.

#### Signature

- It returns a [`Singleton`](../Piwik/Singleton.md) value.

<a name="__get" id="__get"></a>
<a name="__get" id="__get"></a>
### `__get()`

Returns a configuration value or section by name.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The value or section name.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`|`array`) &mdash;
    <div markdown="1" class="param-desc">The requested value requested. Returned by reference.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the value requested not found in either `config.ini.php` or `global.ini.php`.

<a name="__set" id="__set"></a>
<a name="__set" id="__set"></a>
### `__set()`

Sets a configuration value or section.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> This section name or value name to set.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$value` (`mixed`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="forcesave" id="forcesave"></a>
<a name="forceSave" id="forceSave"></a>
### `forceSave()`

Writes the current configuration to the **config.ini.php** file.

Only writes options whose
values are different from the default.

#### Signature

- It does not return anything.

