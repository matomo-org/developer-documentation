<small>Piwik\Plugin\</small>

Manager
=======

The singleton that manages plugin loading/unloading and installation/uninstallation.

Methods
-------

The class defines the following methods:

- [`getInstance()`](#getinstance) &mdash; Returns the singleton instance for the derived class.
- [`isPluginActivated()`](#ispluginactivated) &mdash; Returns `true` if a plugin has been activated.
- [`isPluginLoaded()`](#ispluginloaded) &mdash; Returns `true` if plugin is loaded (in memory).
- [`getThemeEnabled()`](#getthemeenabled) &mdash; Returns the currently enabled theme.
- [`returnLoadedPluginsInfo()`](#returnloadedpluginsinfo) &mdash; Returns info regarding all plugins.
- [`getInstalledPluginsName()`](#getinstalledpluginsname) &mdash; Return names of all installed plugins.
- [`getMissingPlugins()`](#getmissingplugins) &mdash; Returns names of plugins that should be loaded, but cannot be since their files cannot be found.

<a name="getinstance" id="getinstance"></a>
<a name="getInstance" id="getInstance"></a>
### `getInstance()`

Returns the singleton instance for the derived class.

If the singleton instance
has not been created, this method will create it.

#### Signature

- It returns a [`Singleton`](../../Piwik/Singleton.md) value.

<a name="ispluginactivated" id="ispluginactivated"></a>
<a name="isPluginActivated" id="isPluginActivated"></a>
### `isPluginActivated()`

Returns `true` if a plugin has been activated.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Name of plugin, eg, `'Actions'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `bool` value.

<a name="ispluginloaded" id="ispluginloaded"></a>
<a name="isPluginLoaded" id="isPluginLoaded"></a>
### `isPluginLoaded()`

Returns `true` if plugin is loaded (in memory).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Name of plugin, eg, `'Acions'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `bool` value.

<a name="getthemeenabled" id="getthemeenabled"></a>
<a name="getThemeEnabled" id="getThemeEnabled"></a>
### `getThemeEnabled()`

Returns the currently enabled theme.

If no theme is enabled, the **Morpheus** plugin is returned (this is the base and default theme).

#### Signature

- It returns a [`Plugin`](../../Piwik/Plugin.md) value.

<a name="returnloadedpluginsinfo" id="returnloadedpluginsinfo"></a>
<a name="returnLoadedPluginsInfo" id="returnLoadedPluginsInfo"></a>
### `returnLoadedPluginsInfo()`

Returns info regarding all plugins.

Loads plugins that can be loaded.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">An array that maps plugin names with arrays of plugin information. Plugin information consists of the following entries: - **activated**: Whether the plugin is activated. - **alwaysActivated**: Whether the plugin should always be activated, or not. - **uninstallable**: Whether the plugin is uninstallable or not. - **invalid**: If the plugin is invalid, this property will be set to true. If the plugin is not invalid, this property will not exist. - **info**: If the plugin was loaded, will hold the plugin information. See [Plugin::getInformation()](/api-reference/Piwik/Plugin#getinformation).</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getinstalledpluginsname" id="getinstalledpluginsname"></a>
<a name="getInstalledPluginsName" id="getInstalledPluginsName"></a>
### `getInstalledPluginsName()`

Return names of all installed plugins.

#### Signature

- It returns a `array` value.

<a name="getmissingplugins" id="getmissingplugins"></a>
<a name="getMissingPlugins" id="getMissingPlugins"></a>
### `getMissingPlugins()`

Returns names of plugins that should be loaded, but cannot be since their files cannot be found.

#### Signature

- It returns a `array` value.

