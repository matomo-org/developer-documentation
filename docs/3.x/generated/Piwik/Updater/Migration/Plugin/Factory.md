<small>Piwik\Updater\Migration\Plugin\</small>

Factory
=======

Provides plugin migrations.

Methods
-------

The class defines the following methods:

- [`activate()`](#activate) &mdash; Activates the given plugin during an update.

<a name="activate" id="activate"></a>
<a name="activate" id="activate"></a>
### `activate()`

Activates the given plugin during an update.

If the plugin is already activated or if any other error occurs it will be ignored.

#### Signature

-  It accepts the following parameter(s):
    - `$pluginName` (`string`) &mdash;
      
- It returns a `Piwik\Updater\Migration\Plugin\Activate` value.

