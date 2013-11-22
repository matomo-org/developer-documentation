<small>Piwik\DataTable</small>

Map
===

Stores an array of DataTables indexed by one type of DataTable metadata (such as site ID or period).

Description
-----------

DataTable Maps are returned on all queries that involve multiple sites and/or multiple
periods. The Maps will contain a DataTable for each site and period combination.

The Map implements some of the features of the DataTable such as queueFilter and getRowsCount.

Methods
-------

The class defines the following methods:

- [`getKeyName()`](#getkeyname) &mdash; Returns a string description of the data used to index the DataTables.
- [`setKeyName()`](#setkeyname) &mdash; Set the keyName.
- [`getRowsCount()`](#getrowscount) &mdash; Returns the number of DataTables in this DataTable\Map.
- [`queueFilter()`](#queuefilter) &mdash; Queue a filter to DataTable child of contained by this instance.
- [`applyQueuedFilters()`](#applyqueuedfilters) &mdash; Apply the filters previously queued to each DataTable contained by this DataTable\Map.
- [`filter()`](#filter) &mdash; Apply a filter to all tables contained by this instance.
- [`getDataTables()`](#getdatatables) &mdash; Returns the array of DataTables contained by this class.
- [`getTable()`](#gettable) &mdash; Returns the table with the specific label.
- [`getFirstRow()`](#getfirstrow) &mdash; Returns the first DataTable in the DataTable array.
- [`getLastRow()`](#getlastrow) &mdash; Returns the last DataTable in the DataTable array.
- [`addTable()`](#addtable) &mdash; Adds a new DataTable to the DataTable\Map.
- [`__toString()`](#__tostring) &mdash; Returns a string output of this DataTable\Map (applying the default renderer to every DataTable of this DataTable\Map).
- [`enableRecursiveSort()`](#enablerecursivesort)
- [`renameColumn()`](#renamecolumn) &mdash; Renames the given column in each contained DataTable.
- [`deleteColumns()`](#deletecolumns) &mdash; Deletes the specified columns in each contained DataTable.
- [`deleteRow()`](#deleterow) &mdash; Deletes a table from the array of DataTables.
- [`deleteColumn()`](#deletecolumn) &mdash; Deletes the given column in every contained DataTable.
- [`getColumn()`](#getcolumn) &mdash; Returns the array containing all row values in all data tables for the requested column.
- [`mergeChildren()`](#mergechildren) &mdash; Merges the rows of every child DataTable into a new DataTable and returns it.
- [`addDataTable()`](#adddatatable) &mdash; Adds a DataTable to all the tables in this array.
- [`mergeSubtables()`](#mergesubtables) &mdash; Returns a new DataTable\Map w/ child tables that have had their subtables merged.
- [`getEmptyClone()`](#getemptyclone) &mdash; Returns a new DataTable\Map w/o any child DataTables, but with the same key name as this instance.
- [`getMetadataIntersectArray()`](#getmetadataintersectarray) &mdash; Returns the intersection of children's metadata arrays (what they all have in common).
- [`getColumns()`](#getcolumns)

<a name="getkeyname" id="getkeyname"></a>
<a name="getKeyName" id="getKeyName"></a>
### `getKeyName()`

Returns a string description of the data used to index the DataTables.

#### Description

This label is used by DataTable Renderers (it becomes a column name or the XML description tag).

#### Signature

- _Returns:_ eg, `'idSite'`, `'period'`
    - `string`

<a name="setkeyname" id="setkeyname"></a>
<a name="setKeyName" id="setKeyName"></a>
### `setKeyName()`

Set the keyName.

#### Description

See [getKeyName](#getKeyName).

#### Signature

- It accepts the following parameter(s):
    - `$name` (`string`)
- It does not return anything.

<a name="getrowscount" id="getrowscount"></a>
<a name="getRowsCount" id="getRowsCount"></a>
### `getRowsCount()`

Returns the number of DataTables in this DataTable\Map.

#### Signature

- It returns a `int` value.

<a name="queuefilter" id="queuefilter"></a>
<a name="queueFilter" id="queueFilter"></a>
### `queueFilter()`

Queue a filter to DataTable child of contained by this instance.

#### Description

See [DataTable::queueFilter](#) for more information..

#### Signature

- It accepts the following parameter(s):
    - `$className` (`string`|`Piwik\DataTable\Closure`) &mdash; Filter name, eg. `'Limit'` or a Closure.
    - `$parameters` (`array`) &mdash; Filter parameters, eg. `array(50, 10)`.
- It does not return anything.

<a name="applyqueuedfilters" id="applyqueuedfilters"></a>
<a name="applyQueuedFilters" id="applyQueuedFilters"></a>
### `applyQueuedFilters()`

Apply the filters previously queued to each DataTable contained by this DataTable\Map.

#### Signature

- It does not return anything.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

Apply a filter to all tables contained by this instance.

#### Signature

- It accepts the following parameter(s):
    - `$className` (`string`|`Piwik\DataTable\Closure`) &mdash; Name of filter class or a Closure.
    - `$parameters` (`array`) &mdash; Parameters to pass to the filter.
- It does not return anything.

<a name="getdatatables" id="getdatatables"></a>
<a name="getDataTables" id="getDataTables"></a>
### `getDataTables()`

Returns the array of DataTables contained by this class.

#### Signature

- It can return one of the following values:
    - [`DataTable[]`](../../Piwik/DataTable.md)
    - [`Map[]`](../../Piwik/DataTable/Map.md)

<a name="gettable" id="gettable"></a>
<a name="getTable" id="getTable"></a>
### `getTable()`

Returns the table with the specific label.

#### Signature

- It accepts the following parameter(s):
    - `$label` (`string`)
- It can return one of the following values:
    - [`DataTable`](../../Piwik/DataTable.md)
    - [`Map`](../../Piwik/DataTable/Map.md)

<a name="getfirstrow" id="getfirstrow"></a>
<a name="getFirstRow" id="getFirstRow"></a>
### `getFirstRow()`

Returns the first DataTable in the DataTable array.

#### Signature

- It can return one of the following values:
    - [`DataTable`](../../Piwik/DataTable.md)
    - [`Map`](../../Piwik/DataTable/Map.md)
    - `Piwik\DataTable\false`

<a name="getlastrow" id="getlastrow"></a>
<a name="getLastRow" id="getLastRow"></a>
### `getLastRow()`

Returns the last DataTable in the DataTable array.

#### Signature

- It can return one of the following values:
    - [`DataTable`](../../Piwik/DataTable.md)
    - [`Map`](../../Piwik/DataTable/Map.md)
    - `Piwik\DataTable\false`

<a name="addtable" id="addtable"></a>
<a name="addTable" id="addTable"></a>
### `addTable()`

Adds a new DataTable to the DataTable\Map.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../Piwik/DataTable.md))
    - `$label` (`string`) &mdash; Label used to index this table in the array.
- It does not return anything.

<a name="__tostring" id="__tostring"></a>
<a name="__toString" id="__toString"></a>
### `__toString()`

Returns a string output of this DataTable\Map (applying the default renderer to every DataTable of this DataTable\Map).

#### Signature

- It returns a `string` value.

<a name="enablerecursivesort" id="enablerecursivesort"></a>
<a name="enableRecursiveSort" id="enableRecursiveSort"></a>
### `enableRecursiveSort()`

#### See Also

- `DataTable::enableRecursiveSort()`

#### Signature

- It does not return anything.

<a name="renamecolumn" id="renamecolumn"></a>
<a name="renameColumn" id="renameColumn"></a>
### `renameColumn()`

Renames the given column in each contained DataTable.

#### See Also

- `DataTable::renameColumn`

#### Signature

- It accepts the following parameter(s):
    - `$oldName` (`string`)
    - `$newName` (`string`)
- It does not return anything.

<a name="deletecolumns" id="deletecolumns"></a>
<a name="deleteColumns" id="deleteColumns"></a>
### `deleteColumns()`

Deletes the specified columns in each contained DataTable.

#### See Also

- `DataTable::deleteColumns`

#### Signature

- It accepts the following parameter(s):
    - `$columns` (`array`) &mdash; The columns to delete.
    - `$deleteRecursiveInSubtables` (`bool`) &mdash; This param is currently not used.
- It does not return anything.

<a name="deleterow" id="deleterow"></a>
<a name="deleteRow" id="deleteRow"></a>
### `deleteRow()`

Deletes a table from the array of DataTables.

#### Signature

- It accepts the following parameter(s):
    - `$id` (`string`) &mdash; The label associated with DataTable.
- It does not return anything.

<a name="deletecolumn" id="deletecolumn"></a>
<a name="deleteColumn" id="deleteColumn"></a>
### `deleteColumn()`

Deletes the given column in every contained DataTable.

#### See Also

- `DataTable::deleteColumn`

#### Signature

- It accepts the following parameter(s):
    - `$name` (`string`)
- It does not return anything.

<a name="getcolumn" id="getcolumn"></a>
<a name="getColumn" id="getColumn"></a>
### `getColumn()`

Returns the array containing all row values in all data tables for the requested column.

#### Signature

- It accepts the following parameter(s):
    - `$name` (`string`) &mdash; The column name.
- It returns a `array` value.

<a name="mergechildren" id="mergechildren"></a>
<a name="mergeChildren" id="mergeChildren"></a>
### `mergeChildren()`

Merges the rows of every child DataTable into a new DataTable and returns it.

#### Description

This function will also set the label of the merged rows
to the label of the DataTable they were originally from.

The result of this function is determined by the type of DataTable
this instance holds. If this DataTable\Map instance holds an array
of DataTables, this function will transform it from:

    Label 0:
      DataTable(row1)
    Label 1:
      DataTable(row2)

to:

    DataTable(row1[label = 'Label 0'], row2[label = 'Label 1'])

If this instance holds an array of DataTable\Maps, this function will
transform it from:

    Outer Label 0:            // the outer DataTable\Map
      Inner Label 0:            // one of the inner DataTable\Maps
        DataTable(row1)
      Inner Label 1:
        DataTable(row2)
    Outer Label 1:
      Inner Label 0:
        DataTable(row3)
      Inner Label 1:
        DataTable(row4)

to:

    Inner Label 0:
      DataTable(row1[label = 'Outer Label 0'], row3[label = 'Outer Label 1'])
    Inner Label 1:
      DataTable(row2[label = 'Outer Label 0'], row4[label = 'Outer Label 1'])

In addition, if this instance holds an array of DataTable\Maps, the
metadata of the first child is used as the metadata of the result.

This function can be used, for example, to smoosh IndexedBySite archive
query results into one DataTable w/ different rows differentiated by site ID.

#### Signature

- It can return one of the following values:
    - [`DataTable`](../../Piwik/DataTable.md)
    - [`Map`](../../Piwik/DataTable/Map.md)

<a name="adddatatable" id="adddatatable"></a>
<a name="addDataTable" id="addDataTable"></a>
### `addDataTable()`

Adds a DataTable to all the tables in this array.

#### Description

NOTE: Will only add `$tableToSum` if the childTable has some rows

See [DataTable::addDataTable()](#).

#### Signature

- It accepts the following parameter(s):
    - `$tableToSum` ([`DataTable`](../../Piwik/DataTable.md))
- It does not return anything.

<a name="mergesubtables" id="mergesubtables"></a>
<a name="mergeSubtables" id="mergeSubtables"></a>
### `mergeSubtables()`

Returns a new DataTable\Map w/ child tables that have had their subtables merged.

#### See Also

- `DataTable::mergeSubtables`

#### Signature

- It returns a [`Map`](../../Piwik/DataTable/Map.md) value.

<a name="getemptyclone" id="getemptyclone"></a>
<a name="getEmptyClone" id="getEmptyClone"></a>
### `getEmptyClone()`

Returns a new DataTable\Map w/o any child DataTables, but with the same key name as this instance.

#### Signature

- It returns a [`Map`](../../Piwik/DataTable/Map.md) value.

<a name="getmetadataintersectarray" id="getmetadataintersectarray"></a>
<a name="getMetadataIntersectArray" id="getMetadataIntersectArray"></a>
### `getMetadataIntersectArray()`

Returns the intersection of children's metadata arrays (what they all have in common).

#### Signature

- It accepts the following parameter(s):
    - `$name` (`string`) &mdash; The metadata name.
- It returns a `mixed` value.

<a name="getcolumns" id="getcolumns"></a>
<a name="getColumns" id="getColumns"></a>
### `getColumns()`

#### See Also

- `DataTable::getColumns()`

#### Signature

- It returns a `array` value.

