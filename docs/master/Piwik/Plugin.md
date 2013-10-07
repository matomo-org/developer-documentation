<small>Piwik</small>

Plugin
======

Abstract class to define a Plugin.

Description
-----------

Any plugin has to at least implement the abstract methods of this class.


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getInformation()`](#getInformation) &mdash; Returns the plugin details - &#039;description&#039; =&gt; string        // 1-2 sentence description of the plugin - &#039;author&#039; =&gt; string             // plugin author - &#039;author_homepage&#039; =&gt; string    // author homepage URL (or email &quot;mailto:youremail@example.org&quot;) - &#039;homepage&#039; =&gt; string           // plugin homepage URL - &#039;license&#039; =&gt; string            // plugin license - &#039;license_homepage&#039; =&gt; string   // license homepage URL - &#039;version&#039; =&gt; string            // plugin version number; examples and 3rd party plugins must not use Version::VERSION; 3rd party plugins must increment the version number with each plugin release - &#039;theme&#039; =&gt; bool                // Whether this plugin is a theme (a theme is a plugin, but a plugin is not necessarily a theme)
- [`getListHooksRegistered()`](#getListHooksRegistered) &mdash; Returns the list of hooks registered with the methods names
- [`postLoad()`](#postLoad) &mdash; Executed after loading plugin and registering translations Useful for code that uses translated strings from the plugin.
- [`install()`](#install) &mdash; Install the plugin - create tables - update existing tables - etc.
- [`uninstall()`](#uninstall) &mdash; Remove the created resources during the install
- [`activate()`](#activate) &mdash; Executed every time the plugin is enabled
- [`deactivate()`](#deactivate) &mdash; Executed every time the plugin is disabled
- [`getVersion()`](#getVersion) &mdash; Returns the plugin version number
- [`isTheme()`](#isTheme) &mdash; Whether this plugin is a theme
- [`getPluginName()`](#getPluginName) &mdash; Returns the plugin&#039;s base class name without the &quot;Piwik_&quot; prefix, e.g., &quot;UserCountry&quot; when the plugin class is &quot;UserCountry&quot;
- [`getPluginNameFromBacktrace()`](#getPluginNameFromBacktrace) &mdash; Extracts the plugin name from a backtrace array.

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$pluginName`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `getInformation()` <a name="getInformation"></a>

Returns the plugin details - &#039;description&#039; =&gt; string        // 1-2 sentence description of the plugin - &#039;author&#039; =&gt; string             // plugin author - &#039;author_homepage&#039; =&gt; string    // author homepage URL (or email &quot;mailto:youremail@example.org&quot;) - &#039;homepage&#039; =&gt; string           // plugin homepage URL - &#039;license&#039; =&gt; string            // plugin license - &#039;license_homepage&#039; =&gt; string   // license homepage URL - &#039;version&#039; =&gt; string            // plugin version number; examples and 3rd party plugins must not use Version::VERSION; 3rd party plugins must increment the version number with each plugin release - &#039;theme&#039; =&gt; bool                // Whether this plugin is a theme (a theme is a plugin, but a plugin is not necessarily a theme)

#### Signature

- It is a **public** method.
- It returns a(n) `array` value.

### `getListHooksRegistered()` <a name="getListHooksRegistered"></a>

Returns the list of hooks registered with the methods names

#### Signature

- It is a **public** method.
- _Returns:_ eg, array( &#039;API.getReportMetadata&#039; =&gt; &#039;myPluginFunction&#039;, &#039;Another.event&#039;         =&gt; array( &#039;function&#039; =&gt; &#039;myOtherPluginFunction&#039;, &#039;after&#039;    =&gt; true // execute after callbacks w/o ordering ) &#039;Yet.Another.event&#039;     =&gt; array( &#039;function&#039; =&gt; &#039;myOtherPluginFunction&#039;, &#039;before&#039;   =&gt; true // execute before callbacks w/o ordering ) )
    - `array`

### `postLoad()` <a name="postLoad"></a>

Executed after loading plugin and registering translations Useful for code that uses translated strings from the plugin.

#### Signature

- It is a **public** method.
- It does not return anything.

### `install()` <a name="install"></a>

Install the plugin - create tables - update existing tables - etc.

#### Signature

- It is a **public** method.
- It does not return anything.

### `uninstall()` <a name="uninstall"></a>

Remove the created resources during the install

#### Signature

- It is a **public** method.
- It does not return anything.

### `activate()` <a name="activate"></a>

Executed every time the plugin is enabled

#### Signature

- It is a **public** method.
- It does not return anything.

### `deactivate()` <a name="deactivate"></a>

Executed every time the plugin is disabled

#### Signature

- It is a **public** method.
- It does not return anything.

### `getVersion()` <a name="getVersion"></a>

Returns the plugin version number

#### Signature

- It is a **public** method.
- It is a **finalized** method.
- It returns a(n) `string` value.

### `isTheme()` <a name="isTheme"></a>

Whether this plugin is a theme

#### Signature

- It is a **public** method.
- It is a **finalized** method.
- It returns a(n) `bool` value.

### `getPluginName()` <a name="getPluginName"></a>

Returns the plugin&#039;s base class name without the &quot;Piwik_&quot; prefix, e.g., &quot;UserCountry&quot; when the plugin class is &quot;UserCountry&quot;

#### Signature

- It is a **public** method.
- It is a **finalized** method.
- It returns a(n) `string` value.

### `getPluginNameFromBacktrace()` <a name="getPluginNameFromBacktrace"></a>

Extracts the plugin name from a backtrace array.

#### Description

Returns false if we can&#039;t find one.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$backtrace`
- It can return one of the following values:
    - `string`
    - `Piwik\false`

