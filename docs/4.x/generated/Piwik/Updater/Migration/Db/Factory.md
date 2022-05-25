<small>Piwik\Updater\Migration\Db\</small>

Factory
=======

Provides database migrations.

Methods
-------

The class defines the following methods:

- [`sql()`](#sql) &mdash; Performs a custom SQL query during the update.
- [`boundSql()`](#boundsql) &mdash; Performs a custom SQL query that uses bound parameters during the update.
- [`createTable()`](#createtable) &mdash; Creates a new database table.
- [`dropTable()`](#droptable) &mdash; Drops an existing database table.
- [`addColumn()`](#addcolumn) &mdash; Adds a new database table column to an existing table.
- [`addColumns()`](#addcolumns) &mdash; Adds multiple new database table columns to an existing table at once.
- [`dropColumn()`](#dropcolumn) &mdash; Drops an existing database table column.
- [`dropColumns()`](#dropcolumns) &mdash; Drops an existing database table column.
- [`changeColumn()`](#changecolumn) &mdash; Changes the column name and column type of an existing database table column.
- [`changeColumnType()`](#changecolumntype) &mdash; Changes the type of an existing database table column.
- [`changeColumnTypes()`](#changecolumntypes) &mdash; Changes the type of multiple existing database table columns at the same time.
- [`addIndex()`](#addindex) &mdash; Adds an index to an existing database table.
- [`addUniqueKey()`](#adduniquekey) &mdash; Adds a unique key to an existing database table.
- [`dropIndex()`](#dropindex) &mdash; Drops an existing index from a database table.
- [`dropPrimaryKey()`](#dropprimarykey) &mdash; Drops an existing index from a database table.
- [`addPrimaryKey()`](#addprimarykey) &mdash; Adds a primary key to an existing database table.
- [`insert()`](#insert) &mdash; Inserts a new record / row into an existing database table.
- [`batchInsert()`](#batchinsert) &mdash; Performs a batch insert into a specific table using either LOAD DATA INFILE or plain INSERTs, as a fallback.

<a name="sql" id="sql"></a>
<a name="sql" id="sql"></a>
### `sql()`

Performs a custom SQL query during the update.

Example:
$factory->sql("DELETE * FROM table_name WHERE plugin_name = 'MyPluginName'");

#### Signature

-  It accepts the following parameter(s):
    - `$sql` (`string`) &mdash;
       The SQL query that should be executed. Make sure to prefix a table name via Piwik\Commin::prefixTable().
    - `$errorCodesToIgnore` (`int`|`int[]`) &mdash;
       Any given MySQL server error code will be ignored. For a list of all possible error codes have a look at [Db](/api-reference/Piwik/Updater/Migration/Db). If no error should be ignored use an empty array or `false`.
- It returns a `Stmt_Namespace\Sql` value.

<a name="boundsql" id="boundsql"></a>
<a name="boundSql" id="boundSql"></a>
### `boundSql()`

Performs a custom SQL query that uses bound parameters during the update.

You can replace values with a question mark and then pass the actual value via `$bind` for better security.

Example:
$factory->boundSql('DELETE * FROM table_name WHERE idsite = ?, array($idSite = 1));

#### Signature

-  It accepts the following parameter(s):
    - `$sql` (`string`) &mdash;
       The SQL query that should be executed. Make sure to prefix a table name via Piwik\Commin::prefixTable().
    - `$bind` (`array`) &mdash;
       An array of values that need to be replaced with the question marks in the SQL query.
    - `$errorCodesToIgnore` (`int`|`int[]`) &mdash;
       Any given MySQL server error code will be ignored. For a list of all possible error codes have a look at [Db](/api-reference/Piwik/Updater/Migration/Db). If no error should be ignored use `false`.
- It returns a `Stmt_Namespace\BoundSql` value.

<a name="createtable" id="createtable"></a>
<a name="createTable" id="createTable"></a>
### `createTable()`

Creates a new database table.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`string`) &mdash;
       Unprefixed database table name, eg 'log_visit'.
    - `$columnNames` (`array`) &mdash;
       An array of column names and their type they should use. For example: array('column_name_1' => 'VARCHAR(200) NOT NULL', 'column_name_2' => 'INT(10) DEFAULT 0')
    - `$primaryKey` (`string`|`string[]`) &mdash;
       Optional. One or multiple columns that shall define the primary key.
- It returns a `Stmt_Namespace\CreateTable` value.

<a name="droptable" id="droptable"></a>
<a name="dropTable" id="dropTable"></a>
### `dropTable()`

Drops an existing database table.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`string`) &mdash;
       Unprefixed database table name, eg 'log_visit'.
- It returns a `Stmt_Namespace\DropTable` value.

<a name="addcolumn" id="addcolumn"></a>
<a name="addColumn" id="addColumn"></a>
### `addColumn()`

Adds a new database table column to an existing table.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`string`) &mdash;
       Unprefixed database table name, eg 'log_visit'.
    - `$columnName` (`string`) &mdash;
       The name of the column that shall be added, eg 'my_column_name'.
    - `$columnType` (`string`) &mdash;
       The column type it should have, eg 'VARCHAR(200) NOT NULL'.
    - `$placeColumnAfter` (`string`|`null`) &mdash;
       If specified, the added column will be added after this specified column name. If you specify a column be sure it actually exists and can be added after this column.
- It returns a `Stmt_Namespace\AddColumn` value.

<a name="addcolumns" id="addcolumns"></a>
<a name="addColumns" id="addColumns"></a>
### `addColumns()`

Adds multiple new database table columns to an existing table at once.

Adding multiple columns at the same time can lead to performance improvements compared to adding each new column
separately.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`string`) &mdash;
       Unprefixed database table name, eg 'log_visit'.
    - `$columns` (`array`) &mdash;
       An array of column name to column type pairs, eg array('my_column_name' => 'VARCHAR(200) NOT NULL', 'column2' => '...')
    - `$placeColumnAfter` (`string`|`null`) &mdash;
       If specified, the first added column will be added after this specified column name. All following columns will be added after the previous specified in $columns. If you specify a column be sure it actually exists and can be added after this column.
- It returns a `Stmt_Namespace\AddColumns` value.

<a name="dropcolumn" id="dropcolumn"></a>
<a name="dropColumn" id="dropColumn"></a>
### `dropColumn()`

Drops an existing database table column.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`string`) &mdash;
       Unprefixed database table name, eg 'log_visit'.
    - `$columnName` (`string`) &mdash;
       The name of the column that shall be dropped, eg 'my_column_name'.
- It returns a `Stmt_Namespace\DropColumn` value.

<a name="dropcolumns" id="dropcolumns"></a>
<a name="dropColumns" id="dropColumns"></a>
### `dropColumns()`

Drops an existing database table column.

#### Signature

-  It accepts the following parameter(s):
    - `$table`
      
    - `$columnNames`
      
- It returns a `Stmt_Namespace\DropColumns` value.

<a name="changecolumn" id="changecolumn"></a>
<a name="changeColumn" id="changeColumn"></a>
### `changeColumn()`

Changes the column name and column type of an existing database table column.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`string`) &mdash;
       Unprefixed database table name, eg 'log_visit'.
    - `$oldColumnName` (`string`) &mdash;
       The current name of the column that shall be renamed/changed, eg 'column_name'.
    - `$newColumnName` (`string`) &mdash;
       The new name of the column, eg 'new_column_name'.
    - `$columnType` (`string`) &mdash;
       The updated type the new column should have, eg 'VARCHAR(200) NOT NULL'.
- It returns a `Stmt_Namespace\ChangeColumn` value.

<a name="changecolumntype" id="changecolumntype"></a>
<a name="changeColumnType" id="changeColumnType"></a>
### `changeColumnType()`

Changes the type of an existing database table column.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`string`) &mdash;
       Unprefixed database table name, eg 'log_visit'.
    - `$columnName` (`string`) &mdash;
       The name of the column that shall be changed, eg 'my_column_name'.
    - `$columnType` (`string`) &mdash;
       The updated type the column should have, eg 'VARCHAR(200) NOT NULL'.
- It returns a `Stmt_Namespace\ChangeColumnType` value.

<a name="changecolumntypes" id="changecolumntypes"></a>
<a name="changeColumnTypes" id="changeColumnTypes"></a>
### `changeColumnTypes()`

Changes the type of multiple existing database table columns at the same time.

Changing multiple columns at the same time can lead to performance improvements compared to changing the type
of each column separately.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`string`) &mdash;
       Unprefixed database table name, eg 'log_visit'.
    - `$columns` (`array`) &mdash;
       An array of column name to column type pairs, eg array('my_column_name' => 'VARCHAR(200) NOT NULL', 'column2' => '...')
- It returns a `Stmt_Namespace\ChangeColumnTypes` value.

<a name="addindex" id="addindex"></a>
<a name="addIndex" id="addIndex"></a>
### `addIndex()`

Adds an index to an existing database table.

This is equivalent to an `ADD INDEX indexname (column_name_1, column_name_2)` in SQL.
It adds a normal index, no unique index.

Note: If no indexName is specified, it will automatically generate a name for this index if which is basically:
`'index_' . implode('_', $columnNames)`. If a column name is eg `column1(10)` then only the first part (`column1`)
will be used. For example when using columns `array('column1', 'column2(10)')` then the index name will be
`index_column1_column2`.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`string`) &mdash;
       Unprefixed database table name, eg 'log_visit'.
    - `$columnNames` (`string[]`|`string`) &mdash;
       Either one or multiple column names, eg array('column_name_1', 'column_name_2'). A column name can be appended by a number bracket eg "column_name_1(10)".
    - `$indexName` (`string`) &mdash;
       If specified, the given index name will be used instead of the automatically generated one.
- It returns a `Stmt_Namespace\AddIndex` value.

<a name="adduniquekey" id="adduniquekey"></a>
<a name="addUniqueKey" id="addUniqueKey"></a>
### `addUniqueKey()`

Adds a unique key to an existing database table.

This is equivalent to an `ADD UNIQUE KEY indexname (column_name_1, column_name_2)` in SQL.

Note: If no indexName is specified, it will automatically generate a name for this index if which is basically:
`'index_' . implode('_', $columnNames)`. If a column name is eg `column1(10)` then only the first part (`column1`)
will be used. For example when using columns `array('column1', 'column2(10)')` then the index name will be
`index_column1_column2`.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`string`) &mdash;
       Unprefixed database table name, eg 'log_visit'.
    - `$columnNames` (`string[]`|`string`) &mdash;
       Either one or multiple column names, eg array('column_name_1', 'column_name_2'). A column name can be appended by a number bracket eg "column_name_1(10)".
    - `$indexName` (`string`) &mdash;
       If specified, the given unique key name will be used instead of the automatically generated one.
- It returns a `Stmt_Namespace\AddIndex` value.

<a name="dropindex" id="dropindex"></a>
<a name="dropIndex" id="dropIndex"></a>
### `dropIndex()`

Drops an existing index from a database table.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`string`) &mdash;
       Unprefixed database table name, eg 'log_visit'.
    - `$indexName` (`string`) &mdash;
       The name of the index that shall be dropped.
- It returns a `Stmt_Namespace\DropIndex` value.

<a name="dropprimarykey" id="dropprimarykey"></a>
<a name="dropPrimaryKey" id="dropPrimaryKey"></a>
### `dropPrimaryKey()`

Drops an existing index from a database table.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`string`) &mdash;
       Unprefixed database table name, eg 'log_visit'.
- It returns a `Stmt_Namespace\DropIndex` value.

<a name="addprimarykey" id="addprimarykey"></a>
<a name="addPrimaryKey" id="addPrimaryKey"></a>
### `addPrimaryKey()`

Adds a primary key to an existing database table.

This is equivalent to an `ADD PRIMARY KEY(column_name_1, column_name_2)` in SQL.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`string`) &mdash;
       Unprefixed database table name, eg 'log_visit'.
    - `$columnNames` (`string[]`|`string`) &mdash;
       Either one or multiple column names, eg array('column_name_1', 'column_name_2')
- It returns a `Stmt_Namespace\AddPrimaryKey` value.

<a name="insert" id="insert"></a>
<a name="insert" id="insert"></a>
### `insert()`

Inserts a new record / row into an existing database table.

Make sure to specify all columns that need to be defined in order to insert a value successfully. There could
be for example columns that are not nullable and therefore need a value.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`string`) &mdash;
       Unprefixed database table name, eg 'log_visit'.
    - `$columnValuePairs` (`array`) &mdash;
       An array containing column => value pairs. For example: array('column_name_1' => 'value1', 'column_name_2' => 'value2')
- It returns a `Stmt_Namespace\Insert` value.

<a name="batchinsert" id="batchinsert"></a>
<a name="batchInsert" id="batchInsert"></a>
### `batchInsert()`

Performs a batch insert into a specific table using either LOAD DATA INFILE or plain INSERTs,
as a fallback. On MySQL, LOAD DATA INFILE is 20x faster than a series of plain INSERTs.

Please note that queries for batch inserts are currently not shown to an end user and should therefore not be
returned in an `Updates::getMigrations` method. Instead it needs to be execute directly in `Updates::doUpdate`
via `$updater->executeMigration($factory->dbBatchInsert(...));`

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`string`) &mdash;
       Unprefixed database table name, eg 'log_visit'.
    - `$columnNames` (`string[]`) &mdash;
       An array of unquoted column names, eg array('column_name1', 'column_name_2')
    - `$values` (`array`) &mdash;
       An array of data to be inserted, eg array(array('row1column1', 'row1column2'),array('row2column1', 'row2column2'))
    - `$throwException` (`bool`) &mdash;
       Whether to throw an exception that was caught while trying LOAD DATA INFILE, or not.
    - `$charset` (`string`) &mdash;
       The charset to use, defaults to utf8
- It returns a `Stmt_Namespace\BatchInsert` value.

