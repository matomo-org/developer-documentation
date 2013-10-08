<small>Piwik</small>

DataTable
=========

---- DataTable A DataTable is a data structure used to store complex tables of data.

Description
-----------

A DataTable is composed of multiple DataTable\Row.
A DataTable can be applied one or several DataTable_Filter.
A DataTable can be given to a DataTable_Renderer that would export the data under a given format (XML, HTML, etc.).

A DataTable has the following features:
- serializable to be stored in the DB
- loadable from the serialized version
- efficient way of loading data from an external source (from a PHP array structure)
- very simple interface to get data from the table

---- DataTable\Row
A DataTableRow in the table is defined by
- multiple columns (a label, multiple values, ...)
- optional metadata
- optional - a sub DataTable associated to this row

Simple row example:
- columns = array(   &#039;label&#039; =&gt; &#039;Firefox&#039;,
                       &#039;visitors&#039; =&gt; 155,
                       &#039;pages&#039; =&gt; 214,
                       &#039;bounce_rate&#039; =&gt; 67)
- metadata = array(&#039;logo&#039; =&gt; &#039;/plugins/UserSettings/images/browsers/FF.gif&#039;)
- no sub DataTable

A more complex example would be a DataTable\Row that is associated to a sub DataTable.
For example, for the row of the search engine Google,
we want to get the list of keywords associated, with their statistics.
- columns = array(   &#039;label&#039; =&gt; &#039;Google&#039;,
                       &#039;visits&#039; =&gt; 1550,
                       &#039;visits_length&#039; =&gt; 514214,
                       &#039;returning_visits&#039; =&gt; 77)
- metadata = array(    &#039;logo&#039; =&gt; &#039;/plugins/Referrers/images/searchEngines/google.com.png&#039;,
                       &#039;url&#039; =&gt; &#039;http://google.com&#039;)
- DataTable = DataTable containing several DataTable\Row containing the keywords information for this search engine
           Example of one DataTable\Row
           - the keyword columns specific to this search engine =
                   array(  &#039;label&#039; =&gt; &#039;Piwik&#039;, // the keyword
                           &#039;visitors&#039; =&gt; 155,  // Piwik has been searched on Google by 155 visitors
                           &#039;pages&#039; =&gt; 214 // Visitors coming from Google with the kwd Piwik have seen 214 pages
                   )
           - the keyword metadata = array() // nothing here, but we could imagining storing the URL of the search in Google for example
           - no subTable


---- DataTable_Filter
A DataTable_Filter is a applied to a DataTable and so
can filter information in the multiple DataTable\Row.

For example a DataTable_Filter can:
- remove rows from the table,
       for example the rows&#039; labels that do not match a given searched pattern
       for example the rows&#039; values that are less than a given percentage (low population)
- return a subset of the DataTable
       for example a function that apply a limit: $offset, $limit
- add / remove columns
       for example adding a column that gives the percentage of a given value
- add some metadata
       for example the &#039;logo&#039; path if the filter detects the logo
- edit the value, the label
- change the rows order
       for example if we want to sort by Label alphabetical order, or by any column value

When several DataTable_Filter are to be applied to a DataTable they are applied sequentially.
A DataTable_Filter is assigned a priority.
For example, filters that
   - sort rows should be applied with the highest priority
   - remove rows should be applied with a high priority as they prune the data and improve performance.

---- Code example

$table = new DataTable();
$table-&gt;addRowsFromArray( array(...) );

# sort the table by visits asc
$filter = new DataTable_Filter_Sort( $table, &#039;visits&#039;, &#039;asc&#039;);
$tableFiltered = $filter-&gt;getTableFiltered();

# add a filter to select only the website with a label matching &#039;*.com&#039; (regular expression)
$filter = new DataTable_Filter_Pattern( $table, &#039;label&#039;, &#039;*(.com)&#039;);
$tableFiltered = $filter-&gt;getTableFiltered();

# keep the 20 elements from offset 15
$filter = new DataTable_Filter_Limit( $tableFiltered, 15, 20);
$tableFiltered = $filter-&gt;getTableFiltered();

# add a column computing the percentage of visits
# params = table, column containing the value, new column name to add, number of total visits to use to compute the %
$filter = new DataTable_Filter_AddColumnPercentage( $tableFiltered, &#039;visits&#039;, &#039;visits_percentage&#039;, 2042);
$tableFiltered = $filter-&gt;getTableFiltered();

# we get the table as XML
$xmlOutput = new DataTable_Exporter_Xml( $table );
$xmlOutput-&gt;setHeader( ... );
$xmlOutput-&gt;setColumnsToExport( array(&#039;visits&#039;, &#039;visits_percent&#039;, &#039;label&#039;) );
$XMLstring = $xmlOutput-&gt;getOutput();


---- Other (ideas)
We can also imagine building a DataTable_Compare which would take N DataTable that have the same
structure and would compare them, by computing the percentages of differences, etc.

For example
DataTable1 = [ keyword1, 1550 visits]
               [ keyword2, 154 visits ]
DataTable2 = [ keyword1, 1004 visits ]
               [ keyword3, 659 visits ]
DataTable_Compare = result of comparison of table1 with table2
                       [ keyword1, +154% ]
                       [ keyword2, +1000% ]
                       [ keyword3, -430% ]


Constants
---------

This class defines the following constants:

- [`ARCHIVED_DATE_METADATA_NAME`](#ARCHIVED_DATE_METADATA_NAME) &mdash; Name for metadata that describes when a report was archived.
- [`MAX_DEPTH_DEFAULT`](#MAX_DEPTH_DEFAULT)
- [`EMPTY_COLUMNS_METADATA_NAME`](#EMPTY_COLUMNS_METADATA_NAME) &mdash; Name for metadata that describes which columns are empty and should not be shown.
- [`ID_SUMMARY_ROW`](#ID_SUMMARY_ROW)
- [`LABEL_SUMMARY_ROW`](#LABEL_SUMMARY_ROW)

Properties
----------

This class defines the following properties:

- [`$metadata`](#$metadata) &mdash; Table metadata.

### `$metadata` <a name="metadata"></a>

Table metadata.

#### Signature

- It is a **public** property.
- It is a(n) `array` value.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Builds the DataTable, registers itself to the manager
- [`__destruct()`](#__destruct) &mdash; At destruction we free all memory
- [`sort()`](#sort) &mdash; Sort the dataTable rows using the php callback function
- [`getSortedByColumnName()`](#getSortedByColumnName) &mdash; Returns the name of the column the tables is sorted by
- [`enableRecursiveSort()`](#enableRecursiveSort) &mdash; Enables the recursive sort.
- [`enableRecursiveFilters()`](#enableRecursiveFilters) &mdash; Enables the recursive filter.
- [`getRowsCountBeforeLimitFilter()`](#getRowsCountBeforeLimitFilter) &mdash; Returns the number of rows before we applied the limit filter
- [`setRowsCountBeforeLimitFilter()`](#setRowsCountBeforeLimitFilter) &mdash; Saves the current number of rows
- [`filter()`](#filter) &mdash; Apply a filter to this datatable
- [`queueFilter()`](#queueFilter) &mdash; Queue a DataTable_Filter that will be applied when applyQueuedFilters() is called.
- [`applyQueuedFilters()`](#applyQueuedFilters) &mdash; Apply all filters that were previously queued to this table
- [`addDataTable()`](#addDataTable) &mdash; Adds a new DataTable to this DataTable Go through all the rows of the new DataTable and applies the algorithm: - if a row in $table doesnt exist in $this we add the new row to $this - if a row exists in both $table and $this we sum the columns values into $this - if a row in $this doesnt exist in $table we add in $this the row of $table without modification
- [`getRowFromLabel()`](#getRowFromLabel) &mdash; Returns the Row that has a column &#039;label&#039; with the value $label
- [`getRowIdFromLabel()`](#getRowIdFromLabel) &mdash; Returns the row id for the givel label
- [`getEmptyClone()`](#getEmptyClone) &mdash; Get an empty table with the same properties as this one
- [`getRowFromId()`](#getRowFromId) &mdash; Returns the ith row in the array
- [`getRowFromIdSubDataTable()`](#getRowFromIdSubDataTable) &mdash; Returns a row that has the subtable ID matching the parameter
- [`addRow()`](#addRow) &mdash; Add a row to the table and rebuild the index if necessary
- [`addSummaryRow()`](#addSummaryRow) &mdash; Sets the summary row (a dataTable can have only one summary row)
- [`getId()`](#getId) &mdash; Returns the dataTable ID
- [`addRowFromArray()`](#addRowFromArray) &mdash; Adds a new row from a PHP array data structure
- [`addRowFromSimpleArray()`](#addRowFromSimpleArray) &mdash; Adds a new row a PHP array data structure
- [`getRows()`](#getRows) &mdash; Returns the array of Row
- [`getColumn()`](#getColumn) &mdash; Returns the array containing all rows values for the requested column
- [`getColumnsStartingWith()`](#getColumnsStartingWith) &mdash; Returns  the array containing all rows values of all columns which name starts with $name
- [`getColumns()`](#getColumns) &mdash; Returns the list of columns the rows in this datatable contain.
- [`getRowsMetadata()`](#getRowsMetadata) &mdash; Returns an array containing the rows Metadata values
- [`getRowsCount()`](#getRowsCount) &mdash; Returns the number of rows in the table
- [`getFirstRow()`](#getFirstRow) &mdash; Returns the first row of the DataTable
- [`getLastRow()`](#getLastRow) &mdash; Returns the last row of the DataTable
- [`getRowsCountRecursive()`](#getRowsCountRecursive) &mdash; Returns the sum of the number of rows of all the subtables        + the number of rows in the parent table
- [`deleteColumn()`](#deleteColumn) &mdash; Delete a given column $name in all the rows
- [`__sleep()`](#__sleep)
- [`renameColumn()`](#renameColumn) &mdash; Rename a column in all rows
- [`deleteColumns()`](#deleteColumns) &mdash; Delete columns by name in all rows
- [`deleteRow()`](#deleteRow) &mdash; Deletes the ith row
- [`deleteRowsOffset()`](#deleteRowsOffset) &mdash; Deletes all row from offset, offset + limit.
- [`deleteRows()`](#deleteRows) &mdash; Deletes the rows from the list of rows ID
- [`__toString()`](#__toString) &mdash; Returns a simple output of the DataTable for easy visualization Example: echo $datatable;
- [`isEqual()`](#isEqual) &mdash; Returns true if both DataTable are exactly the same.
- [`getSerialized()`](#getSerialized) &mdash; The serialization returns a one dimension array containing all the serialized DataTable contained in this DataTable.
- [`addRowsFromSerializedArray()`](#addRowsFromSerializedArray) &mdash; Load a serialized string of a datatable.
- [`addRowsFromArray()`](#addRowsFromArray) &mdash; Loads the DataTable from a PHP array data structure
- [`addRowsFromSimpleArray()`](#addRowsFromSimpleArray) &mdash; Loads the data from a simple php array.
- [`makeFromIndexedArray()`](#makeFromIndexedArray) &mdash; Rewrites the input $array array (     LABEL =&gt; array(col1 =&gt; X, col2 =&gt; Y),     LABEL2 =&gt; array(col1 =&gt; X, col2 =&gt; Y), ) to a DataTable, ie.
- [`setMaximumDepthLevelAllowedAtLeast()`](#setMaximumDepthLevelAllowedAtLeast) &mdash; Sets the maximum nesting level to at least a certain value.
- [`getAllTableMetadata()`](#getAllTableMetadata) &mdash; Returns all table metadata.
- [`getMetadata()`](#getMetadata) &mdash; Returns metadata by name.
- [`setMetadata()`](#setMetadata) &mdash; Sets a metadata value by name.
- [`setMaximumAllowedRows()`](#setMaximumAllowedRows) &mdash; Sets the maximum number of rows allowed in this datatable (including the summary row).
- [`walkPath()`](#walkPath) &mdash; Traverses a DataTable tree using an array of labels and returns the row it finds or false if it cannot find one, and the number of segments of the path successfully walked.
- [`mergeSubtables()`](#mergeSubtables) &mdash; Returns a new DataTable that contains the rows of each of this table&#039;s subtables.
- [`makeFromSimpleArray()`](#makeFromSimpleArray) &mdash; Returns a new DataTable created with data from a &#039;simple&#039; array.
- [`setColumnAggregationOperation()`](#setColumnAggregationOperation) &mdash; Set the aggregation operation for a column, e.g.
- [`setColumnAggregationOperations()`](#setColumnAggregationOperations) &mdash; Set multiple aggregation operations at once.
- [`getColumnAggregationOperations()`](#getColumnAggregationOperations) &mdash; Get the configured column aggregation operations
- [`fromSerializedArray()`](#fromSerializedArray) &mdash; Creates a new DataTable instance from a serialize()&#039;d array of rows.

### `__construct()` <a name="__construct"></a>

Builds the DataTable, registers itself to the manager

#### Signature

- It is a **public** method.
- It does not return anything.

### `__destruct()` <a name="__destruct"></a>

At destruction we free all memory

#### Signature

- It is a **public** method.
- It does not return anything.

### `sort()` <a name="sort"></a>

Sort the dataTable rows using the php callback function

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$functionCallback`
    - `$columnSortedBy`
- It does not return anything.

### `getSortedByColumnName()` <a name="getSortedByColumnName"></a>

Returns the name of the column the tables is sorted by

#### Signature

- It is a **public** method.
- It can return one of the following values:
    - `bool`
    - `string`

### `enableRecursiveSort()` <a name="enableRecursiveSort"></a>

Enables the recursive sort.

#### Description

Means that when using $table-&gt;sort()
it will also sort all subtables using the same callback

#### Signature

- It is a **public** method.
- It does not return anything.

### `enableRecursiveFilters()` <a name="enableRecursiveFilters"></a>

Enables the recursive filter.

#### Description

Means that when using $table-&gt;filter()
it will also filter all subtables using the same callback

#### Signature

- It is a **public** method.
- It does not return anything.

### `getRowsCountBeforeLimitFilter()` <a name="getRowsCountBeforeLimitFilter"></a>

Returns the number of rows before we applied the limit filter

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `setRowsCountBeforeLimitFilter()` <a name="setRowsCountBeforeLimitFilter"></a>

Saves the current number of rows

#### Signature

- It is a **public** method.
- It does not return anything.

### `filter()` <a name="filter"></a>

Apply a filter to this datatable

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$className`
    - `$parameters`
- It does not return anything.

### `queueFilter()` <a name="queueFilter"></a>

Queue a DataTable_Filter that will be applied when applyQueuedFilters() is called.

#### Description

(just before sending the datatable back to the browser (or API, etc.)

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$className`
    - `$parameters`
- It does not return anything.

### `applyQueuedFilters()` <a name="applyQueuedFilters"></a>

Apply all filters that were previously queued to this table

#### See Also

- `queueFilter()`

#### Signature

- It is a **public** method.
- It does not return anything.

### `addDataTable()` <a name="addDataTable"></a>

Adds a new DataTable to this DataTable Go through all the rows of the new DataTable and applies the algorithm: - if a row in $table doesnt exist in $this we add the new row to $this - if a row exists in both $table and $this we sum the columns values into $this - if a row in $this doesnt exist in $table we add in $this the row of $table without modification

#### Description

A common row to 2 DataTable is defined by the same label

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$tableToSum` ([`DataTable`](../Piwik/DataTable.md))
- It does not return anything.

### `getRowFromLabel()` <a name="getRowFromLabel"></a>

Returns the Row that has a column &#039;label&#039; with the value $label

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$label`
- _Returns:_ The row if found, false otherwise
    - [`Row`](../Piwik/DataTable/Row.md)
    - `bool`

### `getRowIdFromLabel()` <a name="getRowIdFromLabel"></a>

Returns the row id for the givel label

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$label`
- It can return one of the following values:
    - `int`
    - [`Row`](../Piwik/DataTable/Row.md)

### `getEmptyClone()` <a name="getEmptyClone"></a>

Get an empty table with the same properties as this one

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$keepFilters`
- It returns a(n) [`DataTable`](../Piwik/DataTable.md) value.

### `getRowFromId()` <a name="getRowFromId"></a>

Returns the ith row in the array

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$id`
- _Returns:_ or false if not found
    - [`Row`](../Piwik/DataTable/Row.md)

### `getRowFromIdSubDataTable()` <a name="getRowFromIdSubDataTable"></a>

Returns a row that has the subtable ID matching the parameter

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$idSubTable`
- _Returns:_ false if not found
    - [`Row`](../Piwik/DataTable/Row.md)
    - `bool`

### `addRow()` <a name="addRow"></a>

Add a row to the table and rebuild the index if necessary

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$row` ([`Row`](../Piwik/DataTable/Row.md))
- It returns a(n) [`Row`](../Piwik/DataTable/Row.md) value.

### `addSummaryRow()` <a name="addSummaryRow"></a>

Sets the summary row (a dataTable can have only one summary row)

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$row` ([`Row`](../Piwik/DataTable/Row.md))
- _Returns:_ Returns $row.
    - [`Row`](../Piwik/DataTable/Row.md)

### `getId()` <a name="getId"></a>

Returns the dataTable ID

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `addRowFromArray()` <a name="addRowFromArray"></a>

Adds a new row from a PHP array data structure

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$row`
- It does not return anything.

### `addRowFromSimpleArray()` <a name="addRowFromSimpleArray"></a>

Adds a new row a PHP array data structure

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$row`
- It does not return anything.

### `getRows()` <a name="getRows"></a>

Returns the array of Row

#### Signature

- It is a **public** method.
- It returns a(n) [`Row[]`](../Piwik/DataTable/Row.md) value.

### `getColumn()` <a name="getColumn"></a>

Returns the array containing all rows values for the requested column

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- It returns a(n) `array` value.

### `getColumnsStartingWith()` <a name="getColumnsStartingWith"></a>

Returns  the array containing all rows values of all columns which name starts with $name

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- It returns a(n) `array` value.

### `getColumns()` <a name="getColumns"></a>

Returns the list of columns the rows in this datatable contain.

#### Description

This will return the
columns of the first row with data and assume they occur in every other row as well.

#### Signature

- It is a **public** method.
- It returns a(n) `array` value.

### `getRowsMetadata()` <a name="getRowsMetadata"></a>

Returns an array containing the rows Metadata values

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- It returns a(n) `array` value.

### `getRowsCount()` <a name="getRowsCount"></a>

Returns the number of rows in the table

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `getFirstRow()` <a name="getFirstRow"></a>

Returns the first row of the DataTable

#### Signature

- It is a **public** method.
- It returns a(n) [`Row`](../Piwik/DataTable/Row.md) value.

### `getLastRow()` <a name="getLastRow"></a>

Returns the last row of the DataTable

#### Signature

- It is a **public** method.
- It returns a(n) [`Row`](../Piwik/DataTable/Row.md) value.

### `getRowsCountRecursive()` <a name="getRowsCountRecursive"></a>

Returns the sum of the number of rows of all the subtables        + the number of rows in the parent table

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `deleteColumn()` <a name="deleteColumn"></a>

Delete a given column $name in all the rows

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

Rename a column in all rows

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$oldName`
    - `$newName`
- It does not return anything.

### `deleteColumns()` <a name="deleteColumns"></a>

Delete columns by name in all rows

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$names`
    - `$deleteRecursiveInSubtables`
- It does not return anything.

### `deleteRow()` <a name="deleteRow"></a>

Deletes the ith row

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$id`
- It returns a(n) `void` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the row $id cannot be found

### `deleteRowsOffset()` <a name="deleteRowsOffset"></a>

Deletes all row from offset, offset + limit.

#### Description

If limit is null then limit = $table-&gt;getRowsCount()

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$offset`
    - `$limit`
- It returns a(n) `int` value.

### `deleteRows()` <a name="deleteRows"></a>

Deletes the rows from the list of rows ID

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$aKeys` (`array`)
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if any of the row to delete couldn&#039;t be found

### `__toString()` <a name="__toString"></a>

Returns a simple output of the DataTable for easy visualization Example: echo $datatable;

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `isEqual()` <a name="isEqual"></a>

Returns true if both DataTable are exactly the same.

#### Description

Used in unit tests.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$table1` ([`DataTable`](../Piwik/DataTable.md))
    - `$table2` ([`DataTable`](../Piwik/DataTable.md))
- It returns a(n) `bool` value.

### `getSerialized()` <a name="getSerialized"></a>

The serialization returns a one dimension array containing all the serialized DataTable contained in this DataTable.

#### Description

We save DataTable in serialized format in the Database.
Each row of this returned PHP array will be a row in the DB table.
At the end of the method execution, the dataTable may be truncated (if $maximum* parameters are set).

The keys of the array are very important as they are used to define the DataTable

IMPORTANT: The main table (level 0, parent of all tables) will always be indexed by 0
   even it was created after some other tables.
   It also means that all the parent tables (level 0) will be indexed with 0 in their respective
 serialized arrays. You should never lookup a parent table using the getTable( $id = 0) as it
 won&#039;t work.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$maximumRowsInDataTable`
    - `$maximumRowsInSubDataTable`
    - `$columnToSortByBeforeTruncation`
- _Returns:_ Serialized arrays array(    // Datatable level0 0 =&gt; &#039;eghuighahgaueytae78yaet7yaetae&#039;, // first Datatable level1 1 =&gt; &#039;gaegae gh gwrh guiwh uigwhuige&#039;, //second Datatable level1 2 =&gt; &#039;gqegJHUIGHEQjkgneqjgnqeugUGEQHGUHQE&#039;, //first Datatable level3 (child of second Datatable level1 for example) 3 =&gt; &#039;eghuighahgaueytae78yaet7yaetaeGRQWUBGUIQGH&amp;QE&#039;, );
    - `array`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if an infinite recursion is found (a table row&#039;s has a subtable that is one of its parent table)

### `addRowsFromSerializedArray()` <a name="addRowsFromSerializedArray"></a>

Load a serialized string of a datatable.

#### Description

Does not load recursively all the sub DataTable.
They will be loaded only when requesting them specifically.

The function creates all the necessary DataTable\Row

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$stringSerialized`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `addRowsFromArray()` <a name="addRowsFromArray"></a>

Loads the DataTable from a PHP array data structure

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$array`
- It does not return anything.

### `addRowsFromSimpleArray()` <a name="addRowsFromSimpleArray"></a>

Loads the data from a simple php array.

#### Description

Basically maps a simple multidimensional php array to a DataTable.
Not recursive (if a row contains a php array itself, it won&#039;t be loaded)

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$array`
- It returns a(n) `void` value.
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

Sets the maximum nesting level to at least a certain value.

#### Description

If the current value is
greater than the supplied level, the maximum nesting level is not changed.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$atLeastLevel`
- It does not return anything.

### `getAllTableMetadata()` <a name="getAllTableMetadata"></a>

Returns all table metadata.

#### Signature

- It is a **public** method.
- It returns a(n) `array` value.

### `getMetadata()` <a name="getMetadata"></a>

Returns metadata by name.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- It returns a(n) `mixed` value.

### `setMetadata()` <a name="setMetadata"></a>

Sets a metadata value by name.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$value`
- It does not return anything.

### `setMaximumAllowedRows()` <a name="setMaximumAllowedRows"></a>

Sets the maximum number of rows allowed in this datatable (including the summary row).

#### Description

If adding more then the allowed number of rows is attempted, the extra
rows are added to the summary row.

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

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$path`
    - `$missingRowColumns`
    - `$maxSubtableRows`
- _Returns:_ First element is the found row or false. Second element is the number of path segments walked. If a row is found, this will be == to count($path). Otherwise, it will be the index of the path segment that we could not find.
    - `array`

### `mergeSubtables()` <a name="mergeSubtables"></a>

Returns a new DataTable that contains the rows of each of this table&#039;s subtables.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$labelColumn`
    - `$useMetadataColumn`
- It returns a(n) [`DataTable`](../Piwik/DataTable.md) value.

### `makeFromSimpleArray()` <a name="makeFromSimpleArray"></a>

Returns a new DataTable created with data from a &#039;simple&#039; array.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$array`
- It returns a(n) [`DataTable`](../Piwik/DataTable.md) value.

### `setColumnAggregationOperation()` <a name="setColumnAggregationOperation"></a>

Set the aggregation operation for a column, e.g.

#### Description

&quot;min&quot;.

#### See Also

- `self::addDataTable()` &mdash; and DataTable\Row::sumRow()

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$columnName`
    - `$operation`
- It does not return anything.

### `setColumnAggregationOperations()` <a name="setColumnAggregationOperations"></a>

Set multiple aggregation operations at once.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$operations`
- It does not return anything.

### `getColumnAggregationOperations()` <a name="getColumnAggregationOperations"></a>

Get the configured column aggregation operations

#### Signature

- It is a **public** method.
- It does not return anything.

### `fromSerializedArray()` <a name="fromSerializedArray"></a>

Creates a new DataTable instance from a serialize()&#039;d array of rows.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$data`
- It returns a(n) [`DataTable`](../Piwik/DataTable.md) value.

