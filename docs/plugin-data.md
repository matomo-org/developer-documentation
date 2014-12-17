---
category: Develop
---
# Plugin Data

## Adding new tables

Plugins can provide persistence for new data if they need to. At the moment, since MySQL is the only supported backend, this means directly adding and using new tables.

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

## Augmenting existing tables

Plugins can also augment existing tables. If, for example, a plugin wanted to track extra visit information, the plugin could add columns to log data tables and set these columns during tracking.This would also be done in the [install](/api-reference/Piwik/Plugin#install) method:

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

Plugins should remove the column in the [uninstall](/api-reference/Piwik/Plugin#uninstall) method, **unless doing so take very long time**. Since log tables can have millions and even billions of entries, removing columns from these tables when a plugin is uninstalled would be a bad idea.
