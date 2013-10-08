<small>Piwik</small>

Db
==

SQL wrapper


Properties
----------

This class defines the following properties:

- [`$lockPrivilegeGranted`](#$lockPrivilegeGranted) &mdash; Cached result of isLockprivilegeGranted function.

### `$lockPrivilegeGranted` <a name="lockPrivilegeGranted"></a>

Cached result of isLockprivilegeGranted function.

#### Description

Public so tests can simulate the situation where the lock tables privilege isn&#039;t granted.

#### Signature

- It is a **public static** property.
- It is a(n) `bool` value.

Methods
-------

The class defines the following methods:

- [`get()`](#get) &mdash; Returns the database adapter to use
- [`createDatabaseObject()`](#createDatabaseObject) &mdash; Create database object and connect to database
- [`exec()`](#exec) &mdash; Executes an unprepared SQL query on the DB.
- [`query()`](#query) &mdash; Executes a SQL query on the DB and returns the Zend_Db_Statement object If you want to fetch data from the DB you should use the function Db::fetchAll()
- [`fetchAll()`](#fetchAll) &mdash; Executes the SQL Query and fetches all the rows from the database query
- [`fetchRow()`](#fetchRow) &mdash; Fetches first row of result from the database query
- [`fetchOne()`](#fetchOne) &mdash; Fetches first column of first row of result from the database query
- [`fetchAssoc()`](#fetchAssoc) &mdash; Fetches result from the database query as an array of associative arrays.
- [`deleteAllRows()`](#deleteAllRows) &mdash; Deletes all desired rows in a table, while using a limit.
- [`optimizeTables()`](#optimizeTables) &mdash; Runs an OPTIMIZE TABLE query on the supplied table or tables.
- [`dropTables()`](#dropTables) &mdash; Drops the supplied table or tables.
- [`lockTables()`](#lockTables) &mdash; Locks the supplied table or tables.
- [`unlockAllTables()`](#unlockAllTables) &mdash; Releases all table locks.
- [`segmentedFetchFirst()`](#segmentedFetchFirst) &mdash; Performs a SELECT on a table one chunk at a time and returns the first fetched value.
- [`segmentedFetchOne()`](#segmentedFetchOne) &mdash; Performs a SELECT on a table one chunk at a time and returns an array of every fetched value.
- [`segmentedFetchAll()`](#segmentedFetchAll) &mdash; Performs a SELECT on a table one chunk at a time and returns an array of every fetched row.
- [`segmentedQuery()`](#segmentedQuery) &mdash; Performs a non-SELECT query on a table one chunk at a time.
- [`getDbLock()`](#getDbLock) &mdash; Attempts to get a named lock.
- [`releaseDbLock()`](#releaseDbLock) &mdash; Releases a named lock.
- [`isLockPrivilegeGranted()`](#isLockPrivilegeGranted) &mdash; Checks whether the database user is allowed to lock tables.

### `get()` <a name="get"></a>

Returns the database adapter to use

#### Signature

- It is a **public static** method.
- It can return one of the following values:
    - `Piwik\Tracker\Db`
    - `Piwik\Db\AdapterInterface`
    - [`Db`](../Piwik/Db.md)

### `createDatabaseObject()` <a name="createDatabaseObject"></a>

Create database object and connect to database

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$dbInfos`
- It does not return anything.

### `exec()` <a name="exec"></a>

Executes an unprepared SQL query on the DB.

#### Description

Recommended for DDL statements, e.g., CREATE/DROP/ALTER.
The return result is DBMS-specific. For MySQLI, it returns the number of rows affected.  For PDO, it returns the Zend_Db_Statement object
If you want to fetch data from the DB you should use the function Db::fetchAll()

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$sql`
- It can return one of the following values:
    - `integer`
    - `Zend_Db_Statement`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `query()` <a name="query"></a>

Executes a SQL query on the DB and returns the Zend_Db_Statement object If you want to fetch data from the DB you should use the function Db::fetchAll()

#### Description

See also http://framework.zend.com/manual/en/zend.db.statement.html

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$sql`
    - `$parameters`
- It returns a(n) `Zend_Db_Statement` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `fetchAll()` <a name="fetchAll"></a>

Executes the SQL Query and fetches all the rows from the database query

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$sql`
    - `$parameters`
- _Returns:_ (one row in the array per row fetched in the DB)
    - `array`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `fetchRow()` <a name="fetchRow"></a>

Fetches first row of result from the database query

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$sql`
    - `$parameters`
- It returns a(n) `array` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `fetchOne()` <a name="fetchOne"></a>

Fetches first column of first row of result from the database query

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$sql`
    - `$parameters`
- It returns a(n) `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `fetchAssoc()` <a name="fetchAssoc"></a>

Fetches result from the database query as an array of associative arrays.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$sql`
    - `$parameters`
- It returns a(n) `array` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `deleteAllRows()` <a name="deleteAllRows"></a>

Deletes all desired rows in a table, while using a limit.

#### Description

This function will execute a
DELETE query until there are no more rows to delete.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$table`
    - `$where`
    - `$orderBy`
    - `$maxRowsPerQuery`
    - `$parameters`
- _Returns:_ The total number of rows deleted.
    - `int`

### `optimizeTables()` <a name="optimizeTables"></a>

Runs an OPTIMIZE TABLE query on the supplied table or tables.

#### Description

The table names must be prefixed.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$tables`
- It returns a(n) `Zend_Db_Statement` value.

### `dropTables()` <a name="dropTables"></a>

Drops the supplied table or tables.

#### Description

The table names must be prefixed.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$tables`
- It returns a(n) `Zend_Db_Statement` value.

### `lockTables()` <a name="lockTables"></a>

Locks the supplied table or tables.

#### Description

The table names must be prefixed.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$tablesToRead`
    - `$tablesToWrite`
- It returns a(n) `Zend_Db_Statement` value.

### `unlockAllTables()` <a name="unlockAllTables"></a>

Releases all table locks.

#### Signature

- It is a **public static** method.
- It returns a(n) `Zend_Db_Statement` value.

### `segmentedFetchFirst()` <a name="segmentedFetchFirst"></a>

Performs a SELECT on a table one chunk at a time and returns the first fetched value.

#### Description

This function will break up a SELECT into several smaller SELECTs and
should be used when performing a SELECT that can take a long time to finish.
Using several smaller SELECTs will ensure that the table will not be locked
for too long.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$sql`
    - `$first`
    - `$last`
    - `$step`
    - `$params`
- It returns a(n) `string` value.

### `segmentedFetchOne()` <a name="segmentedFetchOne"></a>

Performs a SELECT on a table one chunk at a time and returns an array of every fetched value.

#### Description

This function will break up a SELECT into several smaller SELECTs and
should be used when performing a SELECT that can take a long time to finish.
Using several smaller SELECTs will ensure that the table will not be locked
for too long.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$sql`
    - `$first`
    - `$last`
    - `$step`
    - `$params`
- It returns a(n) `array` value.

### `segmentedFetchAll()` <a name="segmentedFetchAll"></a>

Performs a SELECT on a table one chunk at a time and returns an array of every fetched row.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$sql`
    - `$first`
    - `$last`
    - `$step`
    - `$params`
- It returns a(n) `array` value.

### `segmentedQuery()` <a name="segmentedQuery"></a>

Performs a non-SELECT query on a table one chunk at a time.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$sql`
    - `$first`
    - `$last`
    - `$step`
    - `$params`
- It returns a(n) `array` value.

### `getDbLock()` <a name="getDbLock"></a>

Attempts to get a named lock.

#### Description

This function uses a timeout of 1s, but will
retry a set number of time.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$lockName`
    - `$maxRetries`
- _Returns:_ true if the lock was obtained, false if otherwise.
    - `bool`

### `releaseDbLock()` <a name="releaseDbLock"></a>

Releases a named lock.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$lockName`
- _Returns:_ true if the lock was released, false if otherwise.
    - `bool`

### `isLockPrivilegeGranted()` <a name="isLockPrivilegeGranted"></a>

Checks whether the database user is allowed to lock tables.

#### Signature

- It is a **public static** method.
- It returns a(n) `bool` value.

