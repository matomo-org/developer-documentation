<small>Piwik\Plugins\DevicePlugins\</small>

DevicePlugins
=============

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor. Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`reloadPluginInformation()`](#reloadplugininformation) Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`getInformation()`](#getinformation) &mdash; Returns plugin information, including: Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`isPremiumFeature()`](#ispremiumfeature) Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`registerEvents()`](#registerevents) &mdash; Returns a list of events with associated event observers. Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`postLoad()`](#postload) &mdash; This method is executed after a plugin is loaded and translations are registered. Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`requiresInternetConnection()`](#requiresinternetconnection) &mdash; Defines whether the whole plugin requires a working internet connection If set to true, the plugin will be automatically unloaded if `enable_internet_features` is 0, even if the plugin is activated Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`install()`](#install) &mdash; Installs the plugin. Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`uninstall()`](#uninstall) &mdash; Uninstalls the plugins. Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`activate()`](#activate) &mdash; Executed every time the plugin is enabled. Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`deactivate()`](#deactivate) &mdash; Executed every time the plugin is disabled. Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`getVersion()`](#getversion) &mdash; Returns the plugin version number. Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`isTheme()`](#istheme) &mdash; Returns `true` if this plugin is a theme, `false` if otherwise. Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`getPluginName()`](#getpluginname) &mdash; Returns the plugin's base class name without the namespace, e.g., `"UserCountry"` when the plugin class is `"Piwik\Plugins\UserCountry\UserCountry"`. Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`findComponent()`](#findcomponent) &mdash; Tries to find a component such as a Menu or Tasks within this plugin. Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`findMultipleComponents()`](#findmultiplecomponents) Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`hasMissingDependencies()`](#hasmissingdependencies) &mdash; Detect whether there are any missing dependencies. Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`getMissingDependencies()`](#getmissingdependencies) Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`getMissingDependenciesAsString()`](#getmissingdependenciesasstring) &mdash; Returns a string (translated) describing the missing requirements for this plugin and the given Piwik version Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`getPluginNameFromBacktrace()`](#getpluginnamefrombacktrace) &mdash; Extracts the plugin name from a backtrace array. Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`getPluginNameFromNamespace()`](#getpluginnamefromnamespace) &mdash; Extracts the plugin name from a namespace name or a fully qualified class name. Inherited from [`Plugin`](../../../Piwik/Plugin.md)
- [`getAllDevicePluginsColumnClasses()`](#getalldevicepluginscolumnclasses) &mdash; Returns class names of all DevicePlugins Column classes.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$pluginName` (`string`|`bool`) &mdash;
       A plugin name to force. If not supplied, it is set to the last part of the class name.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If plugin metadata is defined in both the getInformation() method
                   and the **plugin.json** file.

<a name="reloadplugininformation" id="reloadplugininformation"></a>
<a name="reloadPluginInformation" id="reloadPluginInformation"></a>
### `reloadPluginInformation()`

#### Signature

- It does not return anything or a mixed result.

<a name="getinformation" id="getinformation"></a>
<a name="getInformation" id="getInformation"></a>
### `getInformation()`

Returns plugin information, including:

- 'description' => string        // 1-2 sentence description of the plugin
- 'author' => string             // plugin author
- 'author_homepage' => string    // author homepage URL (or email "mailto:youremail@example.org")
- 'homepage' => string           // plugin homepage URL
- 'license' => string            // plugin license
- 'version' => string            // plugin version number; examples and 3rd party plugins must not use Version::VERSION; 3rd party plugins must increment the version number with each plugin release
- 'theme' => bool                // Whether this plugin is a theme (a theme is a plugin, but a plugin is not necessarily a theme)

#### Signature

- It returns a `array` value.

<a name="ispremiumfeature" id="ispremiumfeature"></a>
<a name="isPremiumFeature" id="isPremiumFeature"></a>
### `isPremiumFeature()`

#### Signature

- It is a **finalized** method.
- It does not return anything or a mixed result.

<a name="registerevents" id="registerevents"></a>
<a name="registerEvents" id="registerEvents"></a>
### `registerEvents()`

Since Matomo 2.15.0

Returns a list of events with associated event observers.

Derived classes should use this method to associate callbacks with events.

#### Signature


- *Returns:*  `array` &mdash;
    eg,

                  array(
                      'API.getReportMetadata' => 'myPluginFunction',
                      'Another.event'         => array(
                                                     'function' => 'myOtherPluginFunction',
                                                     'after'    => true // execute after callbacks w/o ordering
                                                 )
                      'Yet.Another.event'     => array(
                                                     'function' => 'myOtherPluginFunction',
                                                     'before'   => true // execute before callbacks w/o ordering
                                                 )
                  )

<a name="postload" id="postload"></a>
<a name="postLoad" id="postLoad"></a>
### `postLoad()`

This method is executed after a plugin is loaded and translations are registered.

Useful for initialization code that uses translated strings.

#### Signature

- It does not return anything or a mixed result.

<a name="requiresinternetconnection" id="requiresinternetconnection"></a>
<a name="requiresInternetConnection" id="requiresInternetConnection"></a>
### `requiresInternetConnection()`

Defines whether the whole plugin requires a working internet connection
If set to true, the plugin will be automatically unloaded if `enable_internet_features` is 0,
even if the plugin is activated

#### Signature

- It returns a `bool` value.

<a name="install" id="install"></a>
<a name="install" id="install"></a>
### `install()`

Installs the plugin. Derived classes should implement this class if the plugin
needs to:

- create tables
- update existing tables
- etc.

#### Signature

- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if installation of fails for some reason.

<a name="uninstall" id="uninstall"></a>
<a name="uninstall" id="uninstall"></a>
### `uninstall()`

Uninstalls the plugins. Derived classes should implement this method if the changes
made in [install()](/api-reference/Piwik/Plugins/DevicePlugins/DevicePlugins#install) need to be undone during uninstallation.

In most cases, if you have an [install()](/api-reference/Piwik/Plugins/DevicePlugins/DevicePlugins#install) method, you should provide
an [uninstall()](/api-reference/Piwik/Plugins/DevicePlugins/DevicePlugins#uninstall) method.

#### Signature

- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if uninstallation of fails for some reason.

<a name="activate" id="activate"></a>
<a name="activate" id="activate"></a>
### `activate()`

Executed every time the plugin is enabled.

#### Signature

- It does not return anything or a mixed result.

<a name="deactivate" id="deactivate"></a>
<a name="deactivate" id="deactivate"></a>
### `deactivate()`

Executed every time the plugin is disabled.

#### Signature

- It does not return anything or a mixed result.

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

Returns the plugin's base class name without the namespace,
e.g., `"UserCountry"` when the plugin class is `"Piwik\Plugins\UserCountry\UserCountry"`.

#### Signature

- It is a **finalized** method.
- It returns a `string` value.

<a name="findcomponent" id="findcomponent"></a>
<a name="findComponent" id="findComponent"></a>
### `findComponent()`

Tries to find a component such as a Menu or Tasks within this plugin.

#### Signature

-  It accepts the following parameter(s):
    - `$componentName` (`string`) &mdash;
       The name of the component you want to look for. In case you request a component named 'Menu' it'll look for a file named 'Menu.php' within the root of the plugin folder that implements a class named Piwik\Plugin\$PluginName\Menu . If such a file exists but does not implement this class it'll silently ignored.
    - `$expectedSubclass` (`string`) &mdash;
       If not empty, a check will be performed whether a found file extends the given subclass. If the requested file exists but does not extend this class a warning will be shown to advice a developer to extend this certain class.

- *Returns:*  `string`|`null` &mdash;
    Null if the requested component does not exist or an instance of the found
                        component.

<a name="findmultiplecomponents" id="findmultiplecomponents"></a>
<a name="findMultipleComponents" id="findMultipleComponents"></a>
### `findMultipleComponents()`

#### Signature

-  It accepts the following parameter(s):
    - `$directoryWithinPlugin`
      
    - `$expectedSubclass`
      
- It does not return anything or a mixed result.

<a name="hasmissingdependencies" id="hasmissingdependencies"></a>
<a name="hasMissingDependencies" id="hasMissingDependencies"></a>
### `hasMissingDependencies()`

Detect whether there are any missing dependencies.

#### Signature

-  It accepts the following parameter(s):
    - `$piwikVersion` (`null`) &mdash;
       Defaults to the current Piwik version
- It returns a `bool` value.

<a name="getmissingdependencies" id="getmissingdependencies"></a>
<a name="getMissingDependencies" id="getMissingDependencies"></a>
### `getMissingDependencies()`

#### Signature

-  It accepts the following parameter(s):
    - `$piwikVersion`
      
- It does not return anything or a mixed result.

<a name="getmissingdependenciesasstring" id="getmissingdependenciesasstring"></a>
<a name="getMissingDependenciesAsString" id="getMissingDependenciesAsString"></a>
### `getMissingDependenciesAsString()`

Returns a string (translated) describing the missing requirements for this plugin and the given Piwik version

#### Signature

-  It accepts the following parameter(s):
    - `$piwikVersion` (`string`) &mdash;
      

- *Returns:*  `string` &mdash;
    "AnonymousPiwikUsageMeasurement requires PIWIK >=3.0.0"

<a name="getpluginnamefrombacktrace" id="getpluginnamefrombacktrace"></a>
<a name="getPluginNameFromBacktrace" id="getPluginNameFromBacktrace"></a>
### `getPluginNameFromBacktrace()`

Extracts the plugin name from a backtrace array. Returns `false` if we can't find one.

#### Signature

-  It accepts the following parameter(s):
    - `$backtrace` (`array`) &mdash;
       The result of [debug_backtrace()](http://php.net/function.debug_backtrace()) or [Exception::getTrace()](http://www.php.net/manual/en/exception.gettrace.php).

- *Returns:*  `string`|`false` &mdash;
    

<a name="getpluginnamefromnamespace" id="getpluginnamefromnamespace"></a>
<a name="getPluginNameFromNamespace" id="getPluginNameFromNamespace"></a>
### `getPluginNameFromNamespace()`

Extracts the plugin name from a namespace name or a fully qualified class name. Returns `false`
if we can't find one.

#### Signature

-  It accepts the following parameter(s):
    - `$namespaceOrClassName` (`string`) &mdash;
       The namespace or class string.

- *Returns:*  `string`|`false` &mdash;
    

<a name="getalldevicepluginscolumnclasses" id="getalldevicepluginscolumnclasses"></a>
<a name="getAllDevicePluginsColumnClasses" id="getAllDevicePluginsColumnClasses"></a>
### `getAllDevicePluginsColumnClasses()`

Returns class names of all DevicePlugins Column classes.

#### Signature

- It returns a `string[]` value.

