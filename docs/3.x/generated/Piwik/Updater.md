<small>Piwik\</small>

Updater
=======

Load and execute all relevant, incremental update scripts for Piwik core and plugins, and bump the component version numbers for completed updates.

Methods
-------

The class defines the following methods:

- [`executeMigrations()`](#executemigrations) &mdash; Execute multiple migration queries from a single Update file.
- [`executeMigration()`](#executemigration)

<a name="executemigrations" id="executemigrations"></a>
<a name="executeMigrations" id="executeMigrations"></a>
### `executeMigrations()`

Execute multiple migration queries from a single Update file.

#### Signature

-  It accepts the following parameter(s):
    - `$file` (`string`) &mdash;
       The path to the Updates file.
    - `$migrations` ([`Migration[]`](../Piwik/Updater/Migration.md)) &mdash;
       An array of migrations
- It does not return anything.

<a name="executemigration" id="executemigration"></a>
<a name="executeMigration" id="executeMigration"></a>
### `executeMigration()`

#### Signature

-  It accepts the following parameter(s):
    - `$file` (`Piwik\$file`) &mdash;
      
    - `$migration` ([`Migration`](../Piwik/Updater/Migration.md)) &mdash;
      
- It does not return anything.
- It throws one of the following exceptions:
    - `UpdaterErrorException`

