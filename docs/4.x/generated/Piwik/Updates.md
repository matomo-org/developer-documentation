<small>Piwik\</small>

Updates
=======

Base class for update scripts.

Update scripts perform version updates for Piwik core or individual plugins. They can run
SQL queries and/or PHP code to update an environment to a newer version.

To create a new update script, create a class that extends `Updates`. Name the class and file
after the version, eg, `class Updates_3_0_0` and `3.0.0.php`. Override the getMigrationQueries()
method if you need to run SQL queries. Override the [doUpdate()](/api-reference/Piwik/Updates#doupdate) method to do other types
of updating, eg, to activate/deactivate plugins or create files.

Methods
-------

The abstract class defines the following methods:

- [`getMigrations()`](#getmigrations) &mdash; Return migrations to be executed in this update.
- [`doUpdate()`](#doupdate) &mdash; Perform the incremental version update.

<a name="getmigrations" id="getmigrations"></a>
<a name="getMigrations" id="getMigrations"></a>
### `getMigrations()`

Return migrations to be executed in this update.

Migrations should be defined here, instead of in `doUpdate()`, since this method is used to display a preview
of which migrations and database queries an update will run. If you execute migrations directly in `doUpdate()`,
they won't be displayed to the user.

#### Signature

-  It accepts the following parameter(s):
    - `$updater` ([`Updater`](../Piwik/Updater.md)) &mdash;
      
- It returns a [`Migration[]`](../Piwik/Updater/Migration.md) value.

<a name="doupdate" id="doupdate"></a>
<a name="doUpdate" id="doUpdate"></a>
### `doUpdate()`

Perform the incremental version update.

This method should perform all updating logic. If you define migrations in an overridden `getMigrations()`
method, you must call [Updater::executeMigrations()](/api-reference/Piwik/Updater#executemigrations) here.

See \Piwik\Plugins\ExamplePlugin\Updates\Updates\_0\_0\_2 for an example.

#### Signature

-  It accepts the following parameter(s):
    - `$updater` ([`Updater`](../Piwik/Updater.md)) &mdash;
      
- It does not return anything or a mixed result.

