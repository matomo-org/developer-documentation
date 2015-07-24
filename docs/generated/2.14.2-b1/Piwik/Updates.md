<small>Piwik\</small>

Updates
=======

Base class for update scripts.

Update scripts perform version updates for Piwik core or individual plugins. They can run
SQL queries and/or PHP code to update an environment to a newer version.

To create a new update script, create a class that extends `Updates`. Name the class and file
after the version, eg, `class Updates_3_0_0` and `3.0.0.php`. Override the [getMigrationQueries()](/api-reference/Piwik/Updates#getmigrationqueries)
method if you need to run SQL queries. Override the [doUpdate()](/api-reference/Piwik/Updates#doupdate) method to do other types
of updating, eg, to activate/deactivate plugins or create files.

If you define SQL queries in [getMigrationQueries()](/api-reference/Piwik/Updates#getmigrationqueries), you have to call Updater::executeMigrationQueries(),
eg:

    public function doUpdate(Updater $updater)
    {
        $updater->executeMigrationQueries(__FILE__, $this->getMigrationQueries());
    }

Methods
-------

The abstract class defines the following methods:

- [`getMigrationQueries()`](#getmigrationqueries) &mdash; Return SQL to be executed in this update.
- [`doUpdate()`](#doupdate) &mdash; Perform the incremental version update.

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

See [Updates](/api-reference/Piwik/Updates) for an example.

#### Signature

-  It accepts the following parameter(s):
    - `$updater` (`Piwik\Updater`) &mdash;
      
- It does not return anything.

