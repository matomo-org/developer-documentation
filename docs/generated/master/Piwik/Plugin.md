<small>Piwik</small>

Plugin
======

Base class of all Plugin Descriptor classes.

Description
-----------

Any plugin that wants to add event observers to one of Piwik's [hooks](/api-reference/hooks##),
or has special installation/uninstallation logic must implement this class.
Plugins that can specify everything they need to in the _plugin.json_ files,
such as themes, don't need to implement this class.

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
- **homepage**: The URL to the plugin's website.
- **author**: Author name.
- **author_homepage**: The URL to the author's website.
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
                'API.getReportMetadata' => 'myPluginFunction',
                'Another.event'         => array(
                                               'function' => 'myOtherPluginFunction',
                                               'after'    => true // execute after callbacks w/o ordering
                                           )
            );
        }

        public function install()
        {
            Db::exec("CREATE TABLE " . Common::prefixTable('mytable') . "...");
        }

        public function uninstall()
        {
            Db::exec("DROP TABLE IF EXISTS " . Common::prefixTable('mytable'));
        }
    }

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getInformation()`](#getinformation) &mdash; Returns the plugin details - 'description' => string        // 1-2 sentence description of the plugin - 'author' => string             // plugin author - 'author_homepage' => string    // author homepage URL (or email "mailto:youremail@example.org") - 'homepage' => string           // plugin homepage URL - 'license' => string            // plugin license - 'license_homepage' => string   // license homepage URL - 'version' => string            // plugin version number; examples and 3rd party plugins must not use Version::VERSION; 3rd party plugins must increment the version number with each plugin release - 'theme' => bool                // Whether this plugin is a theme (a theme is a plugin, but a plugin is not necessarily a theme)
- [`getListHooksRegistered()`](#getlisthooksregistered) &mdash; Returns a list of hooks with associated event observers.
- [`postLoad()`](#postload) &mdash; This method is executed after a plugin is loaded and translations are registered.
- [`install()`](#install) &mdash; Installs the plugin.
- [`uninstall()`](#uninstall) &mdash; Uninstalls the plugins.
- [`activate()`](#activate) &mdash; Executed every time the plugin is enabled.
- [`deactivate()`](#deactivate) &mdash; Executed every time the plugin is disabled.
- [`getVersion()`](#getversion) &mdash; Returns the plugin version number.
- [`isTheme()`](#istheme) &mdash; Returns true if this plugin is a theme, false if otherwise.
- [`getPluginName()`](#getpluginname) &mdash; Returns the plugin's base class name without the namespace, e.g., "UserCountry" when the plugin class is "Piwik\Plugins\UserCountry\UserCountry".
- [`getPluginNameFromBacktrace()`](#getpluginnamefrombacktrace) &mdash; Extracts the plugin name from a backtrace array.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$pluginName` (`string`|`bool`) &mdash; A plugin name to force. If not supplied, it is set to the last part of the class name.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If plugin metadata is defined in both the getInformation() method and the plugin.json file.

<a name="getinformation" id="getinformation"></a>
<a name="getInformation" id="getInformation"></a>
### `getInformation()`

Returns the plugin details - 'description' => string        // 1-2 sentence description of the plugin - 'author' => string             // plugin author - 'author_homepage' => string    // author homepage URL (or email "mailto:youremail@example.org") - 'homepage' => string           // plugin homepage URL - 'license' => string            // plugin license - 'license_homepage' => string   // license homepage URL - 'version' => string            // plugin version number; examples and 3rd party plugins must not use Version::VERSION; 3rd party plugins must increment the version number with each plugin release - 'theme' => bool                // Whether this plugin is a theme (a theme is a plugin, but a plugin is not necessarily a theme)

#### Signature

- It returns a `array` value.

<a name="getlisthooksregistered" id="getlisthooksregistered"></a>
<a name="getListHooksRegistered" id="getListHooksRegistered"></a>
### `getListHooksRegistered()`

Returns a list of hooks with associated event observers.

#### Signature

- _Returns:_ eg, array( 'API.getReportMetadata' => 'myPluginFunction', 'Another.event'         => array( 'function' => 'myOtherPluginFunction', 'after'    => true // execute after callbacks w/o ordering ) 'Yet.Another.event'     => array( 'function' => 'myOtherPluginFunction', 'before'   => true // execute before callbacks w/o ordering ) )
    - `array`

<a name="postload" id="postload"></a>
<a name="postLoad" id="postLoad"></a>
### `postLoad()`

This method is executed after a plugin is loaded and translations are registered.

#### Description

Useful for initialization code that uses translated strings from the plugin.

#### Signature

- It does not return anything.

<a name="install" id="install"></a>
<a name="install" id="install"></a>
### `install()`

Installs the plugin.

#### Description

Derived classes should implement this class if the plugin
needs to:
- create tables
- update existing tables
- etc.

#### Signature

- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if installation of fails for some reason.

<a name="uninstall" id="uninstall"></a>
<a name="uninstall" id="uninstall"></a>
### `uninstall()`

Uninstalls the plugins.

#### Description

Derived classes should implement this class if the changes
made in [install()](/api-reference/Piwik/Plugin#install) should be undone during uninstallation.

In most cases, if you have an [install()](/api-reference/Piwik/Plugin#install) method, you should provide
an [uninstall()](/api-reference/Piwik/Plugin#uninstall) method.

#### Signature

- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if uninstallation of fails for some reason.

<a name="activate" id="activate"></a>
<a name="activate" id="activate"></a>
### `activate()`

Executed every time the plugin is enabled.

#### Signature

- It does not return anything.

<a name="deactivate" id="deactivate"></a>
<a name="deactivate" id="deactivate"></a>
### `deactivate()`

Executed every time the plugin is disabled.

#### Signature

- It does not return anything.

<a name="getversion" id="getversion"></a>
<a name="getVersion" id="getVersion"></a>
### `getVersion()`

Returns the plugin version number.

#### Signature

- It is a **finalized** method.
- It returns a `string` value.

<a name="istheme" id="istheme"></a>
<a name="isTheme" id="isTheme"></a>
### `isTheme()`

Returns true if this plugin is a theme, false if otherwise.

#### Signature

- It is a **finalized** method.
- It returns a `bool` value.

<a name="getpluginname" id="getpluginname"></a>
<a name="getPluginName" id="getPluginName"></a>
### `getPluginName()`

Returns the plugin's base class name without the namespace, e.g., "UserCountry" when the plugin class is "Piwik\Plugins\UserCountry\UserCountry".

#### Signature

- It is a **finalized** method.
- It returns a `string` value.

<a name="getpluginnamefrombacktrace" id="getpluginnamefrombacktrace"></a>
<a name="getPluginNameFromBacktrace" id="getPluginNameFromBacktrace"></a>
### `getPluginNameFromBacktrace()`

Extracts the plugin name from a backtrace array.

#### Description

Returns false if we can't find one.

#### Signature

- It accepts the following parameter(s):
    - `$backtrace` (`array`) &mdash; The result of the debug_backtrace() or Exception::getTrace().
- It can return one of the following values:
    - `string`
    - `Piwik\false`

