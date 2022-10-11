<small>Piwik\Columns\</small>

Updater
=======

Class that handles dimension updates

Methods
-------

The class defines the following methods:

- [`getMigrations()`](#getmigrations)
- [`doUpdate()`](#doupdate) &mdash; Perform the incremental version update. Inherited from [`Updates`](../../Piwik/Updates.md)

<a name="getmigrations" id="getmigrations"></a>
<a name="getMigrations" id="getMigrations"></a>
### `getMigrations()`

#### Signature

-  It accepts the following parameter(s):
    - `$updater` ([`Updater`](../../Piwik/Updater.md)) &mdash;
      
- It returns a [`Migration[]`](../../Piwik/Updater/Migration.md) value.

<a name="doupdate" id="doupdate"></a>
<a name="doUpdate" id="doUpdate"></a>
### `doUpdate()`

Perform the incremental version update.

This method should perform all updating logic. If you define migrations in an overridden `getMigrations()`
method, you must call Updater::executeMigrations() here.

See \Piwik\Plugins\ExamplePlugin\Updates\Updates\_0\_0\_2 for an example.

#### Signature

-  It accepts the following parameter(s):
    - `$updater` ([`Updater`](../../Piwik/Updater.md)) &mdash;
      
- It does not return anything or a mixed result.

