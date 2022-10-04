<small>Piwik\Updater\Migration\Plugin\</small>

Factory
=======

Provides plugin migrations.

Methods
-------

The class defines the following methods:

- [`activate()`](#activate) &mdash; Activates the given plugin during an update.
- [`deactivate()`](#deactivate) &mdash; Deactivates the given plugin during an update.
- [`uninstall()`](#uninstall) &mdash; Uninstalls the given plugin during an update.

<a name="activate" id="activate"></a>
<a name="activate" id="activate"></a>
### `activate()`

Activates the given plugin during an update.

If the plugin is already activated or if any other error occurs it will be ignored.

#### Signature

-  It accepts the following parameter(s):
    - `$pluginName` (`string`) &mdash;
      
- It returns a `Piwik\Updater\Migration\Plugin\Activate` value.

<a name="deactivate" id="deactivate"></a>
<a name="deactivate" id="deactivate"></a>
### `deactivate()`

Deactivates the given plugin during an update.

If the plugin is already deactivated or if any other error occurs it will be ignored.

#### Signature

-  It accepts the following parameter(s):
    - `$pluginName` (`string`) &mdash;
      
- It returns a `Piwik\Updater\Migration\Plugin\Deactivate` value.

<a name="uninstall" id="uninstall"></a>
<a name="uninstall" id="uninstall"></a>
### `uninstall()`

Uninstalls the given plugin during an update.

If the plugin is still active or if any other error occurs it will be ignored.

#### Signature

-  It accepts the following parameter(s):
    - `$pluginName` (`string`) &mdash;
      
- It returns a `Piwik\Updater\Migration\Plugin\Uninstall` value.

