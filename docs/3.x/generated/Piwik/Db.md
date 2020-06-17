<small>Piwik\</small>

Db
==

Contains SQL related helper functions for Piwik's MySQL database.

Plugins should always use this class to execute SQL against the database.

### Examples

    $rows = Db::fetchAll("SELECT col1, col2 FROM mytable WHERE thing = ?", array('thingvalue'));
    foreach ($rows as $row) {
        doSomething($row['col1'], $row['col2']);
    }

    $value = Db::fetchOne("SELECT MAX(col1) FROM mytable");
    doSomethingElse($value);

    Db::query("DELETE FROM mytable WHERE id < ?", array(23));

Properties
----------

This class defines the following properties:

- [`$lockPrivilegeGranted`](#$lockprivilegegranted) &mdash; Cached result of isLockprivilegeGranted function.

<a name="$lockprivilegegranted" id="$lockprivilegegranted"></a>
<a name="lockPrivilegeGranted" id="lockPrivilegeGranted"></a>
### `$lockPrivilegeGranted`

Cached result of isLockprivilegeGranted function.

Public so tests can simulate the situation where the lock tables privilege isn't granted.

#### Signature

- It is a `bool` value.

Methods
-------

The class defines the following methods:

- [`get()`](#get) &mdash; Returns the database connection and creates it if it hasn't been already.
- [`getReader()`](#getreader) &mdash; Returns the database connection and creates it if it hasn't been already.
- [`getDatabaseConfig()`](#getdatabaseconfig) &mdash; Returns an array with the Database connection information.
- [`createDatabaseObject()`](#createdatabaseobject) &mdash; Connects to the database.
- [`createReaderDatabaseObject()`](#createreaderdatabaseobject) &mdash; Connects to the reader database.
- [`destroyDatabaseObject()`](#destroydatabaseobject) &mdash; Disconnects and destroys the database connection.
- [`exec()`](#exec) &mdash; Executes an unprepared SQL query.
- [`query()`](#query) &mdash; Executes an SQL query and returns the [Zend_Db_Statement](http://framework.zend.com/manual/1.12/en/zend.db.statement.html) for the query.
- [`fetchAll()`](#fetchall) &mdash; Executes an SQL `SELECT` statement and returns all fetched rows from the result set.
- [`fetchRow()`](#fetchrow) &mdash; Executes an SQL `SELECT` statement and returns the first row of the result set.
- [`fetchOne()`](#fetchone) &mdash; Executes an SQL `SELECT` statement and returns the first column value of the first row in the result set.
- [`fetchAssoc()`](#fetchassoc) &mdash; Executes an SQL `SELECT` statement and returns the entire result set indexed by the first selected field.
- [`deleteAllRows()`](#deleteallrows) &mdash; Deletes all desired rows in a table, while using a limit.
- [`optimizeTables()`](#optimizetables) &mdash; Runs an `OPTIMIZE TABLE` query on the supplied table or tables.
- [`dropTables()`](#droptables) &mdash; Drops the supplied table or tables.
- [`dropAllTables()`](#dropalltables) &mdash; Drops all tables
- [`getColumnNamesFromTable()`](#getcolumnnamesfromtable) &mdash; Get columns information from table
- [`lockTables()`](#locktables) &mdash; Locks the supplied table or tables.
- [`unlockAllTables()`](#unlockalltables) &mdash; Releases all table locks.
- [`segmentedFetchFirst()`](#segmentedfetchfirst) &mdash; Performs a `SELECT` statement on a table one chunk at a time and returns the first successfully fetched value.
- [`segmentedFetchOne()`](#segmentedfetchone) &mdash; Performs a `SELECT` on a table one chunk at a time and returns an array of every fetched value.
- [`segmentedFetchAll()`](#segmentedfetchall) &mdash; Performs a SELECT on a table one chunk at a time and returns an array of every fetched row.
- [`segmentedQuery()`](#segmentedquery) &mdash; Performs a `UPDATE` or `DELETE` statement on a table one chunk at a time.
- [`getDbLock()`](#getdblock) &mdash; Attempts to get a named lock.
- [`releaseDbLock()`](#releasedblock) &mdash; Releases a named lock.
- [`isLockPrivilegeGranted()`](#islockprivilegegranted) &mdash; Checks whether the database user is allowed to lock tables.
- [`enableQueryLog()`](#enablequerylog)
- [`isQueryLogEnabled()`](#isquerylogenabled)
- [`isOptimizeInnoDBSupported()`](#isoptimizeinnodbsupported)

<a name="get" id="get"></a>
<a name="get" id="get"></a>
### `get()`

Returns the database connection and creates it if it hasn't been already.

#### Signature


- *Returns:*  `Piwik\Tracker\Db`|`Piwik\Db\AdapterInterface`|[`Db`](../Piwik/Db.md) &mdash;
    

<a name="getreader" id="getreader"></a>
<a name="getReader" id="getReader"></a>
### `getReader()`

Since Matomo Matomo

Returns the database connection and creates it if it hasn't been already. Make sure to not write any data on
the reader and only use the connection to read data.

#### Signature


- *Returns:*  `Piwik\Tracker\Db`|`Piwik\Db\AdapterInterface`|[`Db`](../Piwik/Db.md) &mdash;
    

<a name="getdatabaseconfig" id="getdatabaseconfig"></a>
<a name="getDatabaseConfig" id="getDatabaseConfig"></a>
### `getDatabaseConfig()`

Returns an array with the Database connection information.

#### Signature

-  It accepts the following parameter(s):
    - `$dbConfig` (`array`|`null`) &mdash;
      
- It returns a `array` value.

<a name="createdatabaseobject" id="createdatabaseobject"></a>
<a name="createDatabaseObject" id="createDatabaseObject"></a>
### `createDatabaseObject()`

Connects to the database.

Shouldn't be called directly, use [get()](/api-reference/Piwik/Db#get) instead.

#### Signature

-  It accepts the following parameter(s):
    - `$dbConfig` (`array`|`null`) &mdash;
       Connection parameters in an array. Defaults to the `[database]` INI config section.
- It does not return anything.

<a name="createreaderdatabaseobject" id="createreaderdatabaseobject"></a>
<a name="createReaderDatabaseObject" id="createReaderDatabaseObject"></a>
### `createReaderDatabaseObject()`

Since Matomo Matomo

Connects to the reader database.

Shouldn't be called directly, use [get()](/api-reference/Piwik/Db#get) instead.

#### Signature

-  It accepts the following parameter(s):
    - `$dbConfig` (`array`|`null`) &mdash;
       Connection parameters in an array. Defaults to the `[database]` INI config section.
- It does not return anything.

<a name="destroydatabaseobject" id="destroydatabaseobject"></a>
<a name="destroyDatabaseObject" id="destroyDatabaseObject"></a>
### `destroyDatabaseObject()`

Disconnects and destroys the database connection.

For tests.

#### Signature

- It does not return anything.

<a name="exec" id="exec"></a>
<a name="exec" id="exec"></a>
### `exec()`

Executes an unprepared SQL query. Recommended for DDL statements like `CREATE`,
`DROP` and `ALTER`. The return value is DBMS-specific. For MySQLI, it returns the
number of rows affected. For PDO, it returns a
[Zend_Db_Statement](http://framework.zend.com/manual/1.12/en/zend.db.statement.html) object.

#### Signature

-  It accepts the following parameter(s):
    - `$sql` (`string`) &mdash;
       The SQL query.

- *Returns:*  `integer`|`Zend_Db_Statement` &mdash;
    
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If there is an error in the SQL.

<a name="query" id="query"></a>
<a name="query" id="query"></a>
### `query()`

Executes an SQL query and returns the [Zend_Db_Statement](http://framework.zend.com/manual/1.12/en/zend.db.statement.html)
for the query.

This method is meant for non-query SQL statements like `INSERT` and `UPDATE. If you want to fetch
data from the DB you should use one of the fetch... functions.

#### Signature

-  It accepts the following parameter(s):
    - `$sql` (`string`) &mdash;
       The SQL query.
    - `$parameters` (`array`) &mdash;
       Parameters to bind in the query, eg, `array(param1 => value1, param2 => value2)`.
- It returns a `Zend_Db_Statement` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If there is a problem with the SQL or bind parameters.

<a name="fetchall" id="fetchall"></a>
<a name="fetchAll" id="fetchAll"></a>
### `fetchAll()`

Executes an SQL `SELECT` statement and returns all fetched rows from the result set.

#### Signature

-  It accepts the following parameter(s):
    - `$sql` (`string`) &mdash;
       The SQL query.
    - `$parameters` (`array`) &mdash;
       Parameters to bind in the query, eg, `array(param1 => value1, param2 => value2)`.

- *Returns:*  `array` &mdash;
    The fetched rows, each element is an associative array mapping column names
              with column values.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If there is a problem with the SQL or bind parameters.

<a name="fetchrow" id="fetchrow"></a>
<a name="fetchRow" id="fetchRow"></a>
### `fetchRow()`

Executes an SQL `SELECT` statement and returns the first row of the result set.

#### Signature

-  It accepts the following parameter(s):
    - `$sql` (`string`) &mdash;
       The SQL query.
    - `$parameters` (`array`) &mdash;
       Parameters to bind in the query, eg, `array(param1 => value1, param2 => value2)`.

- *Returns:*  `array` &mdash;
    The fetched row, each element is an associative array mapping column names
              with column values.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If there is a problem with the SQL or bind parameters.

<a name="fetchone" id="fetchone"></a>
<a name="fetchOne" id="fetchOne"></a>
### `fetchOne()`

Executes an SQL `SELECT` statement and returns the first column value of the first
row in the result set.

#### Signature

-  It accepts the following parameter(s):
    - `$sql` (`string`) &mdash;
       The SQL query.
    - `$parameters` (`array`) &mdash;
       Parameters to bind in the query, eg, `array(param1 => value1, param2 => value2)`.
- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If there is a problem with the SQL or bind parameters.

<a name="fetchassoc" id="fetchassoc"></a>
<a name="fetchAssoc" id="fetchAssoc"></a>
### `fetchAssoc()`

Executes an SQL `SELECT` statement and returns the entire result set indexed by the first
selected field.

#### Signature

-  It accepts the following parameter(s):
    - `$sql` (`string`) &mdash;
       The SQL query.
    - `$parameters` (`array`) &mdash;
       Parameters to bind in the query, eg, `array(param1 => value1, param2 => value2)`.

- *Returns:*  `array` &mdash;
    eg,
              ```
              array('col1value1' => array('col2' => '...', 'col3' => ...),
                    'col1value2' => array('col2' => '...', 'col3' => ...))
              ```
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If there is a problem with the SQL or bind parameters.

<a name="deleteallrows" id="deleteallrows"></a>
<a name="deleteAllRows" id="deleteAllRows"></a>
### `deleteAllRows()`

Deletes all desired rows in a table, while using a limit. This function will execute many
DELETE queries until there are no more rows to delete.

Use this function when you need to delete many thousands of rows from a table without
locking the table for too long.

**Example**

    // delete all visit rows whose ID is less than a certain value, 100000 rows at a time
    $idVisit = // ...
    Db::deleteAllRows(Common::prefixTable('log_visit'), "WHERE idvisit <= ?", "idvisit ASC", 100000, array($idVisit));

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`string`) &mdash;
       The name of the table to delete from. Must be prefixed (see [Common::prefixTable()](/api-reference/Piwik/Common#prefixtable)).
    - `$where` (`string`) &mdash;
       The where clause of the query. Must include the WHERE keyword.
    - `$orderBy` (`string`) &mdash;
       The column to order by and the order by direction, eg, `idvisit ASC`.
    - `$maxRowsPerQuery` (`int`) &mdash;
       The maximum number of rows to delete per `DELETE` query.
    - `$parameters` (`array`) &mdash;
       Parameters to bind for each query.

- *Returns:*  `int` &mdash;
    The total number of rows deleted.

<a name="optimizetables" id="optimizetables"></a>
<a name="optimizeTables" id="optimizeTables"></a>
### `optimizeTables()`

Runs an `OPTIMIZE TABLE` query on the supplied table or tables.

Tables will only be optimized if the `[General] enable_sql_optimize_queries` INI config option is
set to **1**.

#### Signature

-  It accepts the following parameter(s):
    - `$tables` (`string`|`array`) &mdash;
       The name of the table to optimize or an array of tables to optimize. Table names must be prefixed (see [Common::prefixTable()](/api-reference/Piwik/Common#prefixtable)).
    - `$force` (`bool`) &mdash;
       If true, the `OPTIMIZE TABLE` query will be run even if InnoDB tables are being used.
- It returns a `Zend_Db_Statement` value.

<a name="droptables" id="droptables"></a>
<a name="dropTables" id="dropTables"></a>
### `dropTables()`

Drops the supplied table or tables.

#### Signature

-  It accepts the following parameter(s):
    - `$tables` (`string`|`array`) &mdash;
       The name of the table to drop or an array of table names to drop. Table names must be prefixed (see [Common::prefixTable()](/api-reference/Piwik/Common#prefixtable)).
- It returns a `Zend_Db_Statement` value.

<a name="dropalltables" id="dropalltables"></a>
<a name="dropAllTables" id="dropAllTables"></a>
### `dropAllTables()`

Drops all tables

#### Signature

- It does not return anything.

<a name="getcolumnnamesfromtable" id="getcolumnnamesfromtable"></a>
<a name="getColumnNamesFromTable" id="getColumnNamesFromTable"></a>
### `getColumnNamesFromTable()`

Get columns information from table

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`string`|`array`) &mdash;
       The name of the table you want to get the columns definition for.
- It returns a `Zend_Db_Statement` value.

<a name="locktables" id="locktables"></a>
<a name="lockTables" id="lockTables"></a>
### `lockTables()`

Locks the supplied table or tables.

**NOTE:** Piwik does not require the `LOCK TABLES` privilege to be available. Piwik
should still work if it has not been granted.

#### Signature

-  It accepts the following parameter(s):
    - `$tablesToRead` (`string`|`array`) &mdash;
       The table or tables to obtain 'read' locks on. Table names must be prefixed (see [Common::prefixTable()](/api-reference/Piwik/Common#prefixtable)).
    - `$tablesToWrite` (`string`|`array`) &mdash;
       The table or tables to obtain 'write' locks on. Table names must be prefixed (see [Common::prefixTable()](/api-reference/Piwik/Common#prefixtable)).
- It returns a `Zend_Db_Statement` value.

<a name="unlockalltables" id="unlockalltables"></a>
<a name="unlockAllTables" id="unlockAllTables"></a>
### `unlockAllTables()`

Releases all table locks.

**NOTE:** Piwik does not require the `LOCK TABLES` privilege to be available. Piwik
should still work if it has not been granted.

#### Signature

- It returns a `Zend_Db_Statement` value.

<a name="segmentedfetchfirst" id="segmentedfetchfirst"></a>
<a name="segmentedFetchFirst" id="segmentedFetchFirst"></a>
### `segmentedFetchFirst()`

Performs a `SELECT` statement on a table one chunk at a time and returns the first
successfully fetched value.

This function will execute a query on one set of rows in a table. If nothing
is fetched, it will execute the query on the next set of rows and so on until
the query returns a value.

This function will break up a `SELECT into several smaller `SELECT`s and
should be used when performing a `SELECT` that can take a long time to finish.
Using several smaller `SELECT`s will ensure that the table will not be locked
for too long.

**Example**

    // find the most recent visit that is older than a certain date
    $dateStart = // ...
    $sql = "SELECT idvisit
          FROM $logVisit
         WHERE '$dateStart' > visit_last_action_time
           AND idvisit <= ?
           AND idvisit > ?
      ORDER BY idvisit DESC
         LIMIT 1";

    // since visits
    return Db::segmentedFetchFirst($sql, $maxIdVisit, 0, -self::$selectSegmentSize);

#### Signature

-  It accepts the following parameter(s):
    - `$sql` (`string`) &mdash;
       The SQL to perform. The last two conditions of the `WHERE` expression must be as follows: `'id >= ? AND id < ?'` where **id** is the int id of the table.
    - `$first` (`int`) &mdash;
       The minimum ID to loop from.
    - `$last` (`int`) &mdash;
       The maximum ID to loop to.
    - `$step` (`int`) &mdash;
       The maximum number of rows to scan in one query.
    - `$params` (`array`) &mdash;
       Parameters to bind in the query, eg, `array(param1 => value1, param2 => value2)`
- It returns a `string` value.

<a name="segmentedfetchone" id="segmentedfetchone"></a>
<a name="segmentedFetchOne" id="segmentedFetchOne"></a>
### `segmentedFetchOne()`

Performs a `SELECT` on a table one chunk at a time and returns an array
of every fetched value.

This function will break up a `SELECT` query into several smaller queries by
using only a limited number of rows at a time. It will accumulate the results
of each smaller query and return the result.

This function should be used when performing a `SELECT` that can
take a long time to finish. Using several smaller queries will ensure that
the table will not be locked for too long.

#### Signature

-  It accepts the following parameter(s):
    - `$sql` (`string`) &mdash;
       The SQL to perform. The last two conditions of the `WHERE` expression must be as follows: `'id >= ? AND id < ?'` where **id** is the int id of the table.
    - `$first` (`int`) &mdash;
       The minimum ID to loop from.
    - `$last` (`int`) &mdash;
       The maximum ID to loop to.
    - `$step` (`int`) &mdash;
       The maximum number of rows to scan in one query.
    - `$params` (`array`) &mdash;
       Parameters to bind in the query, `array(param1 => value1, param2 => value2)`

- *Returns:*  `array` &mdash;
    An array of primitive values.

<a name="segmentedfetchall" id="segmentedfetchall"></a>
<a name="segmentedFetchAll" id="segmentedFetchAll"></a>
### `segmentedFetchAll()`

Performs a SELECT on a table one chunk at a time and returns an array
of every fetched row.

This function will break up a `SELECT` query into several smaller queries by
using only a limited number of rows at a time. It will accumulate the results
of each smaller query and return the result.

This function should be used when performing a `SELECT` that can
take a long time to finish. Using several smaller queries will ensure that
the table will not be locked for too long.

#### Signature

-  It accepts the following parameter(s):
    - `$sql` (`string`) &mdash;
       The SQL to perform. The last two conditions of the `WHERE` expression must be as follows: `'id >= ? AND id < ?'` where **id** is the int id of the table.
    - `$first` (`int`) &mdash;
       The minimum ID to loop from.
    - `$last` (`int`) &mdash;
       The maximum ID to loop to.
    - `$step` (`int`) &mdash;
       The maximum number of rows to scan in one query.
    - `$params` (`array`) &mdash;
       Parameters to bind in the query, array( param1 => value1, param2 => value2)

- *Returns:*  `array` &mdash;
    An array of rows that includes the result set of every smaller
              query.

<a name="segmentedquery" id="segmentedquery"></a>
<a name="segmentedQuery" id="segmentedQuery"></a>
### `segmentedQuery()`

Performs a `UPDATE` or `DELETE` statement on a table one chunk at a time.

This function will break up a query into several smaller queries by
using only a limited number of rows at a time.

This function should be used when executing a non-query statement will
take a long time to finish. Using several smaller queries will ensure that
the table will not be locked for too long.

#### Signature

-  It accepts the following parameter(s):
    - `$sql` (`string`) &mdash;
       The SQL to perform. The last two conditions of the `WHERE` expression must be as follows: `'id >= ? AND id < ?'` where **id** is the int id of the table.
    - `$first` (`int`) &mdash;
       The minimum ID to loop from.
    - `$last` (`int`) &mdash;
       The maximum ID to loop to.
    - `$step` (`int`) &mdash;
       The maximum number of rows to scan in one query.
    - `$params` (`array`) &mdash;
       Parameters to bind in the query, `array(param1 => value1, param2 => value2)`
- It does not return anything.

<a name="getdblock" id="getdblock"></a>
<a name="getDbLock" id="getDbLock"></a>
### `getDbLock()`

Attempts to get a named lock. This function uses a timeout of 1s, but will
retry a set number of times.

#### Signature

-  It accepts the following parameter(s):
    - `$lockName` (`string`) &mdash;
       The lock name.
    - `$maxRetries` (`int`) &mdash;
       The max number of times to retry.

- *Returns:*  `bool` &mdash;
    `true` if the lock was obtained, `false` if otherwise.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if Lock name is too long

<a name="releasedblock" id="releasedblock"></a>
<a name="releaseDbLock" id="releaseDbLock"></a>
### `releaseDbLock()`

Releases a named lock.

#### Signature

-  It accepts the following parameter(s):
    - `$lockName` (`string`) &mdash;
       The lock name.

- *Returns:*  `bool` &mdash;
    `true` if the lock was released, `false` if otherwise.

<a name="islockprivilegegranted" id="islockprivilegegranted"></a>
<a name="isLockPrivilegeGranted" id="isLockPrivilegeGranted"></a>
### `isLockPrivilegeGranted()`

Checks whether the database user is allowed to lock tables.

#### Signature

- It returns a `bool` value.

<a name="enablequerylog" id="enablequerylog"></a>
<a name="enableQueryLog" id="enableQueryLog"></a>
### `enableQueryLog()`

#### Signature

-  It accepts the following parameter(s):
    - `$enable` (`bool`) &mdash;
      
- It does not return anything.

<a name="isquerylogenabled" id="isquerylogenabled"></a>
<a name="isQueryLogEnabled" id="isQueryLogEnabled"></a>
### `isQueryLogEnabled()`

#### Signature

- It returns a `boolean` value.

<a name="isoptimizeinnodbsupported" id="isoptimizeinnodbsupported"></a>
<a name="isOptimizeInnoDBSupported" id="isOptimizeInnoDBSupported"></a>
### `isOptimizeInnoDBSupported()`

#### Signature

-  It accepts the following parameter(s):
    - `$version`
      
- It does not return anything.

