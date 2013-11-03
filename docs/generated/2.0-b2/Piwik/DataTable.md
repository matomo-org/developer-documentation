<small>Piwik</small>

DataTable
=========

The primary data structure used to store analytics data in Piwik.

Description
-----------

&lt;a name=&quot;class-desc-the-basics&quot;&gt;&lt;/a&gt;
### The Basics

DataTables consist of rows and each row consists of columns. A column value can be
be a numeric, string or array.

Every row has an ID. The ID is either the index of the row or [ID_SUMMARY_ROW](#ID_SUMMARY_ROW).

DataTables are hierarchical data structures. Each row can also contain an additional
nested sub-DataTable (commonly referred to as a &#039;subtable&#039;).

Both DataTables and DataTable rows can hold **metadata**. _DataTable metadata_ is information
regarding all the data, such as the site or period that the data is for. _Row metadata_
is information regarding that row, such as a browser logo or website URL.

Finally, DataTables all contain a special _summary_ row. This row, if it exists, is
always at the end of the DataTable.

### Populating DataTables

Data can be added to DataTables in a couple different ways. You can either:

1. create rows one by one and add them through [addRow](#addRow) then truncate if desired,
2. create an array of DataTable\Row instances or an array of arrays and add them using
   [addRowsFromArray](#addRowsFromArray) or [addRowsFromSimpleArray](#addRowsFromSimpleArray)
   then truncate if desired,
3. or set the maximum number of allowed rows (with [setMaximumAllowedRows](#setMaximumAllowedRows))
   and add rows one by one.

If you want to eventually truncate your data (standard practice for all Piwik plugins),
the third method is the most memory efficient. It is, unfortunately, not always possible
to use since it requires that the data be sorted before adding.

### Manipulating DataTables

There are two main ways to manipulate a DataTable. You can either:

1. manually iterate through each row and manipulate the data,
2. or you can use predefined Filters.

A Filter is a class that has a &#039;filter&#039; method which will manipulate a DataTable in
some way. There are several predefined Filters that allow you to do common things,
such as,

- add a new column to each row,
- add new metadata to each row,
- modify an existing column value for each row,
- sort an entire DataTable,
- and more.

Using these Filters instead of writing your own code will increase code clarity and
reduce code redundancy. Additionally, Filters have the advantage that they can be
applied to DataTable\Map instances. So you can visit every DataTable in a DataTable\Map
without having to write a recursive visiting function.

Note: Anonymous functions can be used as DataTable Filters.

### Applying Filters

Filters can be applied now (via [filter](#filter)), or they can be applied later (via
[queueFilter](#queueFilter)).

Filters that sort rows or manipulate the number of rows should be applied right away.
Non-essential, presentation filters should be queued.

### Learn more

- **ArchiveProcessor** &amp;mdash; to learn how DataTables are persisted.
- **DataTable\Renderer** &amp;mdash; to learn how DataTable data is exported to XML, JSON, etc.
- **DataTable\Filter** &amp;mdash; to see all core Filters.
- **DataTable\Manager** &amp;mdash; to learn how DataTables are loaded.

### Examples

**Populating a DataTable**

    // adding one row at a time
    $dataTable = new DataTable();
    $dataTable-&gt;addRow(new Row(array(
        Row::COLUMNS =&gt; array(&#039;label&#039; =&gt; &#039;thing1&#039;, &#039;nb_visits&#039; =&gt; 1, &#039;nb_actions&#039; =&gt; 1),
        Row::METADATA =&gt; array(&#039;url&#039; =&gt; &#039;http://thing1.com&#039;)
    )));
    $dataTable-&gt;addRow(new Row(array(
        Row::COLUMNS =&gt; array(&#039;label&#039; =&gt; &#039;thing2&#039;, &#039;nb_visits&#039; =&gt; 2, &#039;nb_actions&#039; =&gt; 2),
        Row::METADATA =&gt; array(&#039;url&#039; =&gt; &#039;http://thing2.com&#039;)
    )));
    
    // using an array of rows
    $dataTable = new DataTable();
    $dataTable-&gt;addRowsFromArray(array(
        array(
            Row::COLUMNS =&gt; array(&#039;label&#039; =&gt; &#039;thing1&#039;, &#039;nb_visits&#039; =&gt; 1, &#039;nb_actions&#039; =&gt; 1),
            Row::METADATA =&gt; array(&#039;url&#039; =&gt; &#039;http://thing1.com&#039;)
        ),
        array(
            Row::COLUMNS =&gt; array(&#039;label&#039; =&gt; &#039;thing2&#039;, &#039;nb_visits&#039; =&gt; 2, &#039;nb_actions&#039; =&gt; 2),
            Row::METADATA =&gt; array(&#039;url&#039; =&gt; &#039;http://thing2.com&#039;)
        )
    ));

    // using a &quot;simple&quot; array
    $dataTable-&gt;addRowsFromSimpleArray(array(
        array(&#039;label&#039; =&gt; &#039;thing1&#039;, &#039;nb_visits&#039; =&gt; 1, &#039;nb_actions&#039; =&gt; 1),
        array(&#039;label&#039; =&gt; &#039;thing2&#039;, &#039;nb_visits&#039; =&gt; 2, &#039;nb_actions&#039; =&gt; 2)
    ));

**Getting &amp; setting metadata**

    $dataTable = \Piwik\Plugins\Referrers\API::getInstance()-&gt;getSearchEngines($idSite = 1, $period = &#039;day&#039;, $date = &#039;2007-07-24&#039;);
    $oldPeriod = $dataTable-&gt;metadata[&#039;period&#039;];
    $dataTable-&gt;metadata[&#039;period&#039;] = Period::factory(&#039;week&#039;, Date::factory(&#039;2013-10-18&#039;));

**Serializing &amp; unserializing**

    $maxRowsInTable = Config::getInstance()-&gt;General[&#039;datatable_archiving_maximum_rows_standard&#039;];j
    
    $dataTable = // ... build by aggregating visits ...
    $serializedData = $dataTable-&gt;getSerialized($maxRowsInTable, $maxRowsInSubtable = $maxRowsInTable,
                                                $columnToSortBy = Metrics::INDEX_NB_VISITS);
    
    $serializedDataTable = $serializedData[0];
    $serailizedSubTable = $serializedData[$idSubtable];

**Filtering for an API method**

    public function getMyReport($idSite, $period, $date, $segment = false, $expanded = false)
    {
        $dataTable = Archive::getDataTableFromArchive(&#039;MyPlugin_MyReport&#039;, $idSite, $period, $date, $segment, $expanded);
        $dataTable-&gt;filter(&#039;Sort&#039;, array(Metrics::INDEX_NB_VISITS, &#039;desc&#039;, $naturalSort = false, $expanded));
        $dataTable-&gt;queueFilter(&#039;ReplaceColumnNames&#039;);
        $dataTable-&gt;queueFilter(&#039;ColumnCallbackAddMetadata&#039;, array(&#039;label&#039;, &#039;url&#039;, __NAMESPACE__ . &#039;\getUrlFromLabelForMyReport&#039;));
        return $dataTable;
    }


Constants
---------

This class defines the following constants:

- [`MAX_DEPTH_DEFAULT`](#MAX_DEPTH_DEFAULT)
- [`ARCHIVED_DATE_METADATA_NAME`](#ARCHIVED_DATE_METADATA_NAME) &mdash; Name for metadata that describes when a report was archived.
- [`EMPTY_COLUMNS_METADATA_NAME`](#EMPTY_COLUMNS_METADATA_NAME) &mdash; Name for metadata that describes which columns are empty and should not be shown.
- [`TOTAL_ROWS_BEFORE_LIMIT_METADATA_NAME`](#TOTAL_ROWS_BEFORE_LIMIT_METADATA_NAME) &mdash; Name for metadata that describes the number of rows that existed before the Limit filter was applied.
- [`COLUMN_AGGREGATION_OPS_METADATA_NAME`](#COLUMN_AGGREGATION_OPS_METADATA_NAME) &mdash; Name for metadata that describes how individual columns should be aggregated when [addDataTable](#addDataTable) or [DataTable\Row::sumRow](#) is called.
- [`ID_SUMMARY_ROW`](#ID_SUMMARY_ROW) &mdash; The ID of the Summary Row.
- [`LABEL_SUMMARY_ROW`](#LABEL_SUMMARY_ROW) &mdash; The original label of the Summary Row.

### `COLUMN_AGGREGATION_OPS_METADATA_NAME` <a name="COLUMN_AGGREGATION_OPS_METADATA_NAME"></a>

This metadata value must be an array that maps column names with valid operations. Valid aggregation operations are:

- `&#039;skip&#039;`: do nothing
- `&#039;max&#039;`: does `max($column1, $column2)`
- `&#039;min&#039;`: does `min($column1, $column2)`
- `&#039;sum&#039;`: does `$column1 + $column2`

See [addDataTable](#addDataTable) and [DataTable\Row::sumRow](#) for more information.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`__destruct()`](#__destruct) &mdash; Destructor.
- [`sort()`](#sort) &mdash; Sorts the DataTable rows using the supplied callback function.
- [`getSortedByColumnName()`](#getSortedByColumnName) &mdash; Returns the name of the column this table was sorted by (if any).
- [`enableRecursiveSort()`](#enableRecursiveSort) &mdash; Enables recursive sorting.
- [`enableRecursiveFilters()`](#enableRecursiveFilters) &mdash; Enables recursive filtering.
- [`filter()`](#filter) &mdash; Applies filter to this datatable.
- [`queueFilter()`](#queueFilter) &mdash; Adds a filter and a list of parameters to the list of queued filters.
- [`applyQueuedFilters()`](#applyQueuedFilters) &mdash; Applies all filters that were previously queued to the table.
- [`addDataTable()`](#addDataTable) &mdash; Sums a DataTable to this one.
- [`getRowFromLabel()`](#getRowFromLabel) &mdash; Returns the Row whose `&#039;label&#039;` column is equal to `$label`.
- [`getRowIdFromLabel()`](#getRowIdFromLabel) &mdash; Returns the row id for the row whose `&#039;label&#039;` column is equal to `$label`.
- [`getEmptyClone()`](#getEmptyClone) &mdash; Returns an empty DataTable with the same metadata and queued filters as `$this` one.
- [`getRowFromId()`](#getRowFromId) &mdash; Returns a row by ID.
- [`getRowFromIdSubDataTable()`](#getRowFromIdSubDataTable) &mdash; Returns the row that has a subtable with ID matching `$idSubtable`.
- [`addRow()`](#addRow) &mdash; Adds a row to this table.
- [`addSummaryRow()`](#addSummaryRow) &mdash; Sets the summary row.
- [`getId()`](#getId) &mdash; Returns the DataTable ID.
- [`addRowFromArray()`](#addRowFromArray) &mdash; Adds a new row from an array.
- [`addRowFromSimpleArray()`](#addRowFromSimpleArray) &mdash; Adds a new row a from an array of column values.
- [`getRows()`](#getRows) &mdash; Returns the array of Rows.
- [`getColumn()`](#getColumn) &mdash; Returns an array containing all column values for the requested column.
- [`getColumnsStartingWith()`](#getColumnsStartingWith) &mdash; Returns an array containing all column values of columns whose name starts with `$name`.
- [`getColumns()`](#getColumns) &mdash; Returns the list of columns the rows in this datatable contain.
- [`getRowsMetadata()`](#getRowsMetadata) &mdash; Returns an array containing the requested metadata value of each row.
- [`getRowsCount()`](#getRowsCount) &mdash; Returns the number of rows in the table including the summary row.
- [`getFirstRow()`](#getFirstRow) &mdash; Returns the first row of the DataTable.
- [`getLastRow()`](#getLastRow) &mdash; Returns the last row of the DataTable.
- [`getRowsCountRecursive()`](#getRowsCountRecursive) &mdash; Returns the number of rows in this DataTable summed with the row count of each subtable in the DataTable hierarchy.
- [`deleteColumn()`](#deleteColumn) &mdash; Delete a column by name in every row.
- [`__sleep()`](#__sleep)
- [`renameColumn()`](#renameColumn) &mdash; Rename a column in every row.
- [`deleteColumns()`](#deleteColumns) &mdash; Deletes several columns by name in every row.
- [`deleteRow()`](#deleteRow) &mdash; Deletes a row by ID.
- [`deleteRowsOffset()`](#deleteRowsOffset) &mdash; Deletes rows from `$offset` to `$offset + $limit`.
- [`deleteRows()`](#deleteRows) &mdash; Deletes a set of rows by ID.
- [`__toString()`](#__toString) &mdash; Returns a string representation of this DataTable for convenient viewing.
- [`isEqual()`](#isEqual) &mdash; Returns true if both DataTable instances are exactly the same.
- [`getSerialized()`](#getSerialized) &mdash; Serializes an entire DataTable hierarchy and returns the array of serialized DataTables.
- [`addRowsFromSerializedArray()`](#addRowsFromSerializedArray) &mdash; Adds a set of rows from a serialized DataTable string.
- [`addRowsFromArray()`](#addRowsFromArray) &mdash; Adds many rows from an array.
- [`addRowsFromSimpleArray()`](#addRowsFromSimpleArray) &mdash; Adds many rows from an array containing arrays of column values.
- [`makeFromIndexedArray()`](#makeFromIndexedArray) &mdash; Rewrites the input $array array (     LABEL =&gt; array(col1 =&gt; X, col2 =&gt; Y),     LABEL2 =&gt; array(col1 =&gt; X, col2 =&gt; Y), ) to a DataTable, ie.
- [`setMaximumDepthLevelAllowedAtLeast()`](#setMaximumDepthLevelAllowedAtLeast) &mdash; Sets the maximum depth level to at least a certain value.
- [`getMetadata()`](#getMetadata) &mdash; Returns metadata by name.
- [`setMetadata()`](#setMetadata) &mdash; Sets a metadata value by name.
- [`getAllTableMetadata()`](#getAllTableMetadata) &mdash; Returns all table metadata.
- [`setMetadataValues()`](#setMetadataValues) &mdash; Sets several metadata values by name.
- [`setAllTableMetadata()`](#setAllTableMetadata) &mdash; Sets metadata erasing existing values.
- [`setMaximumAllowedRows()`](#setMaximumAllowedRows) &mdash; Sets the maximum number of rows allowed in this datatable (including the summary row).
- [`walkPath()`](#walkPath) &mdash; Traverses a DataTable tree using an array of labels and returns the row it finds or false if it cannot find one, and the number of segments of the path successfully walked.
- [`mergeSubtables()`](#mergeSubtables) &mdash; Returns a new DataTable in which the rows of this table are replaced with its subtable&#039;s rows.
- [`makeFromSimpleArray()`](#makeFromSimpleArray) &mdash; Returns a new DataTable created with data from a &#039;simple&#039; array.
- [`fromSerializedArray()`](#fromSerializedArray) &mdash; Creates a new DataTable instance from a serialized DataTable string.

### `__construct()` <a name="__construct"></a>

Constructor.

#### Description

Creates an empty DataTable.

#### Signature

- It is a **public** method.
- It does not return anything.

### `__destruct()` <a name="__destruct"></a>

Destructor.

#### Description

Makes sure DataTable memory will be cleaned up.

#### Signature

- It is a **public** method.
- It does not return anything.

### `sort()` <a name="sort"></a>

Sorts the DataTable rows using the supplied callback function.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$functionCallback`
    - `$columnSortedBy`
- It does not return anything.

### `getSortedByColumnName()` <a name="getSortedByColumnName"></a>

Returns the name of the column this table was sorted by (if any).

#### Description

See [sort](#sort).

#### Signature

- It is a **public** method.
- _Returns:_ The sorted column name or false if none.
    - `Piwik\false`
    - `string`

### `enableRecursiveSort()` <a name="enableRecursiveSort"></a>

Enables recursive sorting.

#### Description

If this method is called [sort](#sort) will also sort all
subtables.

#### Signature

- It is a **public** method.
- It does not return anything.

### `enableRecursiveFilters()` <a name="enableRecursiveFilters"></a>

Enables recursive filtering.

#### Description

If this method is called then the [filter](#filter) method
will apply filters to every subtable in addition to this instance.

#### Signature

- It is a **public** method.
- It does not return anything.

### `filter()` <a name="filter"></a>

Applies filter to this datatable.

#### Description

If [enableRecursiveFilters](#enableRecursiveFilters) was called, the filter will be applied
to all subtables as well.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$className`
    - `$parameters`
- It does not return anything.

### `queueFilter()` <a name="queueFilter"></a>

Adds a filter and a list of parameters to the list of queued filters.

#### Description

These filters will be
executed when [applyQueuedFilters](#applyQueuedFilters) is called.

Filters that prettify the output or don&#039;t need the full set of rows should be queued. This
way they will be run after the table is truncated which will result in better performance.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$className`
    - `$parameters`
- It does not return anything.

### `applyQueuedFilters()` <a name="applyQueuedFilters"></a>

Applies all filters that were previously queued to the table.

#### Description

See [queueFilter](#queueFilter)
for more information.

#### Signature

- It is a **public** method.
- It does not return anything.

### `addDataTable()` <a name="addDataTable"></a>

Sums a DataTable to this one.

#### Description

This method will sum rows that have the same label. If a row is found in `$tableToSum` whose
label is not found in `$this`, the row will be added to `$this` DataTable.

If the subtables for this table are loaded, they will be summed as well.

Rows are summed together by summing individual columns. By default columns are summed by
adding one column value to another. Some columns cannot be aggregated this way. In these
cases, the [COLUMN_AGGREGATION_OPS_METADATA_NAME](#COLUMN_AGGREGATION_OPS_METADATA_NAME)
metadata can be used to specify a different type of operation.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$tableToSum` ([`DataTable`](../Piwik/DataTable.md))
- It does not return anything.

### `getRowFromLabel()` <a name="getRowFromLabel"></a>

Returns the Row whose `&#039;label&#039;` column is equal to `$label`.

#### Description

This method executes in constant time except for the first call which caches row
label =&gt; row ID mappings.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$label`
- _Returns:_ The row if found, false if otherwise.
    - [`Row`](../Piwik/DataTable/Row.md)
    - `Piwik\false`

### `getRowIdFromLabel()` <a name="getRowIdFromLabel"></a>

Returns the row id for the row whose `&#039;label&#039;` column is equal to `$label`.

#### Description

This method executes in constant time except for the first call which caches row
label =&gt; row ID mappings.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$label`
- _Returns:_ The row ID.
    - `int`

### `getEmptyClone()` <a name="getEmptyClone"></a>

Returns an empty DataTable with the same metadata and queued filters as `$this` one.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$keepFilters`
- It returns a(n) [`DataTable`](../Piwik/DataTable.md) value.

### `getRowFromId()` <a name="getRowFromId"></a>

Returns a row by ID.

#### Description

The ID is either the index of the row or [ID_SUMMARY_ROW](#ID_SUMMARY_ROW).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$id`
- _Returns:_ The Row or false if not found.
    - [`Row`](../Piwik/DataTable/Row.md)
    - `Piwik\false`

### `getRowFromIdSubDataTable()` <a name="getRowFromIdSubDataTable"></a>

Returns the row that has a subtable with ID matching `$idSubtable`.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$idSubTable`
- _Returns:_ The row or false if not found
    - [`Row`](../Piwik/DataTable/Row.md)
    - `Piwik\false`

### `addRow()` <a name="addRow"></a>

Adds a row to this table.

#### Description

If [setMaximumAllowedRows](#setMaximumAllowedRows) was called and the current row count is 
at the maximum, the new row will be summed to the summary row. If there is no summary row,
this row is set as the summary row.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$row` ([`Row`](../Piwik/DataTable/Row.md))
- _Returns:_ `$row` or the summary row if we&#039;re at the maximum number of rows.
    - [`Row`](../Piwik/DataTable/Row.md)

### `addSummaryRow()` <a name="addSummaryRow"></a>

Sets the summary row.

#### Description

Note: A dataTable can have only one summary row.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$row` ([`Row`](../Piwik/DataTable/Row.md))
- _Returns:_ Returns `$row`.
    - [`Row`](../Piwik/DataTable/Row.md)

### `getId()` <a name="getId"></a>

Returns the DataTable ID.

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `addRowFromArray()` <a name="addRowFromArray"></a>

Adds a new row from an array.

#### Description

You can add Row metadata with this method.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$row`
- It does not return anything.

### `addRowFromSimpleArray()` <a name="addRowFromSimpleArray"></a>

Adds a new row a from an array of column values.

#### Description

Row metadata cannot be added with this method.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$row`
- It does not return anything.

### `getRows()` <a name="getRows"></a>

Returns the array of Rows.

#### Signature

- It is a **public** method.
- It returns a(n) [`Row[]`](../Piwik/DataTable/Row.md) value.

### `getColumn()` <a name="getColumn"></a>

Returns an array containing all column values for the requested column.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- _Returns:_ The array of column values.
    - `array`

### `getColumnsStartingWith()` <a name="getColumnsStartingWith"></a>

Returns an array containing all column values of columns whose name starts with `$name`.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$namePrefix`
- _Returns:_ The array of column values.
    - `array`

### `getColumns()` <a name="getColumns"></a>

Returns the list of columns the rows in this datatable contain.

#### Description

This will return the
columns of the first row with data and assume they occur in every other row as well.

Note: If column names still use their in-database INDEX values (@see Metrics), they
      will be converted to their string name in the array result.

#### Signature

- It is a **public** method.
- _Returns:_ Array of string column names.
    - `array`

### `getRowsMetadata()` <a name="getRowsMetadata"></a>

Returns an array containing the requested metadata value of each row.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- It returns a(n) `array` value.

### `getRowsCount()` <a name="getRowsCount"></a>

Returns the number of rows in the table including the summary row.

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `getFirstRow()` <a name="getFirstRow"></a>

Returns the first row of the DataTable.

#### Signature

- It is a **public** method.
- _Returns:_ The first row or `false` if it cannot be found.
    - [`Row`](../Piwik/DataTable/Row.md)
    - `Piwik\false`

### `getLastRow()` <a name="getLastRow"></a>

Returns the last row of the DataTable.

#### Description

If there is a summary row, it
will always be considered the last row.

#### Signature

- It is a **public** method.
- _Returns:_ The last row or `false` if it cannot be found.
    - [`Row`](../Piwik/DataTable/Row.md)
    - `Piwik\false`

### `getRowsCountRecursive()` <a name="getRowsCountRecursive"></a>

Returns the number of rows in this DataTable summed with the row count of each subtable in the DataTable hierarchy.

#### Description

This includes the subtables of subtables and further descendants.

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `deleteColumn()` <a name="deleteColumn"></a>

Delete a column by name in every row.

#### Description

This change is NOT applied recursively to all
subtables.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- It does not return anything.

### `__sleep()` <a name="__sleep"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

### `renameColumn()` <a name="renameColumn"></a>

Rename a column in every row.

#### Description

This change is applied recursively to all subtables.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$oldName`
    - `$newName`
- It does not return anything.

### `deleteColumns()` <a name="deleteColumns"></a>

Deletes several columns by name in every row.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$names`
    - `$deleteRecursiveInSubtables`
- It does not return anything.

### `deleteRow()` <a name="deleteRow"></a>

Deletes a row by ID.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$id`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the row `$id` cannot be found.

### `deleteRowsOffset()` <a name="deleteRowsOffset"></a>

Deletes rows from `$offset` to `$offset + $limit`.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$offset`
    - `$limit`
- _Returns:_ The number of rows deleted.
    - `int`

### `deleteRows()` <a name="deleteRows"></a>

Deletes a set of rows by ID.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$rowIds` (`array`)
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If a row ID cannot be found.

### `__toString()` <a name="__toString"></a>

Returns a string representation of this DataTable for convenient viewing.

#### Description

Note: This uses the Html DataTable renderer.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `isEqual()` <a name="isEqual"></a>

Returns true if both DataTable instances are exactly the same.

#### Description

DataTables are equal if they have the same number of rows, if
each row has a label that exists in the other table, and if each row
is equal to the row in the other table with the same label. The order
of rows is not important.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$table1` ([`DataTable`](../Piwik/DataTable.md))
    - `$table2` ([`DataTable`](../Piwik/DataTable.md))
- It returns a(n) `bool` value.

### `getSerialized()` <a name="getSerialized"></a>

Serializes an entire DataTable hierarchy and returns the array of serialized DataTables.

#### Description

The first element in the returned array will be the serialized representation of this DataTable.
Every subsequent element will be a serialized subtable.

This DataTable and subtables can optionally be truncated before being serialized. In most
cases where DataTables can become quite large, they should be truncated before being persisted
in an archive.

The result of this method is intended for use with the [ArchiveProcessor::insertBlobRecord](#) method.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$maximumRowsInDataTable`
    - `$maximumRowsInSubDataTable`
    - `$columnToSortByBeforeTruncation`
- _Returns:_ The array of serialized DataTables: array( // this DataTable (the root) 0 =&gt; &#039;eghuighahgaueytae78yaet7yaetae&#039;, // a subtable 1 =&gt; &#039;gaegae gh gwrh guiwh uigwhuige&#039;, // another subtable 2 =&gt; &#039;gqegJHUIGHEQjkgneqjgnqeugUGEQHGUHQE&#039;, // etc. );
    - `array`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If infinite recursion detected. This will occur if a table&#039;s subtable is one of its parent tables.

### `addRowsFromSerializedArray()` <a name="addRowsFromSerializedArray"></a>

Adds a set of rows from a serialized DataTable string.

#### Description

See [serialize](#serialize).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$stringSerialized`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if `$stringSerialized` is invalid.

### `addRowsFromArray()` <a name="addRowsFromArray"></a>

Adds many rows from an array.

#### Description

You can add Row metadata with this method.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$array`
- It does not return anything.

### `addRowsFromSimpleArray()` <a name="addRowsFromSimpleArray"></a>

Adds many rows from an array containing arrays of column values.

#### Description

Row metadata cannot be added with this method.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$array`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `makeFromIndexedArray()` <a name="makeFromIndexedArray"></a>

Rewrites the input $array array (     LABEL =&gt; array(col1 =&gt; X, col2 =&gt; Y),     LABEL2 =&gt; array(col1 =&gt; X, col2 =&gt; Y), ) to a DataTable, ie.

#### Description

with the internal structure
array (
    array( Row::COLUMNS =&gt; array(&#039;label&#039; =&gt; LABEL, col1 =&gt; X, col2 =&gt; Y)),
    array( Row::COLUMNS =&gt; array(&#039;label&#039; =&gt; LABEL2, col1 =&gt; X, col2 =&gt; Y)),
)

It also works with array having only one value per row, eg.
array (
    LABEL =&gt; X,
    LABEL2 =&gt; Y,
)
would be converted to:
array (
    array( Row::COLUMNS =&gt; array(&#039;label&#039; =&gt; LABEL, &#039;value&#039; =&gt; X)),
    array( Row::COLUMNS =&gt; array(&#039;label&#039; =&gt; LABEL2, &#039;value&#039; =&gt; Y)),
)

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$array`
    - `$subtablePerLabel`
- It returns a(n) [`DataTable`](../Piwik/DataTable.md) value.

### `setMaximumDepthLevelAllowedAtLeast()` <a name="setMaximumDepthLevelAllowedAtLeast"></a>

Sets the maximum depth level to at least a certain value.

#### Description

If the current value is
greater than the supplied level, the maximum nesting level is not changed.

The maximum depth level determines the maximum number of subtable levels in the
DataTable tree. For example, if it is set to `2`, this DataTable is allowed to
have subtables, but the subtables are not.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$atLeastLevel`
- It does not return anything.

### `getMetadata()` <a name="getMetadata"></a>

Returns metadata by name.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- _Returns:_ The metadata value or false if it cannot be found.
    - `mixed`
    - `Piwik\false`

### `setMetadata()` <a name="setMetadata"></a>

Sets a metadata value by name.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$value`
- It does not return anything.

### `getAllTableMetadata()` <a name="getAllTableMetadata"></a>

Returns all table metadata.

#### Signature

- It is a **public** method.
- It returns a(n) `array` value.

### `setMetadataValues()` <a name="setMetadataValues"></a>

Sets several metadata values by name.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$values`
- It does not return anything.

### `setAllTableMetadata()` <a name="setAllTableMetadata"></a>

Sets metadata erasing existing values.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$metadata`
- It does not return anything.

### `setMaximumAllowedRows()` <a name="setMaximumAllowedRows"></a>

Sets the maximum number of rows allowed in this datatable (including the summary row).

#### Description

If adding more then the allowed number of rows is attempted, the extra
rows are summed to the summary row.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$maximumAllowedRows`
- It does not return anything.

### `walkPath()` <a name="walkPath"></a>

Traverses a DataTable tree using an array of labels and returns the row it finds or false if it cannot find one, and the number of segments of the path successfully walked.

#### Description

If $missingRowColumns is supplied, the specified path is created. When
a subtable is encountered w/o the queried label, a new row is created
with the label, and a subtable is added to the row.

Read [http://en.wikipedia.org/wiki/Tree_(data_structure)#Traversal_methods](http://en.wikipedia.org/wiki/Tree_(data_structure)#Traversal_methods)
for more information about tree walking.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$path`
    - `$missingRowColumns`
    - `$maxSubtableRows`
- _Returns:_ First element is the found row or false. Second element is the number of path segments walked. If a row is found, this will be == to count($path). Otherwise, it will be the index of the path segment that we could not find.
    - `array`

### `mergeSubtables()` <a name="mergeSubtables"></a>

Returns a new DataTable in which the rows of this table are replaced with its subtable&#039;s rows.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$labelColumn`
    - `$useMetadataColumn`
- It returns a(n) [`DataTable`](../Piwik/DataTable.md) value.

### `makeFromSimpleArray()` <a name="makeFromSimpleArray"></a>

Returns a new DataTable created with data from a &#039;simple&#039; array.

#### Description

See [addRowsFromSimpleArray](#addRowsFromSimpleArray).

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$array`
- It returns a(n) [`DataTable`](../Piwik/DataTable.md) value.

### `fromSerializedArray()` <a name="fromSerializedArray"></a>

Creates a new DataTable instance from a serialized DataTable string.

#### Description

See [getSerialized](#getSerialized) and [addRowsFromSerializedArray](#addRowsFromSerializedArray)
for more information on DataTable serialization.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$data`
- It returns a(n) [`DataTable`](../Piwik/DataTable.md) value.

