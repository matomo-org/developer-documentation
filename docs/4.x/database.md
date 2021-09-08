---
category: Develop
---
# Database

## Getting a DB connection

To get a DB connection call `$db = \Piwik\Db::get();`.

For a [list of all available `Db` methods](/api-reference/Piwik/Db) and [`DbHelper` methods](/api-reference/Piwik/DbHelper) see our API reference. Below we will introduce some of these methods.

## Querying the database

There are various methods available to query data like:

* `fetchOne` - return only one value
* `fetchRow` - return only one row as an array
* `fetchAll` - return all matching rows as an array
* `query`    - returns a [Zend_Db_Statement](http://framework.zend.com/manual/1.12/en/zend.db.statement.html) which lets you iterate over each row, get the row count, and more.

All of these support binding parameters using place holders (`?`) for security to prevent SQL injections, for example:

```php
$rows = $db->fetchAll('select * from log_visit where idvisit = ? and idsite = ?', [$idvisit, $idsite]);
foreach ($rows as $row) {
    echo $row['idvisit'];
} 
```

## Changing data

If you need to change data (insert, update, delete, alter), there are two methods you can use:

* `exec` - Executes an unprepared SQL query (no bound parameters can be used). Recommended for DDL statements like `CREATE`, `DROP`, `LOCK` and `ALTER`. The return value is DBMS-specific.
* `query` - Executes a SQL query. This method is meant for non-query SQL statements like `INSERT`, `UPDATE` and `DELETE`.

Example:

```php
$sql = sprintf('INSERT INTO table_name (`key`, `value`, `expiry_time`) VALUES (?,?,(UNIX_TIMESTAMP() + ?))';
$db->query($sql, array($key, $value, (int) $ttlInSeconds));
```

## Performance considerations

* Always only fetch the data you need and make use of indexes. [See also our profiling the DB guide.](/guides/profiling-code#database-queries)
* For security to prevent SQL injections, bind parameters. Instead of `WHERE userername = "$var"` use `WHERE userername = ?` and bind the value.  
* If your query has hundreds or thousands of bound parameters, then this can make your query extremely slow. In that case, if possible, you will not want to use bound parameters. It is typically only possible if you can cast values to integers, as this way you can ensure there won't be a SQL injection. Example: `WHERE idvisit = (int)$idvisit` 
