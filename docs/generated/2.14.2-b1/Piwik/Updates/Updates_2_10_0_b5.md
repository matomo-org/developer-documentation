<small>Piwik\Updates\</small>

Updates_2_10_0_b5
=================

This Update script will update all browser and os archives of UserSettings and DevicesDetection plugin

In the future only DevicesDetection will handle browser and os archives, so we try to rename all existing archives
of UserSettings plugin to their corresponding archive name in DevicesDetection plugin:
- *UserSettings_browser* will now be *DevicesDetection_browserVersions*
- *UserSettings_os* will now be *DevicesDetection_osVersions*

Unlike DevicesDetection plugin, the UserSettings plugin did not store archives holding the os and browser data without
their version number. The "version-less" reports were always generated out of the "version-containing" archives .
For big archives (month/year) that ment that some of the data was truncated, due to the datatable entry limit.
To avoid that data loss / inaccuracy in the future, DevicesDetection plugin will also store archives without the version.
For data archived after DevicesDetection plugin was enabled, those archive already exist. As we are removing the
UserSettings reports, there is a fallback in DevicesDetection API to build the report out of the datatable with versions.

NOTE: Some archives might not contain "all" data.
That might have happened directly after the day DevicesDetection plugin was enabled. For the days before, there were
no archives calculated. So week/month/year archives will only contain data for the days, where archives were generated
To find a date after which it is safe to use DevicesDetection archives we need to find the first day-archive that
contains DevicesDetection data. Day archives will always contain full data, but week/month/year archives may not.
So we need to recreate those week/month/year archives.

Methods
-------

The class defines the following methods:

- [`getMigrationQueries()`](#getmigrationqueries) &mdash; Return SQL to be executed in this update. Inherited from [`Updates`](../../Piwik/Updates.md)
- [`doUpdate()`](#doupdate) &mdash; Perform the incremental version update. Inherited from [`Updates`](../../Piwik/Updates.md)

<a name="getmigrationqueries" id="getmigrationqueries"></a>
<a name="getMigrationQueries" id="getMigrationQueries"></a>
### `getMigrationQueries()`

Return SQL to be executed in this update.

SQL queries should be defined here, instead of in `doUpdate()`, since this method is used
in the `core:update` command when displaying the queries an update will run. If you execute
queries directly in `doUpdate()`, they won't be displayed to the user.

#### Signature

-  It accepts the following parameter(s):
    - `$updater` (`Piwik\Updater`) &mdash;
      

- *Returns:*  `array` &mdash;
    ``` array( 'ALTER .... ' => '1234', // if the query fails, it will be ignored if the error code is 1234 'ALTER .... ' => false,  // if an error occurs, the update will stop and fail // and user will have to manually run the query ) ```

<a name="doupdate" id="doupdate"></a>
<a name="doUpdate" id="doUpdate"></a>
### `doUpdate()`

Perform the incremental version update.

This method should preform all updating logic. If you define queries in an overridden `getMigrationQueries()`
method, you must call Updater::executeMigrationQueries() here.

See Updates for an example.

#### Signature

-  It accepts the following parameter(s):
    - `$updater` (`Piwik\Updater`) &mdash;
      
- It does not return anything.

