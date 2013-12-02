<small>Piwik\Plugin</small>

Manager
=======

The singleton that manages plugin loading/unloading and installation/uninstallation.

Methods
-------

The class defines the following methods:

- [`isPluginActivated()`](#ispluginactivated) &mdash; Returns true if a plugin has been activated.
- [`isPluginLoaded()`](#ispluginloaded) &mdash; Returns true if plugin is loaded (in memory).
- [`getThemeEnabled()`](#getthemeenabled) &mdash; Returns the theme currently enabled.
- [`returnLoadedPluginsInfo()`](#returnloadedpluginsinfo) &mdash; Returns info regarding all plugins.
- [`getInstalledPluginsName()`](#getinstalledpluginsname) &mdash; Return list of names of installed plugins.
- [`getMissingPlugins()`](#getmissingplugins) &mdash; Returns names of plugins that should be loaded, but cannot be since their files cannot be found.

<a name="ispluginactivated" id="ispluginactivated"></a>
<a name="isPluginActivated" id="isPluginActivated"></a>
### `isPluginActivated()`

Returns true if a plugin has been activated.

#### Signature

- It accepts the following parameter(s):
    - `$name` (`string`) &mdash; Name of plugin, eg, `'Actions'`.
- It returns a `bool` value.

<a name="ispluginloaded" id="ispluginloaded"></a>
<a name="isPluginLoaded" id="isPluginLoaded"></a>
### `isPluginLoaded()`

Returns true if plugin is loaded (in memory).

#### Signature

- It accepts the following parameter(s):
    - `$name` (`string`) &mdash; Name of plugin, eg, `'Acions'`.
- It returns a `bool` value.

<a name="getthemeenabled" id="getthemeenabled"></a>
<a name="getThemeEnabled" id="getThemeEnabled"></a>
### `getThemeEnabled()`

Returns the theme currently enabled.

#### Description

If no theme is enabled, Zeitgeist is returned (default theme)

#### Signature

- It returns a [`Plugin`](../../Piwik/Plugin.md) value.

<a name="returnloadedpluginsinfo" id="returnloadedpluginsinfo"></a>
<a name="returnLoadedPluginsInfo" id="returnLoadedPluginsInfo"></a>
### `returnLoadedPluginsInfo()`

Returns info regarding all plugins.

#### Description

Loads plugins that can be loaded.

#### Signature

- _Returns:_ An array that maps plugin names with arrays of plugin info. Plugin info arrays will contain the following entries: - **activated**: Whether the plugin is activated. - **alwaysActivated**: Whether the plugin should always be activated, or not. - **uninstallable**: Whether the plugin is uninstallable or not. - **invalid**: If the plugin is invalid, this property will be set to true. If the plugin is not invalid, this property will not exist. - **info**: If the plugin was loaded, will hold the plugin information. See {@link Piwik\Plugin::getInformation()}.
    - `array`

<a name="getinstalledpluginsname" id="getinstalledpluginsname"></a>
<a name="getInstalledPluginsName" id="getInstalledPluginsName"></a>
### `getInstalledPluginsName()`

Return list of names of installed plugins.

#### Signature

- It returns a `array` value.

<a name="getmissingplugins" id="getmissingplugins"></a>
<a name="getMissingPlugins" id="getMissingPlugins"></a>
### `getMissingPlugins()`

Returns names of plugins that should be loaded, but cannot be since their files cannot be found.

#### Signature

- It returns a `array` value.

