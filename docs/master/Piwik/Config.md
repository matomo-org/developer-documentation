<small>Piwik</small>

Config
======

For general performance (and specifically, the Tracker), we use deferred (lazy) initialization and cache sections.

Description
-----------

We also avoid any dependency on Zend Framework&#039;s Zend_Config.

We use a parse_ini_file() wrapper to parse the configuration files, in case php&#039;s built-in
function is disabled.

Example reading a value from the configuration:

    $minValue = Piwik_Config::getInstance()-&gt;General[&#039;minimum_memory_limit&#039;];

will read the value minimum_memory_limit under the [General] section of the config file.

Example setting a section in the configuration:

   $brandingConfig = array(
       &#039;use_custom_logo&#039; =&gt; 1,
   );
   Piwik_Config::getInstance()-&gt;branding = $brandingConfig;

Example setting an option within a section in the configuration:

   $brandingConfig = Piwik_Config::getInstance()-&gt;branding;
   $brandingConfig[&#039;use_custom_logo&#039;] = 1;
   Piwik_Config::getInstance()-&gt;branding = $brandingConfig;


Methods
-------

The class defines the following methods:

- [`__get()`](#__get) &mdash; Magic get methods catching calls to $config-&gt;var_name Returns the value if found in the configuration
- [`__set()`](#__set) &mdash; Set value
- [`forceSave()`](#forceSave) &mdash; Force save
- [`getInstance()`](#getInstance)

### `__get()` <a name="__get"></a>

Magic get methods catching calls to $config-&gt;var_name Returns the value if found in the configuration

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- _Returns:_ The value requested, returned by reference
    - `string`
    - `array`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the value requested not found in both files

### `__set()` <a name="__set"></a>

Set value

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$value`
- It does not return anything.

### `forceSave()` <a name="forceSave"></a>

Force save

#### Signature

- It is a **public** method.
- It does not return anything.

### `getInstance()` <a name="getInstance"></a>

#### Signature

- It is a **public** method.
- It returns a(n) [`Config`](../Piwik/Config.md) value.

