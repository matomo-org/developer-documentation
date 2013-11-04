<small>Piwik\Plugin</small>

ControllerAdmin
===============

Base class of plugin controllers that provide administrative functionality.

Description
-----------

See [Controller](#) to learn more about Piwik controllers.


Methods
-------

The abstract class defines the following methods:

- [`displayWarningIfConfigFileNotWritable()`](#displayWarningIfConfigFileNotWritable)
- [`setBasicVariablesAdminView()`](#setBasicVariablesAdminView) &mdash; Assigns a set of variables to a view that would be useful to an Admin controller.

### `displayWarningIfConfigFileNotWritable()` <a name="displayWarningIfConfigFileNotWritable"></a>

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$view` ([`View`](../../Piwik/View.md))
- It does not return anything.

### `setBasicVariablesAdminView()` <a name="setBasicVariablesAdminView"></a>

Assigns a set of variables to a view that would be useful to an Admin controller.

#### Description

Assigns the following variables:

- **statisticsNotRecorded** - Set to true if the `[Tracker] record_statistics` INI
                              config is `0`. If not `0`, this variable will not be defined.
- **topMenu** - The result of `MenuTop::getInstance()->getMenu()`.
- **currentAdminMenuName** - The currently selected admin menu name.
- **enableFrames** - The value of the `[General] enable_framed_pages` INI config option. If
                   true, [View::setXFrameOptions](#) is called on the view.
- **isSuperUser** - Whether the current user is a superuser or not.
- **usingOldGeoIPPlugin** - Whether this Piwik install is currently using the old GeoIP
                            plugin or not.
- **invalidPluginsWarning** - Set if some of the plugins to load (determined by INI configuration)
                              are invalid or missing.
- **phpVersion** - The current PHP version.
- **phpIsNewEnough** - Whether the current PHP version is new enough to run Piwik.
- **adminMenu** - The result of `MenuAdmin::getInstance()->getMenu()`.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$view` ([`View`](../../Piwik/View.md))
- It does not return anything.

