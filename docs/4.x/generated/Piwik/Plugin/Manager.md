<small>Piwik\Plugin\</small>

Manager
=======

The singleton that manages plugin loading/unloading and installation/uninstallation.

Methods
-------

The class defines the following methods:

- [`isPluginActivated()`](#ispluginactivated) &mdash; Returns `true` if a plugin has been activated.
- [`isPluginLoaded()`](#ispluginloaded) &mdash; Returns `true` if plugin is loaded (in memory).
- [`getPluginsDirectories()`](#getpluginsdirectories) &mdash; Returns the path to all plugins directories.
- [`getPluginDirectory()`](#getplugindirectory) &mdash; Gets the path to a specific plugin.
- [`getThemeEnabled()`](#getthemeenabled) &mdash; Returns the currently enabled theme.
- [`loadAllPluginsAndGetTheirInfo()`](#loadallpluginsandgettheirinfo) &mdash; Returns info regarding all plugins.
- [`getInstalledPluginsName()`](#getinstalledpluginsname) &mdash; Return names of all installed plugins.
- [`getMissingPlugins()`](#getmissingplugins) &mdash; Returns names of plugins that should be loaded, but cannot be since their files cannot be found.

<a name="ispluginactivated" id="ispluginactivated"></a>
<a name="isPluginActivated" id="isPluginActivated"></a>
### `isPluginActivated()`

Returns `true` if a plugin has been activated.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       Name of plugin, eg, `'Actions'`.
- It returns a `bool` value.

<a name="ispluginloaded" id="ispluginloaded"></a>
<a name="isPluginLoaded" id="isPluginLoaded"></a>
### `isPluginLoaded()`

Returns `true` if plugin is loaded (in memory).

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       Name of plugin, eg, `'Acions'`.
- It returns a `bool` value.

<a name="getpluginsdirectories" id="getpluginsdirectories"></a>
<a name="getPluginsDirectories" id="getPluginsDirectories"></a>
### `getPluginsDirectories()`

Returns the path to all plugins directories. Each plugins directory may contain several plugins.

All paths have a trailing slash '/'.

#### Signature

- It returns a `string[]` value.

<a name="getplugindirectory" id="getplugindirectory"></a>
<a name="getPluginDirectory" id="getPluginDirectory"></a>
### `getPluginDirectory()`

Gets the path to a specific plugin. If the plugin does not exist in any plugins folder, the default plugins
folder will be assumed.

#### Signature

-  It accepts the following parameter(s):
    - `$pluginName`
      

- *Returns:*  `mixed`|`string` &mdash;
    

<a name="getthemeenabled" id="getthemeenabled"></a>
<a name="getThemeEnabled" id="getThemeEnabled"></a>
### `getThemeEnabled()`

Returns the currently enabled theme.

If no theme is enabled, the **Morpheus** plugin is returned (this is the base and default theme).

#### Signature

- It returns a `Stmt_Namespace\Plugin` value.

<a name="loadallpluginsandgettheirinfo" id="loadallpluginsandgettheirinfo"></a>
<a name="loadAllPluginsAndGetTheirInfo" id="loadAllPluginsAndGetTheirInfo"></a>
### `loadAllPluginsAndGetTheirInfo()`

Returns info regarding all plugins. Loads plugins that can be loaded.

#### Signature


- *Returns:*  `array` &mdash;
    An array that maps plugin names with arrays of plugin information. Plugin
              information consists of the following entries:

              - **activated**: Whether the plugin is activated.
              - **alwaysActivated**: Whether the plugin should always be activated,
                                     or not.
              - **uninstallable**: Whether the plugin is uninstallable or not.
              - **invalid**: If the plugin is invalid, this property will be set to true.
                             If the plugin is not invalid, this property will not exist.
              - **info**: If the plugin was loaded, will hold the plugin information.
                          See [Plugin::getInformation()](/api-reference/Piwik/Plugin#getinformation).

<a name="getinstalledpluginsname" id="getinstalledpluginsname"></a>
<a name="getInstalledPluginsName" id="getInstalledPluginsName"></a>
### `getInstalledPluginsName()`

Return names of all installed plugins.

#### Signature

- It returns a `array` value.

<a name="getmissingplugins" id="getmissingplugins"></a>
<a name="getMissingPlugins" id="getMissingPlugins"></a>
### `getMissingPlugins()`

Returns names of plugins that should be loaded, but cannot be since their
files cannot be found.

#### Signature

- It returns a `array` value.

