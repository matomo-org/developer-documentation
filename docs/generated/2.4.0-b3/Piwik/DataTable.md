<small>Piwik\</small>

DataTable
=========

The primary data structure used to store analytics data in Piwik.

<a name="class-desc-the-basics"></a>
### The Basics

DataTables consist of rows and each row consists of columns. A column value can be
a numeric, a string or an array.

Every row has an ID. The ID is either the index of the row or `ID_SUMMARY_ROW`.

DataTables are hierarchical data structures. Each row can also contain an additional
nested sub-DataTable (commonly referred to as a 'subtable').

Both DataTables and DataTable rows can hold **metadata**. _DataTable metadata_ is information
regarding all the data, such as the site or period that the data is for. _Row metadata_
is information regarding that row, such as a browser logo or website URL.

Finally, all DataTables contain a special _summary_ row. This row, if it exists, is
always at the end of the DataTable.

### Populating DataTables

Data can be added to DataTables in three different ways. You can either:

1. create rows one by one and add them through [addRow()](/api-reference/Piwik/DataTable#addrow) then truncate if desired,
2. create an array of DataTable\Row instances or an array of arrays and add them using
   [addRowsFromArray()](/api-reference/Piwik/DataTable#addrowsfromarray) or [addRowsFromSimpleArray()](/api-reference/Piwik/DataTable#addrowsfromsimplearray)
   then truncate if desired,
3. or set the maximum number of allowed rows (with [setMaximumAllowedRows()](/api-reference/Piwik/DataTable#setmaximumallowedrows))
   and add rows one by one.

If you want to eventually truncate your data (standard practice for all Piwik plugins),
the third method is the most memory efficient. It is, unfortunately, not always possible
to use since it requires that the data be sorted before adding.

### Manipulating DataTables

There are two ways to manipulate a DataTable. You can either:

1. manually iterate through each row and manipulate the data,
2. or you can use predefined filters.

A filter is a class that has a 'filter' method which will manipulate a DataTable in
some way. There are several predefined Filters that allow you to do common things,
such as,

- add a new column to each row,
- add new metadata to each row,
- modify an existing column value for each row,
- sort an entire DataTable,
- and more.

Using these filters instead of writing your own code will increase code clarity and
reduce code redundancy. Additionally, filters have the advantage that they can be
applied to DataTable\Map instances. So you can visit every DataTable in a [Map](/api-reference/Piwik/DataTable/Map)
without having to write a recursive visiting function.

All predefined filters exist in the **Piwik\DataTable\BaseFilter** namespace.

_Note: For convenience, [anonymous functions](http://www.php.net/manual/en/functions.anonymous.php)
can be used as DataTable filters._

### Applying Filters

Filters can be applied now (via [filter()](/api-reference/Piwik/DataTable#filter)), or they can be applied later (via
[queueFilter()](/api-reference/Piwik/DataTable#queuefilter)).

Filters that sort rows or manipulate the number of rows should be applied right away.
Non-essential, presentation filters should be queued.

### Learn more

- See **[ArchiveProcessor](/api-reference/Piwik/ArchiveProcessor)** to learn how DataTables are persisted.

### Examples

**Populating a DataTable**

    // adding one row at a time
    $dataTable = new DataTable();
    $dataTable->addRow(new Row(array(
        Row::COLUMNS => array('label' => 'thing1', 'nb_visits' => 1, 'nb_actions' => 1),
        Row::METADATA => array('url' => 'http://thing1.com')
    )));
    $dataTable->addRow(new Row(array(
        Row::COLUMNS => array('label' => 'thing2', 'nb_visits' => 2, 'nb_actions' => 2),
        Row::METADATA => array('url' => 'http://thing2.com')
    )));
    
    // using an array of rows
    $dataTable = new DataTable();
    $dataTable->addRowsFromArray(array(
        array(
            Row::COLUMNS => array('label' => 'thing1', 'nb_visits' => 1, 'nb_actions' => 1),
            Row::METADATA => array('url' => 'http://thing1.com')
        ),
        array(
            Row::COLUMNS => array('label' => 'thing2', 'nb_visits' => 2, 'nb_actions' => 2),
            Row::METADATA => array('url' => 'http://thing2.com')
        )
    ));

    // using a "simple" array
    $dataTable->addRowsFromSimpleArray(array(
        array('label' => 'thing1', 'nb_visits' => 1, 'nb_actions' => 1),
        array('label' => 'thing2', 'nb_visits' => 2, 'nb_actions' => 2)
    ));

**Getting & setting metadata**

    $dataTable = \Piwik\Plugins\Referrers\API::getInstance()->getSearchEngines($idSite = 1, $period = 'day', $date = '2007-07-24');
    $oldPeriod = $dataTable->metadata['period'];
    $dataTable->metadata['period'] = Period\Factory::build('week', Date::factory('2013-10-18'));

**Serializing & unserializing**

    $maxRowsInTable = Config::getInstance()->General['datatable_archiving_maximum_rows_standard'];j
    
    $dataTable = // ... build by aggregating visits ...
    $serializedData = $dataTable->getSerialized($maxRowsInTable, $maxRowsInSubtable = $maxRowsInTable,
                                                $columnToSortBy = Metrics::INDEX_NB_VISITS);
    
    $serializedDataTable = $serializedData[0];
    $serailizedSubTable = $serializedData[$idSubtable];

**Filtering for an API method**

    public function getMyReport($idSite, $period, $date, $segment = false, $expanded = false)
    {
        $dataTable = Archive::getDataTableFromArchive('MyPlugin_MyReport', $idSite, $period, $date, $segment, $expanded);
        $dataTable->filter('Sort', array(Metrics::INDEX_NB_VISITS, 'desc', $naturalSort = false, $expanded));
        $dataTable->queueFilter('ReplaceColumnNames');
        $dataTable->queueFilter('ColumnCallbackAddMetadata', array('label', 'url', __NAMESPACE__ . '\getUrlFromLabelForMyReport'));
        return $dataTable;
    }

Constants
---------

This class defines the following constants:

- [`COLUMN_AGGREGATION_OPS_METADATA_NAME`](#column_aggregation_ops_metadata_name) &mdash; Name for metadata that describes how individual columns should be aggregated when [addDataTable()](/api-reference/Piwik/DataTable#adddatatable) or [Row::sumRow()](/api-reference/Piwik/DataTable/Row#sumrow) is called.

<a name="column_aggregation_ops_metadata_name" id="column_aggregation_ops_metadata_name"></a>
<a name="COLUMN_AGGREGATION_OPS_METADATA_NAME" id="COLUMN_AGGREGATION_OPS_METADATA_NAME"></a>
### `COLUMN_AGGREGATION_OPS_METADATA_NAME`

This metadata value must be an array that maps column names with valid operations. Valid aggregation operations are:

- `'skip'`: do nothing
- `'max'`: does `max($column1, $column2)`
- `'min'`: does `min($column1, $column2)`
- `'sum'`: does `$column1 + $column2`

See [addDataTable()](/api-reference/Piwik/DataTable#adddatatable) and [Row::sumRow()](/api-reference/Piwik/DataTable/Row#sumrow) for more information.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`__destruct()`](#__destruct) &mdash; Destructor.
- [`sort()`](#sort) &mdash; Sorts the DataTable rows using the supplied callback function.
- [`getSortedByColumnName()`](#getsortedbycolumnname) &mdash; Returns the name of the column this table was sorted by (if any).
- [`enableRecursiveSort()`](#enablerecursivesort) &mdash; Enables recursive sorting.
- [`enableRecursiveFilters()`](#enablerecursivefilters) &mdash; Enables recursive filtering.
- [`filter()`](#filter) &mdash; Applies a filter to this datatable.
- [`queueFilter()`](#queuefilter) &mdash; Adds a filter and a list of parameters to the list of queued filters.
- [`applyQueuedFilters()`](#applyqueuedfilters) &mdash; Applies all filters that were previously queued to the table.
- [`addDataTable()`](#adddatatable) &mdash; Sums a DataTable to this one.
- [`getRowFromLabel()`](#getrowfromlabel) &mdash; Returns the Row whose `'label'` column is equal to `$label`.
- [`getRowIdFromLabel()`](#getrowidfromlabel) &mdash; Returns the row id for the row whose `'label'` column is equal to `$label`.
- [`getEmptyClone()`](#getemptyclone) &mdash; Returns an empty DataTable with the same metadata and queued filters as `$this` one.
- [`getRowFromId()`](#getrowfromid) &mdash; Returns a row by ID.
- [`getRowFromIdSubDataTable()`](#getrowfromidsubdatatable) &mdash; Returns the row that has a subtable with ID matching `$idSubtable`.
- [`addRow()`](#addrow) &mdash; Adds a row to this table.
- [`addSummaryRow()`](#addsummaryrow) &mdash; Sets the summary row.
- [`getId()`](#getid) &mdash; Returns the DataTable ID.
- [`addRowFromArray()`](#addrowfromarray) &mdash; Adds a new row from an array.
- [`addRowFromSimpleArray()`](#addrowfromsimplearray) &mdash; Adds a new row a from an array of column values.
- [`getRows()`](#getrows) &mdash; Returns the array of Rows.
- [`getColumn()`](#getcolumn) &mdash; Returns an array containing all column values for the requested column.
- [`getColumnsStartingWith()`](#getcolumnsstartingwith) &mdash; Returns an array containing all column values of columns whose name starts with `$name`.
- [`getColumns()`](#getcolumns) &mdash; Returns the names of every column this DataTable contains.
- [`getRowsMetadata()`](#getrowsmetadata) &mdash; Returns an array containing the requested metadata value of each row.
- [`getRowsCount()`](#getrowscount) &mdash; Returns the number of rows in the table including the summary row.
- [`getFirstRow()`](#getfirstrow) &mdash; Returns the first row of the DataTable.
- [`getLastRow()`](#getlastrow) &mdash; Returns the last row of the DataTable.
- [`getRowsCountRecursive()`](#getrowscountrecursive) &mdash; Returns the number of rows in the entire DataTable hierarchy.
- [`deleteColumn()`](#deletecolumn) &mdash; Delete a column by name in every row.
- [`__sleep()`](#__sleep)
- [`renameColumn()`](#renamecolumn) &mdash; Rename a column in every row.
- [`deleteColumns()`](#deletecolumns) &mdash; Deletes several columns by name in every row.
- [`deleteRow()`](#deleterow) &mdash; Deletes a row by ID.
- [`deleteRowsOffset()`](#deleterowsoffset) &mdash; Deletes rows from `$offset` to `$offset + $limit`.
- [`deleteRows()`](#deleterows) &mdash; Deletes a set of rows by ID.
- [`__toString()`](#__tostring) &mdash; Returns a string representation of this DataTable for convenient viewing.
- [`isEqual()`](#isequal) &mdash; Returns true if both DataTable instances are exactly the same.
- [`getSerialized()`](#getserialized) &mdash; Serializes an entire DataTable hierarchy and returns the array of serialized DataTables.
- [`addRowsFromSerializedArray()`](#addrowsfromserializedarray) &mdash; Adds a set of rows from a serialized DataTable string.
- [`addRowsFromArray()`](#addrowsfromarray) &mdash; Adds multiple rows from an array.
- [`addRowsFromSimpleArray()`](#addrowsfromsimplearray) &mdash; Adds multiple rows from an array containing arrays of column values.
- [`makeFromIndexedArray()`](#makefromindexedarray) &mdash; Rewrites the input `$array`      array (         LABEL => array(col1 => X, col2 => Y),         LABEL2 => array(col1 => X, col2 => Y),     )  to a DataTable with rows that look like:      array (         array( Row::COLUMNS => array('label' => LABEL, col1 => X, col2 => Y)),         array( Row::COLUMNS => array('label' => LABEL2, col1 => X, col2 => Y)),     )
- [`setMaximumDepthLevelAllowedAtLeast()`](#setmaximumdepthlevelallowedatleast) &mdash; Sets the maximum depth level to at least a certain value.
- [`getMetadata()`](#getmetadata) &mdash; Returns metadata by name.
- [`setMetadata()`](#setmetadata) &mdash; Sets a metadata value by name.
- [`getAllTableMetadata()`](#getalltablemetadata) &mdash; Returns all table metadata.
- [`setMetadataValues()`](#setmetadatavalues) &mdash; Sets several metadata values by name.
- [`setAllTableMetadata()`](#setalltablemetadata) &mdash; Sets metadata, erasing existing values.
- [`setMaximumAllowedRows()`](#setmaximumallowedrows) &mdash; Sets the maximum number of rows allowed in this datatable (including the summary row).
- [`walkPath()`](#walkpath) &mdash; Traverses a DataTable tree using an array of labels and returns the row it finds or `false` if it cannot find one.
- [`mergeSubtables()`](#mergesubtables) &mdash; Returns a new DataTable in which the rows of this table are replaced with the aggregatated rows of all its subtables.
- [`makeFromSimpleArray()`](#makefromsimplearray) &mdash; Returns a new DataTable created with data from a 'simple' array.
- [`fromSerializedArray()`](#fromserializedarray) &mdash; Creates a new DataTable instance from a serialized DataTable string.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

Creates an empty DataTable.

#### Signature


<a name="__destruct" id="__destruct"></a>
<a name="__destruct" id="__destruct"></a>
### `__destruct()`

Destructor.

Makes sure DataTable memory will be cleaned up.

#### Signature

- It does not return anything.

<a name="sort" id="sort"></a>
<a name="sort" id="sort"></a>
### `sort()`

Sorts the DataTable rows using the supplied callback function.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$functionCallback` (`string`) &mdash;

      <div markdown="1" class="param-desc"> A comparison callback compatible with usort.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$columnSortedBy` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The column name `$functionCallback` sorts by. This is stored so we can determine how the DataTable was sorted in the future.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="getsortedbycolumnname" id="getsortedbycolumnname"></a>
<a name="getSortedByColumnName" id="getSortedByColumnName"></a>
### `getSortedByColumnName()`

Returns the name of the column this table was sorted by (if any).

See [sort()](/api-reference/Piwik/DataTable#sort).

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`Piwik\false`|`string`) &mdash;
    <div markdown="1" class="param-desc">The sorted column name or false if none.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="enablerecursivesort" id="enablerecursivesort"></a>
<a name="enableRecursiveSort" id="enableRecursiveSort"></a>
### `enableRecursiveSort()`

Enables recursive sorting.

If this method is called [sort()](/api-reference/Piwik/DataTable#sort) will also sort all
subtables.

#### Signature

- It does not return anything.

<a name="enablerecursivefilters" id="enablerecursivefilters"></a>
<a name="enableRecursiveFilters" id="enableRecursiveFilters"></a>
### `enableRecursiveFilters()`

Enables recursive filtering.

If this method is called then the [filter()](/api-reference/Piwik/DataTable#filter) method
will apply filters to every subtable in addition to this instance.

#### Signature

- It does not return anything.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

Applies a filter to this datatable.

If [enableRecursiveFilters()](/api-reference/Piwik/DataTable#enablerecursivefilters) was called, the filter will be applied
to all subtables as well.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$className` (`string`|[`Closure`](http://php.net/class.Closure)) &mdash;

      <div markdown="1" class="param-desc"> Class name, eg. `"Sort"` or "Piwik\DataTable\Filters\Sort"`. If no namespace is supplied, `Piwik\DataTable\BaseFilter` is assumed. This parameter can also be a closure that takes a DataTable as its first parameter.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$parameters` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Array of extra parameters to pass to the filter.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="queuefilter" id="queuefilter"></a>
<a name="queueFilter" id="queueFilter"></a>
### `queueFilter()`

Adds a filter and a list of parameters to the list of queued filters.

These filters will be
executed when [applyQueuedFilters()](/api-reference/Piwik/DataTable#applyqueuedfilters) is called.

Filters that prettify the column values or don't need the full set of rows should be queued. This
way they will be run after the table is truncated which will result in better performance.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$className` (`string`|[`Closure`](http://php.net/class.Closure)) &mdash;

      <div markdown="1" class="param-desc"> The class name of the filter, eg. `'Limit'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$parameters` (`array`) &mdash;

      <div markdown="1" class="param-desc"> The parameters to give to the filter, eg. `array($offset, $limit)` for the Limit filter.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="applyqueuedfilters" id="applyqueuedfilters"></a>
<a name="applyQueuedFilters" id="applyQueuedFilters"></a>
### `applyQueuedFilters()`

Applies all filters that were previously queued to the table.

See [queueFilter()](/api-reference/Piwik/DataTable#queuefilter)
for more information.

#### Signature

- It does not return anything.

<a name="adddatatable" id="adddatatable"></a>
<a name="addDataTable" id="addDataTable"></a>
### `addDataTable()`

Sums a DataTable to this one.

This method will sum rows that have the same label. If a row is found in `$tableToSum` whose
label is not found in `$this`, the row will be added to `$this`.

If the subtables for this table are loaded, they will be summed as well.

Rows are summed together by summing individual columns. By default columns are summed by
adding one column value to another. Some columns cannot be aggregated this way. In these
cases, the `[COLUMN_AGGREGATION_OPS_METADATA_NAME](/api-reference/Piwik/DataTable#piwik\datatable::column_aggregation_ops_metadata_name)`
metadata can be used to specify a different type of operation.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$tableToSum` ([`DataTable`](../Piwik/DataTable.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$doAggregateSubTables`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="getrowfromlabel" id="getrowfromlabel"></a>
<a name="getRowFromLabel" id="getRowFromLabel"></a>
### `getRowFromLabel()`

Returns the Row whose `'label'` column is equal to `$label`.

This method executes in constant time except for the first call which caches row
label => row ID mappings.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$label` (`string`) &mdash;

      <div markdown="1" class="param-desc"> `'label'` column value to look for.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  ([`Row`](../Piwik/DataTable/Row.md)|`Piwik\false`) &mdash;
    <div markdown="1" class="param-desc">The row if found, `false` if otherwise.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getrowidfromlabel" id="getrowidfromlabel"></a>
<a name="getRowIdFromLabel" id="getRowIdFromLabel"></a>
### `getRowIdFromLabel()`

Returns the row id for the row whose `'label'` column is equal to `$label`.

This method executes in constant time except for the first call which caches row
label => row ID mappings.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$label` (`string`) &mdash;

      <div markdown="1" class="param-desc"> `'label'` column value to look for.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`int`) &mdash;
    <div markdown="1" class="param-desc">The row ID.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getemptyclone" id="getemptyclone"></a>
<a name="getEmptyClone" id="getEmptyClone"></a>
### `getEmptyClone()`

Returns an empty DataTable with the same metadata and queued filters as `$this` one.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$keepFilters` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether to pass the queued filter list to the new DataTable or not.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a [`DataTable`](../Piwik/DataTable.md) value.

<a name="getrowfromid" id="getrowfromid"></a>
<a name="getRowFromId" id="getRowFromId"></a>
### `getRowFromId()`

Returns a row by ID.

The ID is either the index of the row or `ID_SUMMARY_ROW`.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$id` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The row ID.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  ([`Row`](../Piwik/DataTable/Row.md)|`Piwik\false`) &mdash;
    <div markdown="1" class="param-desc">The Row or false if not found.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getrowfromidsubdatatable" id="getrowfromidsubdatatable"></a>
<a name="getRowFromIdSubDataTable" id="getRowFromIdSubDataTable"></a>
### `getRowFromIdSubDataTable()`

Returns the row that has a subtable with ID matching `$idSubtable`.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$idSubTable` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The subtable ID.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  ([`Row`](../Piwik/DataTable/Row.md)|`Piwik\false`) &mdash;
    <div markdown="1" class="param-desc">The row or false if not found</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="addrow" id="addrow"></a>
<a name="addRow" id="addRow"></a>
### `addRow()`

Adds a row to this table.

If [setMaximumAllowedRows()](/api-reference/Piwik/DataTable#setmaximumallowedrows) was called and the current row count is
at the maximum, the new row will be summed to the summary row. If there is no summary row,
this row is set as the summary row.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$row` ([`Row`](../Piwik/DataTable/Row.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  ([`Row`](../Piwik/DataTable/Row.md)) &mdash;
    <div markdown="1" class="param-desc">`$row` or the summary row if we're at the maximum number of rows.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="addsummaryrow" id="addsummaryrow"></a>
<a name="addSummaryRow" id="addSummaryRow"></a>
### `addSummaryRow()`

Sets the summary row.

_Note: A DataTable can have only one summary row._

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$row` ([`Row`](../Piwik/DataTable/Row.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  ([`Row`](../Piwik/DataTable/Row.md)) &mdash;
    <div markdown="1" class="param-desc">Returns `$row`.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getid" id="getid"></a>
<a name="getId" id="getId"></a>
### `getId()`

Returns the DataTable ID.

#### Signature

- It returns a `int` value.

<a name="addrowfromarray" id="addrowfromarray"></a>
<a name="addRowFromArray" id="addRowFromArray"></a>
### `addRowFromArray()`

Adds a new row from an array.

You can add row metadata with this method.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$row` (`array`) &mdash;

      <div markdown="1" class="param-desc"> eg. `array(Row::COLUMNS => array('visits' => 13, 'test' => 'toto'), Row::METADATA => array('mymetadata' => 'myvalue'))`</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="addrowfromsimplearray" id="addrowfromsimplearray"></a>
<a name="addRowFromSimpleArray" id="addRowFromSimpleArray"></a>
### `addRowFromSimpleArray()`

Adds a new row a from an array of column values.

Row metadata cannot be added with this method.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$row` (`array`) &mdash;

      <div markdown="1" class="param-desc"> eg. `array('name' => 'google analytics', 'license' => 'commercial')`</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="getrows" id="getrows"></a>
<a name="getRows" id="getRows"></a>
### `getRows()`

Returns the array of Rows.

#### Signature

- It returns a [`Row[]`](../Piwik/DataTable/Row.md) value.

<a name="getcolumn" id="getcolumn"></a>
<a name="getColumn" id="getColumn"></a>
### `getColumn()`

Returns an array containing all column values for the requested column.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The column name.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">The array of column values.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getcolumnsstartingwith" id="getcolumnsstartingwith"></a>
<a name="getColumnsStartingWith" id="getColumnsStartingWith"></a>
### `getColumnsStartingWith()`

Returns an array containing all column values of columns whose name starts with `$name`.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$namePrefix` (`Piwik\$namePrefix`) &mdash;

      <div markdown="1" class="param-desc"> The column name prefix.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">The array of column values.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getcolumns" id="getcolumns"></a>
<a name="getColumns" id="getColumns"></a>
### `getColumns()`

Returns the names of every column this DataTable contains.

This method will return the
columns of the first row with data and will assume they occur in every other row as well.

_ Note: If column names still use their in-database INDEX values (@see Metrics), they
       will be converted to their string name in the array result._

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">Array of string column names.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getrowsmetadata" id="getrowsmetadata"></a>
<a name="getRowsMetadata" id="getRowsMetadata"></a>
### `getRowsMetadata()`

Returns an array containing the requested metadata value of each row.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The metadata column to return.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `array` value.

<a name="getrowscount" id="getrowscount"></a>
<a name="getRowsCount" id="getRowsCount"></a>
### `getRowsCount()`

Returns the number of rows in the table including the summary row.

#### Signature

- It returns a `int` value.

<a name="getfirstrow" id="getfirstrow"></a>
<a name="getFirstRow" id="getFirstRow"></a>
### `getFirstRow()`

Returns the first row of the DataTable.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  ([`Row`](../Piwik/DataTable/Row.md)|`Piwik\false`) &mdash;
    <div markdown="1" class="param-desc">The first row or `false` if it cannot be found.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getlastrow" id="getlastrow"></a>
<a name="getLastRow" id="getLastRow"></a>
### `getLastRow()`

Returns the last row of the DataTable.

If there is a summary row, it
will always be considered the last row.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  ([`Row`](../Piwik/DataTable/Row.md)|`Piwik\false`) &mdash;
    <div markdown="1" class="param-desc">The last row or `false` if it cannot be found.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getrowscountrecursive" id="getrowscountrecursive"></a>
<a name="getRowsCountRecursive" id="getRowsCountRecursive"></a>
### `getRowsCountRecursive()`

Returns the number of rows in the entire DataTable hierarchy.

This is the number of rows in this DataTable
summed with the row count of each descendant subtable.

#### Signature

- It returns a `int` value.

<a name="deletecolumn" id="deletecolumn"></a>
<a name="deleteColumn" id="deleteColumn"></a>
### `deleteColumn()`

Delete a column by name in every row.

This change is NOT applied recursively to all
subtables.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Column name to delete.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="__sleep" id="__sleep"></a>
<a name="__sleep" id="__sleep"></a>
### `__sleep()`

#### Signature

- It does not return anything.

<a name="renamecolumn" id="renamecolumn"></a>
<a name="renameColumn" id="renameColumn"></a>
### `renameColumn()`

Rename a column in every row.

This change is applied recursively to all subtables.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$oldName`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$newName`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$doRenameColumnsOfSubTables`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="deletecolumns" id="deletecolumns"></a>
<a name="deleteColumns" id="deleteColumns"></a>
### `deleteColumns()`

Deletes several columns by name in every row.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$names` (`array`) &mdash;

      <div markdown="1" class="param-desc"> List of column names to delete.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$deleteRecursiveInSubtables` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether to apply this change to all subtables or not.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="deleterow" id="deleterow"></a>
<a name="deleteRow" id="deleteRow"></a>
### `deleteRow()`

Deletes a row by ID.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$id` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The row ID.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the row `$id` cannot be found.

<a name="deleterowsoffset" id="deleterowsoffset"></a>
<a name="deleteRowsOffset" id="deleteRowsOffset"></a>
### `deleteRowsOffset()`

Deletes rows from `$offset` to `$offset + $limit`.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$offset` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The offset to start deleting rows from.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$limit` (`int`|`null`) &mdash;

      <div markdown="1" class="param-desc"> The number of rows to delete. If `null` all rows after the offset will be removed.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`int`) &mdash;
    <div markdown="1" class="param-desc">The number of rows deleted.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="deleterows" id="deleterows"></a>
<a name="deleteRows" id="deleteRows"></a>
### `deleteRows()`

Deletes a set of rows by ID.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$rowIds` (`array`) &mdash;

      <div markdown="1" class="param-desc"> The list of row IDs to delete.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If a row ID cannot be found.

<a name="__tostring" id="__tostring"></a>
<a name="__toString" id="__toString"></a>
### `__toString()`

Returns a string representation of this DataTable for convenient viewing.

_Note: This uses the **html** DataTable renderer._

#### Signature

- It returns a `string` value.

<a name="isequal" id="isequal"></a>
<a name="isEqual" id="isEqual"></a>
### `isEqual()`

Returns true if both DataTable instances are exactly the same.

DataTables are equal if they have the same number of rows, if
each row has a label that exists in the other table, and if each row
is equal to the row in the other table with the same label. The order
of rows is not important.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$table1` ([`DataTable`](../Piwik/DataTable.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$table2` ([`DataTable`](../Piwik/DataTable.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `bool` value.

<a name="getserialized" id="getserialized"></a>
<a name="getSerialized" id="getSerialized"></a>
### `getSerialized()`

Serializes an entire DataTable hierarchy and returns the array of serialized DataTables.

The first element in the returned array will be the serialized representation of this DataTable.
Every subsequent element will be a serialized subtable.

This DataTable and subtables can optionally be truncated before being serialized. In most
cases where DataTables can become quite large, they should be truncated before being persisted
in an archive.

The result of this method is intended for use with the [ArchiveProcessor::insertBlobRecord()](/api-reference/Piwik/ArchiveProcessor#insertblobrecord) method.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$maximumRowsInDataTable` (`int`) &mdash;

      <div markdown="1" class="param-desc"> If not null, defines the maximum number of rows allowed in the serialized DataTable.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$maximumRowsInSubDataTable` (`int`) &mdash;

      <div markdown="1" class="param-desc"> If not null, defines the maximum number of rows allowed in serialized subtables.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$columnToSortByBeforeTruncation` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The column to sort by before truncating, eg, `Metrics::INDEX_NB_VISITS`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">The array of serialized DataTables: array( // this DataTable (the root) 0 => 'eghuighahgaueytae78yaet7yaetae', // a subtable 1 => 'gaegae gh gwrh guiwh uigwhuige', // another subtable 2 => 'gqegJHUIGHEQjkgneqjgnqeugUGEQHGUHQE', // etc. );</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If infinite recursion detected. This will occur if a table&#039;s subtable is one of its parent tables.

<a name="addrowsfromserializedarray" id="addrowsfromserializedarray"></a>
<a name="addRowsFromSerializedArray" id="addRowsFromSerializedArray"></a>
### `addRowsFromSerializedArray()`

Adds a set of rows from a serialized DataTable string.

See [serialize()](http://php.net/function.serialize()).

_Note: This function will successfully load DataTables serialized by Piwik 1.X._

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$stringSerialized` (`string`) &mdash;

      <div markdown="1" class="param-desc"> A string with the format of a string in the array returned by [serialize()](http://php.net/function.serialize()).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if `$stringSerialized` is invalid.

<a name="addrowsfromarray" id="addrowsfromarray"></a>
<a name="addRowsFromArray" id="addRowsFromArray"></a>
### `addRowsFromArray()`

Adds multiple rows from an array.

You can add row metadata with this method.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$array` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Array with the following structure array( // row1 array( Row::COLUMNS => array( col1_name => value1, col2_name => value2, ...), Row::METADATA => array( metadata1_name => value1,  ...), // see Row ), // row2 array( ... ), )</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="addrowsfromsimplearray" id="addrowsfromsimplearray"></a>
<a name="addRowsFromSimpleArray" id="addRowsFromSimpleArray"></a>
### `addRowsFromSimpleArray()`

Adds multiple rows from an array containing arrays of column values.

Row metadata cannot be added with this method.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$array` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Array with the following structure: array( array( col1_name => valueA, col2_name => valueC, ...), array( col1_name => valueB, col2_name => valueD, ...), )</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if `$array` is in an incorrect format.

<a name="makefromindexedarray" id="makefromindexedarray"></a>
<a name="makeFromIndexedArray" id="makeFromIndexedArray"></a>
### `makeFromIndexedArray()`

Rewrites the input `$array`      array (         LABEL => array(col1 => X, col2 => Y),         LABEL2 => array(col1 => X, col2 => Y),     )  to a DataTable with rows that look like:      array (         array( Row::COLUMNS => array('label' => LABEL, col1 => X, col2 => Y)),         array( Row::COLUMNS => array('label' => LABEL2, col1 => X, col2 => Y)),     )

Will also convert arrays like: 

    array (
        LABEL => X,
        LABEL2 => Y,
    )

to:

    array (
        array( Row::COLUMNS => array('label' => LABEL, 'value' => X)),
        array( Row::COLUMNS => array('label' => LABEL2, 'value' => Y)),
    )

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$array` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Indexed array, two formats supported, see above.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$subtablePerLabel` (`array`|`null`) &mdash;

      <div markdown="1" class="param-desc"> An array mapping label values with DataTable instances to associate as a subtable.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a [`DataTable`](../Piwik/DataTable.md) value.

<a name="setmaximumdepthlevelallowedatleast" id="setmaximumdepthlevelallowedatleast"></a>
<a name="setMaximumDepthLevelAllowedAtLeast" id="setMaximumDepthLevelAllowedAtLeast"></a>
### `setMaximumDepthLevelAllowedAtLeast()`

Sets the maximum depth level to at least a certain value.

If the current value is
greater than `$atLeastLevel`, the maximum nesting level is not changed.

The maximum depth level determines the maximum number of subtable levels in the
DataTable tree. For example, if it is set to `2`, this DataTable is allowed to
have subtables, but the subtables are not.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$atLeastLevel` (`int`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="getmetadata" id="getmetadata"></a>
<a name="getMetadata" id="getMetadata"></a>
### `getMetadata()`

Returns metadata by name.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The metadata name.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`mixed`|`Piwik\false`) &mdash;
    <div markdown="1" class="param-desc">The metadata value or `false` if it cannot be found.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="setmetadata" id="setmetadata"></a>
<a name="setMetadata" id="setMetadata"></a>
### `setMetadata()`

Sets a metadata value by name.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The metadata name.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$value` (`mixed`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="getalltablemetadata" id="getalltablemetadata"></a>
<a name="getAllTableMetadata" id="getAllTableMetadata"></a>
### `getAllTableMetadata()`

Returns all table metadata.

#### Signature

- It returns a `array` value.

<a name="setmetadatavalues" id="setmetadatavalues"></a>
<a name="setMetadataValues" id="setMetadataValues"></a>
### `setMetadataValues()`

Sets several metadata values by name.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$values` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Array mapping metadata names with metadata values.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setalltablemetadata" id="setalltablemetadata"></a>
<a name="setAllTableMetadata" id="setAllTableMetadata"></a>
### `setAllTableMetadata()`

Sets metadata, erasing existing values.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$metadata`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setmaximumallowedrows" id="setmaximumallowedrows"></a>
<a name="setMaximumAllowedRows" id="setMaximumAllowedRows"></a>
### `setMaximumAllowedRows()`

Sets the maximum number of rows allowed in this datatable (including the summary row).

If adding more then the allowed number of rows is attempted, the extra
rows are summed to the summary row.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$maximumAllowedRows` (`int`) &mdash;

      <div markdown="1" class="param-desc"> If `0`, the maximum number of rows is unset.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="walkpath" id="walkpath"></a>
<a name="walkPath" id="walkPath"></a>
### `walkPath()`

Traverses a DataTable tree using an array of labels and returns the row it finds or `false` if it cannot find one.

The number of path segments that
were successfully walked is also returned.

If `$missingRowColumns` is supplied, the specified path is created. When
a subtable is encountered w/o the required label, a new row is created
with the label, and a new subtable is added to the row.

Read [http://en.wikipedia.org/wiki/Tree_(data_structure)#Traversal_methods](http://en.wikipedia.org/wiki/Tree_(data_structure)#Traversal_methods)
for more information about tree walking.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$path` (`array`) &mdash;

      <div markdown="1" class="param-desc"> The path to walk. An array of label values. The first element refers to a row in this DataTable, the second in a subtable of the first row, the third a subtable of the second row, etc.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$missingRowColumns` (`array`|`bool`) &mdash;

      <div markdown="1" class="param-desc"> The default columns to use when creating new rows. If this parameter is supplied, new rows will be created for path labels that cannot be found.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$maxSubtableRows` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The maximum number of allowed rows in new subtables. New subtables are only created if `$missingRowColumns` is provided.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">First element is the found row or `false`. Second element is the number of path segments walked. If a row is found, this will be == to `count($path)`. Otherwise, it will be the index of the path segment that we could not find.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="mergesubtables" id="mergesubtables"></a>
<a name="mergeSubtables" id="mergeSubtables"></a>
### `mergeSubtables()`

Returns a new DataTable in which the rows of this table are replaced with the aggregatated rows of all its subtables.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$labelColumn` (`string`|`bool`) &mdash;

      <div markdown="1" class="param-desc"> If supplied the label of the parent row will be added to a new column in each subtable row. If set to, `'label'` each subtable row's label will be prepended w/ the parent row's label. So `'child_label'` becomes `'parent_label - child_label'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$useMetadataColumn` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> If true and if `$labelColumn` is supplied, the parent row's label will be added as metadata and not a new column.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a [`DataTable`](../Piwik/DataTable.md) value.

<a name="makefromsimplearray" id="makefromsimplearray"></a>
<a name="makeFromSimpleArray" id="makeFromSimpleArray"></a>
### `makeFromSimpleArray()`

Returns a new DataTable created with data from a 'simple' array.

See [addRowsFromSimpleArray()](/api-reference/Piwik/DataTable#addrowsfromsimplearray).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$array` (`array`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a [`DataTable`](../Piwik/DataTable.md) value.

<a name="fromserializedarray" id="fromserializedarray"></a>
<a name="fromSerializedArray" id="fromSerializedArray"></a>
### `fromSerializedArray()`

Creates a new DataTable instance from a serialized DataTable string.

See [getSerialized()](/api-reference/Piwik/DataTable#getserialized) and [addRowsFromSerializedArray()](/api-reference/Piwik/DataTable#addrowsfromserializedarray)
for more information on DataTable serialization.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$data` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a [`DataTable`](../Piwik/DataTable.md) value.

