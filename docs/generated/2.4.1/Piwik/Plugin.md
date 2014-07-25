<small>Piwik\</small>

Plugin
======

Base class of all Plugin Descriptor classes.

Any plugin that wants to add event observers to one of Piwik's [hooks](/api-reference/events##),
or has special installation/uninstallation logic must implement this class.
Plugins that can specify everything they need to in the _plugin.json_ files,
such as themes, don't need to implement this class.

Class implementations should be named after the plugin they are a part of
(eg, `class UserCountry extends Plugin`).

### Plugin Metadata

In addition to providing a place for plugins to install/uninstall themselves
and add event observers, this class is also responsible for loading metadata
found in the plugin.json file.

The plugin.json file must exist in the root directory of a plugin. It can
contain the following information:

- **description**: An internationalized string description of what the plugin
                   does.
- **homepage**: The URL to the plugin's website.
- **authors**: A list of author arrays with keys for 'name', 'email' and 'homepage'
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
                'API.getReportMetadata' => 'getReportMetadata',
                'Another.event'         => array(
                                               'function' => 'myOtherPluginFunction',
                                               'after'    => true // executes this callback after others
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
        
        public function getReportMetadata(&$metadata)
        {
            // ...
        }

        public function myOtherPluginFunction()
        {
            // ...
        }
    }

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getInformation()`](#getinformation) &mdash; Returns plugin information, including:  - 'description' => string        // 1-2 sentence description of the plugin - 'author' => string             // plugin author - 'author_homepage' => string    // author homepage URL (or email "mailto:youremail@example.org") - 'homepage' => string           // plugin homepage URL - 'license' => string            // plugin license - 'license_homepage' => string   // license homepage URL - 'version' => string            // plugin version number; examples and 3rd party plugins must not use Version::VERSION; 3rd party plugins must increment the version number with each plugin release - 'theme' => bool                // Whether this plugin is a theme (a theme is a plugin, but a plugin is not necessarily a theme)
- [`getListHooksRegistered()`](#getlisthooksregistered) &mdash; Returns a list of hooks with associated event observers.
- [`postLoad()`](#postload) &mdash; This method is executed after a plugin is loaded and translations are registered.
- [`install()`](#install) &mdash; Installs the plugin.
- [`uninstall()`](#uninstall) &mdash; Uninstalls the plugins.
- [`activate()`](#activate) &mdash; Executed every time the plugin is enabled.
- [`deactivate()`](#deactivate) &mdash; Executed every time the plugin is disabled.
- [`getVersion()`](#getversion) &mdash; Returns the plugin version number.
- [`isTheme()`](#istheme) &mdash; Returns `true` if this plugin is a theme, `false` if otherwise.
- [`getPluginName()`](#getpluginname) &mdash; Returns the plugin's base class name without the namespace, e.g., `"UserCountry"` when the plugin class is `"Piwik\Plugins\UserCountry\UserCountry"`.
- [`findComponent()`](#findcomponent) &mdash; Tries to find a component such as a Menu or Tasks within this plugin.
- [`hasMissingDependencies()`](#hasmissingdependencies) &mdash; Detect whether there are any missing dependencies.
- [`getMissingDependencies()`](#getmissingdependencies)
- [`getPluginNameFromBacktrace()`](#getpluginnamefrombacktrace) &mdash; Extracts the plugin name from a backtrace array.
- [`getPluginNameFromNamespace()`](#getpluginnamefromnamespace) &mdash; Extracts the plugin name from a namespace name or a fully qualified class name.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()` 
Constructor.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$pluginName` (`string`|`bool`) &mdash;

      <div markdown="1" class="param-desc"> A plugin name to force. If not supplied, it is set to the last part of the class name.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If plugin metadata is defined in both the getInformation() method and the **plugin.json** file.

<a name="getinformation" id="getinformation"></a>
<a name="getInformation" id="getInformation"></a>
### `getInformation()` 
Returns plugin information, including:  - 'description' => string        // 1-2 sentence description of the plugin - 'author' => string             // plugin author - 'author_homepage' => string    // author homepage URL (or email "mailto:youremail@example.org") - 'homepage' => string           // plugin homepage URL - 'license' => string            // plugin license - 'license_homepage' => string   // license homepage URL - 'version' => string            // plugin version number; examples and 3rd party plugins must not use Version::VERSION; 3rd party plugins must increment the version number with each plugin release - 'theme' => bool                // Whether this plugin is a theme (a theme is a plugin, but a plugin is not necessarily a theme)

#### Signature

- It returns a `array` value.

<a name="getlisthooksregistered" id="getlisthooksregistered"></a>
<a name="getListHooksRegistered" id="getListHooksRegistered"></a>
### `getListHooksRegistered()` 
Returns a list of hooks with associated event observers.

Derived classes should use this method to associate callbacks with events.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">eg, array( 'API.getReportMetadata' => 'myPluginFunction', 'Another.event'         => array( 'function' => 'myOtherPluginFunction', 'after'    => true // execute after callbacks w/o ordering ) 'Yet.Another.event'     => array( 'function' => 'myOtherPluginFunction', 'before'   => true // execute before callbacks w/o ordering ) )</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="postload" id="postload"></a>
<a name="postLoad" id="postLoad"></a>
### `postLoad()` 
This method is executed after a plugin is loaded and translations are registered.

Useful for initialization code that uses translated strings.

#### Signature

- It does not return anything.

<a name="install" id="install"></a>
<a name="install" id="install"></a>
### `install()` 
Installs the plugin.

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

Derived classes should implement this method if the changes
made in [install()](/api-reference/Piwik/Plugin#install) need to be undone during uninstallation.

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
Returns `true` if this plugin is a theme, `false` if otherwise.

#### Signature

- It returns a `bool` value.

<a name="getpluginname" id="getpluginname"></a>
<a name="getPluginName" id="getPluginName"></a>
### `getPluginName()` 
Returns the plugin's base class name without the namespace, e.g., `"UserCountry"` when the plugin class is `"Piwik\Plugins\UserCountry\UserCountry"`.

#### Signature

- It is a **finalized** method.
- It returns a `string` value.

<a name="findcomponent" id="findcomponent"></a>
<a name="findComponent" id="findComponent"></a>
### `findComponent()` 
Tries to find a component such as a Menu or Tasks within this plugin.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$componentName` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The name of the component you want to look for. In case you request a component named 'Menu' it'll look for a file named 'Menu.php' within the root of the plugin folder that implements a class named Piwik\Plugin\$PluginName\Menu . If such a file exists but does not implement this class it'll silently ignored.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$expectedSubclass` (`string`) &mdash;

      <div markdown="1" class="param-desc"> If not empty, a check will be performed whether a found file extends the given subclass. If the requested file exists but does not extend this class a warning will be shown to advice a developer to extend this certain class.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  ([`stdClass`](http://php.net/class.stdClass)|`null`) &mdash;
    <div markdown="1" class="param-desc">Null if the requested component does not exist or an instance of the found component.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="hasmissingdependencies" id="hasmissingdependencies"></a>
<a name="hasMissingDependencies" id="hasMissingDependencies"></a>
### `hasMissingDependencies()` 
Detect whether there are any missing dependencies.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$piwikVersion` (`null`) &mdash;

      <div markdown="1" class="param-desc"> Defaults to the current Piwik version</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `bool` value.

<a name="getmissingdependencies" id="getmissingdependencies"></a>
<a name="getMissingDependencies" id="getMissingDependencies"></a>
### `getMissingDependencies()` 
#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$piwikVersion`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="getpluginnamefrombacktrace" id="getpluginnamefrombacktrace"></a>
<a name="getPluginNameFromBacktrace" id="getPluginNameFromBacktrace"></a>
### `getPluginNameFromBacktrace()` 
Extracts the plugin name from a backtrace array.

Returns `false` if we can't find one.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$backtrace` (`array`) &mdash;

      <div markdown="1" class="param-desc"> The result of [debug_backtrace()](http://php.net/function.debug_backtrace()) or [Exception::getTrace()](http://www.php.net/manual/en/exception.gettrace.php).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`|`Piwik\false`) &mdash;
    <div markdown="1" class="param-desc"></div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getpluginnamefromnamespace" id="getpluginnamefromnamespace"></a>
<a name="getPluginNameFromNamespace" id="getPluginNameFromNamespace"></a>
### `getPluginNameFromNamespace()` 
Extracts the plugin name from a namespace name or a fully qualified class name.

Returns `false`
if we can't find one.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$namespaceOrClassName` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The namespace or class string.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`|`Piwik\false`) &mdash;
    <div markdown="1" class="param-desc"></div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

