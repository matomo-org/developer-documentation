<small>Piwik\Plugin</small>

Manager
=======

The singleton that manages plugin loading/unloading and installation/uninstallation.


Constants
---------

This class defines the following constants:

- [`DEFAULT_THEME`](#DEFAULT_THEME) &mdash; Default theme used in Piwik.
- [`TRACKER_EVENT_PREFIX`](#TRACKER_EVENT_PREFIX)

Methods
-------

The class defines the following methods:

- [`isPluginActivated()`](#isPluginActivated) &mdash; Returns true if a plugin has been activated.
- [`isPluginLoaded()`](#isPluginLoaded) &mdash; Returns true if plugin is loaded (in memory).
- [`getThemeEnabled()`](#getThemeEnabled) &mdash; Returns the non default theme currently enabled.
- [`returnLoadedPluginsInfo()`](#returnLoadedPluginsInfo) &mdash; Returns info regarding all plugins.
- [`getInstalledPluginsName()`](#getInstalledPluginsName) &mdash; Return list of names of installed plugins.
- [`getMissingPlugins()`](#getMissingPlugins) &mdash; Returns names of plugins that should be loaded, but cannot be since their files cannot be found.

<a name="ispluginactivated" id="ispluginactivated"></a>
### `isPluginActivated()`

Returns true if a plugin has been activated.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- It returns a(n) `bool` value.

<a name="ispluginloaded" id="ispluginloaded"></a>
### `isPluginLoaded()`

Returns true if plugin is loaded (in memory).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- It returns a(n) `bool` value.

<a name="getthemeenabled" id="getthemeenabled"></a>
### `getThemeEnabled()`

Returns the non default theme currently enabled.

#### Description

If Zeitgeist is enabled, returns false (Zeitgeist cannot be disabled).

#### Signature

- It is a **public** method.
- It returns a(n) [`Plugin`](../../Piwik/Plugin.md) value.

<a name="returnloadedpluginsinfo" id="returnloadedpluginsinfo"></a>
### `returnLoadedPluginsInfo()`

Returns info regarding all plugins.

#### Description

Loads plugins that can be loaded.

#### Signature

- It is a **public** method.
- _Returns:_ An array that maps plugin names with arrays of plugin info. Plugin info arrays will contain the following entries: - **activated**: Whether the plugin is activated. - **alwaysActivated**: Whether the plugin should always be activated, or not. - **uninstallable**: Whether the plugin is uninstallable or not. - **invalid**: If the plugin is invalid, this property will be set to true. If the plugin is not invalid, this property will not exist. - **info**: If the plugin was loaded, will hold the plugin information. See [Plugin::getInformation](#).
    - `array`

<a name="getinstalledpluginsname" id="getinstalledpluginsname"></a>
### `getInstalledPluginsName()`

Return list of names of installed plugins.

#### Signature

- It is a **public** method.
- It returns a(n) `array` value.

<a name="getmissingplugins" id="getmissingplugins"></a>
### `getMissingPlugins()`

Returns names of plugins that should be loaded, but cannot be since their files cannot be found.

#### Signature

- It is a **public** method.
- It returns a(n) `array` value.

