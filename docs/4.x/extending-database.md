---
category: Develop
---
# Extending the database

Plugins can provide persistence for new data if they need to.
As Piwik is currently storing all data in a MySQL database, we learn how to add new tables in the database and how to add a new data column to an existing table.


## Adding new tables

To add new tables to Piwik's MySQL database, execute a `CREATE TABLE` statement in the plugin descriptor's [install](/api-reference/Piwik/Plugin#install) method. For example:

```php
use Piwik\Db;
use Piwik\Common;
use \Exception;

public class MyPlugin extends \Piwik\Plugin
{
    // ...

    public function install()
    {
        try {
            $sql = "CREATE TABLE " . Common::prefixTable('mynewtable') . " (
                        mykey VARCHAR( 10 ) NOT NULL ,
                        mydata VARCHAR( 100 ) NOT NULL ,
                        PRIMARY KEY ( mykey )
                    )  DEFAULT CHARSET=utf8 ";
            Db::exec($sql);
        } catch (Exception $e) {
            // ignore error if table already exists (1050 code is for 'table already exists')
            if (!Db::get()->isErrNo($e, '1050')) {
                throw $e;
            }
        }
    }

    // ...
}
```

### Removing the table when plugin is uninstalled

Plugins should also clean up after themselves by dropping the tables in the [uninstall](/api-reference/Piwik/Plugin#uninstall) method:

```php
use Piwik\Db;
use Piwik\Common;
use \Exception;

public class MyPlugin extends \Piwik\Plugin
{
    // ...

    public function uninstall()
    {
        Db::dropTables(Common::prefixTable('mynewtable'));
    }

    // ...
}
```

**Note: New tables should be appropriately [prefixed](/api-reference/Piwik/Common#prefixtable).**

## Adding new columns to existing tables

Plugins can also augment existing tables. For example, if a plugin wanted to track extra visit information, the plugin could add columns to log data tables and set a value for these columns during tracking.
This would also be done in the [install](/api-reference/Piwik/Plugin#install) method:

```php
use Piwik\Db;

public class MyPlugin extends \Piwik\Plugin
{
    // ...

    public function install()
    {
        try {
            $q1 = "ALTER TABLE `" . Common::prefixTable("log_visit") . "`
                   ADD `mynewdata` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `config_os`,";
            Db::exec($q1);
        } catch (Exception $e) {
            // ignore column already exists error
            if (!Db::get()->isErrNo($e, '1060')) {
                throw $e;
            }
        }
    }

    // ...
}
```

### Removing the column when plugin is uninstalled

Since log tables can have millions and even billions of entries, removing columns from these tables when a plugin is uninstalled would be a bad idea.
Plugins should remove the column in the [uninstall](/api-reference/Piwik/Plugin#uninstall) method only when the table's name is not starting with `log_*`.

## Defining database updates

If your plugin defines a custom database table or columns the schema will need a migration eventually. A plugin can define
a migration by generating an update file using the console:

```
$ ./console generate:update
```

The command will ask you for your plugin name and then create a new update file within the `plugins/MyPlugin/Updates` directory,
for example `3.0.0-b1.php`. The content of an update file might look like this:

```php
class Updates_3_0_0_b1 extends PiwikUpdates
{
    /**
     * @var MigrationFactory
     */
    private $migration;

    public function __construct(MigrationFactory $factory)
    {
        $this->migration = $factory;
    }

    public function getMigrations(Updater $updater)
    {
        return array(
            $this->migration->db->changeColumnType($table = 'log_visit', $column = 'location_provider', $type = 'VARCHAR(200) NULL')
        );
    }

    public function doUpdate(Updater $updater)
    {
        $updater->executeMigrations(__FILE__, $this->getMigrations($updater));
    }
}
```

The database migration factory (`$this->migration->db`) gives you lots of different option for performing a database migration
and does all the complicated work for you. For example, you can add columns, remove columns, change columns, change keys,
add new tables, and you can even perform custom SQL during a migration. For a list of all available migrations have a look at the
[DB Migration Factory API-Reference](/api-reference/Piwik/Updater/Migration/Db/Factory).

If you want to perform any other operations unrelated to the MySQL database when your plugin is updated, you can do this within
the `doUpdate` method.

### Updates for existing log tables

This section applies mostly to core developers but you may want to follow the same practice.

The [log_* DB tables](https://developer.matomo.org/guides/database-schema#log-data) is where Matomo stores the raw data of every visit and action that was tracked. These tables typically become quite large and making changes to these tables, for example adding or deleting a column or index, can take a very long time. This is why we change the schema for these log tables only as part of a major Matomo release. This applies to Matomo core and to any plugins developed by Matomo to ensure minor and patch updates won't cause any trouble when updating. 

#### Workarounds

If a change is very useful or needed then one workaround would be to make this change for all new installations of Matomo core or a plugin and already add an update script for the next major release so existing users will receive the change eventually. This means the code would need to check if a specific column/index exists or not to make use of that functionality. We'd also publish an FAQ how to make these changes manually in case someone wanted to get this functionality earlier as the next major release could be years away.

## Change notifications

To add "What's new?" change notifications for your plugin, create a `changes.json` file in your plugin folder containing JSON data to describe each change.   

```json
[
  {
    "title":       "New feature x added",
    "description": "Now you can do a with b like this",
    "version":     "4.0.2",
    "link_name":   "For more information go here",
    "link":        "https://www.matomo.org"
  },
  {
    "title":       "New feature y added",
    "description": "Now you can do c with d like this.",
    "version":     "4.0.1"
  }
]
```

| Key         | Description |
| ----------- | ----------- |
| title       | A short heading describing the change. | 
| description | Body text describing the change in more detail, HTML may be used. | 
| version     | The version of the plugin in which this changes was made. |
| link_name   | Display name of a link to be shown underneath the change description, optional. |
| link        | URL of the link, optional. |

Whenever a plugin is installed or updated any new entries in the `changes.json` file will be loaded into the `changes` database
table and shown when the "What's New?" menu icon is clicked. Change notifications are loaded in the same order as they appear in
the `changes.json` file and will be shown for ninety days from the date that they were loaded. 

## Learn more

Learn more about the Piwik Analytics database structure and tables in the [Database schema reference](/guides/database-schema).
