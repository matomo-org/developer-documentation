<small>Piwik</small>

Plugin
======

Base class of all Plugin Descriptor classes.

Description
-----------

Any plugin that wants to add event observers to one of Piwik&#039;s [hooks](#), 
or has special installation/uninstallation logic must implement this class.
Plugins that can specify everything they need to in the _plugin.json_ files,
such as themes, don&#039;t need to implement this class.

The name of the implementation of this class should be the same name as the
plugin they are a part of (eg, `class UserCountry extends Plugin`).

### Plugin Metadata

In addition to providing a place for plugins to install/uninstall themselves
and add event observers, this class is also responsible for loading metadata
found in the plugin.json file.

The plugin.json file must exist in the root directory of a plugin. It can
contain the following information:

- **description**: An internationalized string description of what the plugin
                   does.
- **homepage**: The URL to the plugin&#039;s website.
- **author**: Author name.
- **author_homepage**: The URL to the author&#039;s website.
- **license**: The license the code uses (eg, GPL, MIT, etc.).
- **license_homepage**: URL to website describing the license used.
- **version**: The plugin version (eg, 1.0.1).
- **theme**: `true` or `false`. If `true`, the plugin will be treated as a theme.

### Examples

**How to extend**

    use Piwik\Common;
    use Piwik\Plugin;
    use Piwik\Db;

    class MyPlugin extends Plugin
    {
        public function getListHooksRegistered()
        {
            return array(
                &#039;API.getReportMetadata&#039; =&gt; &#039;myPluginFunction&#039;,
                &#039;Another.event&#039;         =&gt; array(
                                               &#039;function&#039; =&gt; &#039;myOtherPluginFunction&#039;,
                                               &#039;after&#039;    =&gt; true // execute after callbacks w/o ordering
                                           )
            );
        }

        public function install()
        {
            Db::exec(&quot;CREATE TABLE &quot; . Common::prefixTable(&#039;mytable&#039;) . &quot;...&quot;);
        }

        public function uninstall()
        {
            Db::exec(&quot;DROP TABLE IF EXISTS &quot; . Common::prefixTable(&#039;mytable&#039;));
        }
    }


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getInformation()`](#getInformation) &mdash; Returns the plugin details - &#039;description&#039; =&gt; string        // 1-2 sentence description of the plugin - &#039;author&#039; =&gt; string             // plugin author - &#039;author_homepage&#039; =&gt; string    // author homepage URL (or email &quot;mailto:youremail@example.org&quot;) - &#039;homepage&#039; =&gt; string           // plugin homepage URL - &#039;license&#039; =&gt; string            // plugin license - &#039;license_homepage&#039; =&gt; string   // license homepage URL - &#039;version&#039; =&gt; string            // plugin version number; examples and 3rd party plugins must not use Version::VERSION; 3rd party plugins must increment the version number with each plugin release - &#039;theme&#039; =&gt; bool                // Whether this plugin is a theme (a theme is a plugin, but a plugin is not necessarily a theme)
- [`getListHooksRegistered()`](#getListHooksRegistered) &mdash; Returns a list of hooks with associated event observers.
- [`postLoad()`](#postLoad) &mdash; This method is executed after a plugin is loaded and translations are registered.
- [`install()`](#install) &mdash; Installs the plugin.
- [`uninstall()`](#uninstall) &mdash; Uninstalls the plugins.
- [`activate()`](#activate) &mdash; Executed every time the plugin is enabled.
- [`deactivate()`](#deactivate) &mdash; Executed every time the plugin is disabled.
- [`getVersion()`](#getVersion) &mdash; Returns the plugin version number.
- [`isTheme()`](#isTheme) &mdash; Returns true if this plugin is a theme, false if otherwise.
- [`getPluginName()`](#getPluginName) &mdash; Returns the plugin&#039;s base class name without the namespace, e.g., &quot;UserCountry&quot; when the plugin class is &quot;Piwik\Plugins\UserCountry\UserCountry&quot;.
- [`getPluginNameFromBacktrace()`](#getPluginNameFromBacktrace) &mdash; Extracts the plugin name from a backtrace array.

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$pluginName`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If plugin metadata is defined in both the getInformation() method and the plugin.json file.

### `getInformation()` <a name="getInformation"></a>

Returns the plugin details - &#039;description&#039; =&gt; string        // 1-2 sentence description of the plugin - &#039;author&#039; =&gt; string             // plugin author - &#039;author_homepage&#039; =&gt; string    // author homepage URL (or email &quot;mailto:youremail@example.org&quot;) - &#039;homepage&#039; =&gt; string           // plugin homepage URL - &#039;license&#039; =&gt; string            // plugin license - &#039;license_homepage&#039; =&gt; string   // license homepage URL - &#039;version&#039; =&gt; string            // plugin version number; examples and 3rd party plugins must not use Version::VERSION; 3rd party plugins must increment the version number with each plugin release - &#039;theme&#039; =&gt; bool                // Whether this plugin is a theme (a theme is a plugin, but a plugin is not necessarily a theme)

#### Signature

- It is a **public** method.
- It returns a(n) `array` value.

### `getListHooksRegistered()` <a name="getListHooksRegistered"></a>

Returns a list of hooks with associated event observers.

#### Signature

- It is a **public** method.
- _Returns:_ eg, array( &#039;API.getReportMetadata&#039; =&gt; &#039;myPluginFunction&#039;, &#039;Another.event&#039;         =&gt; array( &#039;function&#039; =&gt; &#039;myOtherPluginFunction&#039;, &#039;after&#039;    =&gt; true // execute after callbacks w/o ordering ) &#039;Yet.Another.event&#039;     =&gt; array( &#039;function&#039; =&gt; &#039;myOtherPluginFunction&#039;, &#039;before&#039;   =&gt; true // execute before callbacks w/o ordering ) )
    - `array`

### `postLoad()` <a name="postLoad"></a>

This method is executed after a plugin is loaded and translations are registered.

#### Description

Useful for initialization code that uses translated strings from the plugin.

#### Signature

- It is a **public** method.
- It does not return anything.

### `install()` <a name="install"></a>

Installs the plugin.

#### Description

Derived classes should implement this class if the plugin
needs to:
- create tables
- update existing tables
- etc.

#### Signature

- It is a **public** method.
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if installation of fails for some reason.

### `uninstall()` <a name="uninstall"></a>

Uninstalls the plugins.

#### Description

Derived classes should implement this class if the changes
made in [install](#install) should be undone during uninstallation.

In most cases, if you have an [install](#install) method, you should provide 
an [uninstall](#uninstall) method.

#### Signature

- It is a **public** method.
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if uninstallation of fails for some reason.

### `activate()` <a name="activate"></a>

Executed every time the plugin is enabled.

#### Signature

- It is a **public** method.
- It does not return anything.

### `deactivate()` <a name="deactivate"></a>

Executed every time the plugin is disabled.

#### Signature

- It is a **public** method.
- It does not return anything.

### `getVersion()` <a name="getVersion"></a>

Returns the plugin version number.

#### Signature

- It is a **public** method.
- It is a **finalized** method.
- It returns a(n) `string` value.

### `isTheme()` <a name="isTheme"></a>

Returns true if this plugin is a theme, false if otherwise.

#### Signature

- It is a **public** method.
- It is a **finalized** method.
- It returns a(n) `bool` value.

### `getPluginName()` <a name="getPluginName"></a>

Returns the plugin&#039;s base class name without the namespace, e.g., &quot;UserCountry&quot; when the plugin class is &quot;Piwik\Plugins\UserCountry\UserCountry&quot;.

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

