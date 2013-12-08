<small>Piwik\</small>

Db
==

Helper class that contains SQL related helper functions.

Plugins should use this class to execute SQL against the database.

### Examples

**Basic Usage**

    $rows = Db::fetchAll("SELECT col1, col2 FROM mytable WHERE thing = ?", array('thingvalue'));
    foreach ($rows as $row) {
        doSomething($row['col1'], $row['col2']);
    }

    $value = Db::fetchOne("SELECT MAX(col1) FROM mytable");

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
- [`createDatabaseObject()`](#createdatabaseobject) &mdash; Create the database object and connects to the database.
- [`exec()`](#exec) &mdash; Executes an unprepared SQL query.
- [`query()`](#query) &mdash; Executes an SQL query and returns the Zend_Db_Statement object.
- [`fetchAll()`](#fetchall) &mdash; Executes the SQL query and fetches all the rows from the result set.
- [`fetchRow()`](#fetchrow) &mdash; Executes an SQL query and fetches the first row of the result.
- [`fetchOne()`](#fetchone) &mdash; Executes an SQL query and fetches the first column of the first row of result set.
- [`fetchAssoc()`](#fetchassoc) &mdash; Executes an SQL query and returns the entire result set indexed by the first selected field.
- [`deleteAllRows()`](#deleteallrows) &mdash; Deletes all desired rows in a table, while using a limit.
- [`optimizeTables()`](#optimizetables) &mdash; Runs an OPTIMIZE TABLE query on the supplied table or tables.
- [`dropTables()`](#droptables) &mdash; Drops the supplied table or tables.
- [`lockTables()`](#locktables) &mdash; Locks the supplied table or tables.
- [`unlockAllTables()`](#unlockalltables) &mdash; Releases all table locks.
- [`segmentedFetchFirst()`](#segmentedfetchfirst) &mdash; Performs a SELECT on a table one chunk at a time and returns the first successfully fetched value.
- [`segmentedFetchOne()`](#segmentedfetchone) &mdash; Performs a SELECT on a table one chunk at a time and returns an array of every fetched value.
- [`segmentedFetchAll()`](#segmentedfetchall) &mdash; Performs a SELECT on a table one chunk at a time and returns an array of every fetched row.
- [`segmentedQuery()`](#segmentedquery) &mdash; Performs a non-SELECT query on a table one chunk at a time.
- [`getDbLock()`](#getdblock) &mdash; Attempts to get a named lock.
- [`releaseDbLock()`](#releasedblock) &mdash; Releases a named lock.
- [`isLockPrivilegeGranted()`](#islockprivilegegranted) &mdash; Checks whether the database user is allowed to lock tables.

<a name="get" id="get"></a>
<a name="get" id="get"></a>
### `get()`

Returns the database connection and creates it if it hasn't been already.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`Piwik\Tracker\Db`|`Piwik\Db\AdapterInterface`|[`Db`](../Piwik/Db.md)) &mdash;
    <div markdown="1" class="param-desc"></div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="createdatabaseobject" id="createdatabaseobject"></a>
<a name="createDatabaseObject" id="createDatabaseObject"></a>
### `createDatabaseObject()`

Create the database object and connects to the database.

Shouldn't be called directly, use [get](#get).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$dbInfos` (`array`|`null`) &mdash;

      <div markdown="1" class="param-desc"> Connection parameters in an array. Defaults to the `[database]` INI config section.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="exec" id="exec"></a>
<a name="exec" id="exec"></a>
### `exec()`

Executes an unprepared SQL query.

Recommended for DDL statements like CREATE,
DROP and ALTER. The return value is DBMS-specific. For MySQLI, it returns the
number of rows affected. For PDO, it returns the `Zend_Db_Statement` object.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$sql` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The SQL query.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`integer`|`Zend_Db_Statement`) &mdash;
    <div markdown="1" class="param-desc"></div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If there is an error in the SQL.

<a name="query" id="query"></a>
<a name="query" id="query"></a>
### `query()`

Executes an SQL query and returns the Zend_Db_Statement object.

If you want to fetch data from the DB you should use one of the fetch... functions.

See also [http://framework.zend.com/manual/en/zend.db.statement.html](http://framework.zend.com/manual/en/zend.db.statement.html).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$sql` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The SQL query.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$parameters` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Parameters to bind in the query, eg, `array(param1 => value1, param2 => value2)`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `Zend_Db_Statement` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If there is a problem with the SQL or bind parameters.

<a name="fetchall" id="fetchall"></a>
<a name="fetchAll" id="fetchAll"></a>
### `fetchAll()`

Executes the SQL query and fetches all the rows from the result set.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$sql` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The SQL query.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$parameters` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Parameters to bind in the query, eg, `array(param1 => value1, param2 => value2)`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">(one row in the array per row fetched in the DB)</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If there is a problem with the SQL or bind parameters.

<a name="fetchrow" id="fetchrow"></a>
<a name="fetchRow" id="fetchRow"></a>
### `fetchRow()`

Executes an SQL query and fetches the first row of the result.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$sql` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The SQL query.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$parameters` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Parameters to bind in the query, eg, `array(param1 => value1, param2 => value2)`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `array` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If there is a problem with the SQL or bind parameters.

<a name="fetchone" id="fetchone"></a>
<a name="fetchOne" id="fetchOne"></a>
### `fetchOne()`

Executes an SQL query and fetches the first column of the first row of result set.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$sql` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The SQL query.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$parameters` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Parameters to bind in the query, eg, `array(param1 => value1, param2 => value2)`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If there is a problem with the SQL or bind parameters.

<a name="fetchassoc" id="fetchassoc"></a>
<a name="fetchAssoc" id="fetchAssoc"></a>
### `fetchAssoc()`

Executes an SQL query and returns the entire result set indexed by the first selected field.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$sql` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The SQL query.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$parameters` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Parameters to bind in the query, eg, `array(param1 => value1, param2 => value2)`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">eg, ``` array('col1value1' => array('col2' => '...', 'col3' => ...), 'col1value2' => array('col2' => '...', 'col3' => ...)) ```</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If there is a problem with the SQL or bind parameters.

<a name="deleteallrows" id="deleteallrows"></a>
<a name="deleteAllRows" id="deleteAllRows"></a>
### `deleteAllRows()`

Deletes all desired rows in a table, while using a limit.

This function will execute many
DELETE queries until there are no more rows to delete.

Use this function when you need to delete many thousands of rows from a table without
locking the table for too long.

**Example**

    $idVisit = // ...
    Db::deleteAllRows(Common::prefixTable('log_visit'), "WHERE idvisit <= ?", "idvisit ASC", 100000, array($idVisit));

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$table` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The name of the table to delete from. Must be prefixed (see [Common::prefixTable](#)).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$where` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The where clause of the query. Must include the WHERE keyword.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$orderBy` (`Piwik\$orderBy`) &mdash;

      <div markdown="1" class="param-desc"> The column to order by and the order by direction, eg, `idvisit ASC`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$maxRowsPerQuery` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The maximum number of rows to delete per DELETE query.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$parameters` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Parameters to bind in the query.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`int`) &mdash;
    <div markdown="1" class="param-desc">The total number of rows deleted.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="optimizetables" id="optimizetables"></a>
<a name="optimizeTables" id="optimizeTables"></a>
### `optimizeTables()`

Runs an OPTIMIZE TABLE query on the supplied table or tables.

The table names must be prefixed
(see [Common::prefixTable](#)).

Tables will only be optimized if the `[General] enable_sql_optimize_queries` config option is
set to **1**.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$tables` (`string`|`array`) &mdash;

      <div markdown="1" class="param-desc"> The name of the table to optimize or an array of tables to optimize.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `Zend_Db_Statement` value.

<a name="droptables" id="droptables"></a>
<a name="dropTables" id="dropTables"></a>
### `dropTables()`

Drops the supplied table or tables.

The table names must be prefixed (see [Common::prefixTable](#)).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$tables` (`string`|`array`) &mdash;

      <div markdown="1" class="param-desc"> The name of the table to drop or an array of table names to drop.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `Zend_Db_Statement` value.

<a name="locktables" id="locktables"></a>
<a name="lockTables" id="lockTables"></a>
### `lockTables()`

Locks the supplied table or tables.

The table names must be prefixed (see [Common::prefixTable](#)).

**NOTE:** Piwik does not require the LOCK TABLES privilege to be available. Piwik
should still work in case it is not granted.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$tablesToRead` (`string`|`array`) &mdash;

      <div markdown="1" class="param-desc"> The table or tables to obtain 'read' locks on.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$tablesToWrite` (`string`|`array`) &mdash;

      <div markdown="1" class="param-desc"> The table or tables to obtain 'write' locks on.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `Zend_Db_Statement` value.

<a name="unlockalltables" id="unlockalltables"></a>
<a name="unlockAllTables" id="unlockAllTables"></a>
### `unlockAllTables()`

Releases all table locks.

**NOTE:** Piwik does not require the LOCK TABLES privilege to be available. Piwik
should still work in case it is not granted.

#### Signature

- It returns a `Zend_Db_Statement` value.

<a name="segmentedfetchfirst" id="segmentedfetchfirst"></a>
<a name="segmentedFetchFirst" id="segmentedFetchFirst"></a>
### `segmentedFetchFirst()`

Performs a SELECT on a table one chunk at a time and returns the first successfully fetched value.

In other words, if running a SELECT on one chunk of the table doesn't
return a value, we move on to the next chunk and we keep moving until
the SELECT returns a value.

This function will break up a SELECT into several smaller SELECTs and
should be used when performing a SELECT that can take a long time to finish.
Using several smaller SELECTs will ensure that the table will not be locked
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

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$sql` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The SQL to perform. The last two conditions of the WHERE expression must be as follows: 'id >= ? AND id < ?' where 'id' is the int id of the table.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$first` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The minimum ID to loop from.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$last` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The maximum ID to loop to.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$step` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The maximum number of rows to scan in each smaller SELECT.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$params` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Parameters to bind in the query, `array(param1 => value1, param2 => value2)`</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `string` value.

<a name="segmentedfetchone" id="segmentedfetchone"></a>
<a name="segmentedFetchOne" id="segmentedFetchOne"></a>
### `segmentedFetchOne()`

Performs a SELECT on a table one chunk at a time and returns an array of every fetched value.

This function will break up a SELECT into several smaller SELECTs and
accumulate the result. It should be used when performing a SELECT that can
take a long time to finish. Using several smaller SELECTs will ensure that
the table will not be locked for too long.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$sql` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The SQL to perform. The last two conditions of the WHERE expression must be as follows: 'id >= ? AND id < ?' where 'id' is the int id of the table.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$first` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The minimum ID to loop from.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$last` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The maximum ID to loop to.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$step` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The maximum number of rows to scan in each smaller SELECT.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$params` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Parameters to bind in the query, `array(param1 => value1, param2 => value2)`</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">An array of primitive values.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="segmentedfetchall" id="segmentedfetchall"></a>
<a name="segmentedFetchAll" id="segmentedFetchAll"></a>
### `segmentedFetchAll()`

Performs a SELECT on a table one chunk at a time and returns an array of every fetched row.

This function will break up a SELECT into several smaller SELECTs and
accumulate the result. It should be used when performing a SELECT that can
take a long time to finish. Using several smaller SELECTs will ensure that
the table will not be locked for too long.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$sql` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The SQL to perform. The last two conditions of the WHERE expression must be as follows: 'id >= ? AND id < ?' where 'id' is the int id of the table.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$first` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The minimum ID to loop from.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$last` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The maximum ID to loop to.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$step` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The maximum number of rows to scan in each smaller SELECT.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$params` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Parameters to bind in the query, array( param1 => value1, param2 => value2)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">An array of rows that includes the result set of every executed query.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="segmentedquery" id="segmentedquery"></a>
<a name="segmentedQuery" id="segmentedQuery"></a>
### `segmentedQuery()`

Performs a non-SELECT query on a table one chunk at a time.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$sql` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The SQL to perform. The last two conditions of the WHERE expression must be as follows: 'id >= ? AND id < ?' where 'id' is the int id of the table.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$first` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The minimum ID to loop from.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$last` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The maximum ID to loop to.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$step` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The maximum number of rows to scan in each smaller query.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$params` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Parameters to bind in the query, `array(param1 => value1, param2 => value2)`</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="getdblock" id="getdblock"></a>
<a name="getDbLock" id="getDbLock"></a>
### `getDbLock()`

Attempts to get a named lock.

This function uses a timeout of 1s, but will
retry a set number of time.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$lockName` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The lock name.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$maxRetries` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The max number of times to retry.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`bool`) &mdash;
    <div markdown="1" class="param-desc">`true` if the lock was obtained, `false` if otherwise.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="releasedblock" id="releasedblock"></a>
<a name="releaseDbLock" id="releaseDbLock"></a>
### `releaseDbLock()`

Releases a named lock.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$lockName` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The lock name.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`bool`) &mdash;
    <div markdown="1" class="param-desc">`true` if the lock was released, `false` if otherwise.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="islockprivilegegranted" id="islockprivilegegranted"></a>
<a name="isLockPrivilegeGranted" id="isLockPrivilegeGranted"></a>
### `isLockPrivilegeGranted()`

Checks whether the database user is allowed to lock tables.

#### Signature

- It returns a `bool` value.

