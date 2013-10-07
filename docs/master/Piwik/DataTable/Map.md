<small>Piwik\DataTable</small>

Map
===

The DataTable Map is a way to store an array of dataTable.

Description
-----------

The Map implements some of the features of the DataTable such as queueFilter, getRowsCount.


Methods
-------

The class defines the following methods:

- [`getKeyName()`](#getKeyName) &mdash; Returns the keyName string @see self::$keyName
- [`setKeyName()`](#setKeyName) &mdash; Set the keyName @see self::$keyName
- [`getRowsCount()`](#getRowsCount) &mdash; Returns the number of DataTable in this DataTable\Map
- [`queueFilter()`](#queueFilter) &mdash; Queue a filter to the DataTable\Map will queue this filter to every DataTable of the DataTable\Map.
- [`applyQueuedFilters()`](#applyQueuedFilters) &mdash; Apply the filters previously queued to each of the DataTable of this DataTable\Map.
- [`filter()`](#filter) &mdash; Apply a filter to all tables in the array
- [`getDataTables()`](#getDataTables) &mdash; Returns the array of DataTable
- [`getTable()`](#getTable) &mdash; Returns the table with the specified label.
- [`getFirstRow()`](#getFirstRow) &mdash; Returns the first row This method can be used to treat DataTable and DataTable\Map in the same way
- [`addTable()`](#addTable) &mdash; Adds a new DataTable to the DataTable\Map
- [`__toString()`](#__toString) &mdash; Returns a string output of this DataTable\Map (applying the default renderer to every DataTable of this DataTable\Map).
- [`enableRecursiveSort()`](#enableRecursiveSort)
- [`renameColumn()`](#renameColumn) &mdash; Renames the given column
- [`deleteColumns()`](#deleteColumns) &mdash; Deletes the given columns
- [`deleteRow()`](#deleteRow)
- [`deleteColumn()`](#deleteColumn) &mdash; Deletes the given column
- [`getColumn()`](#getColumn) &mdash; Returns the array containing all rows values in all data tables for the requested column
- [`mergeChildren()`](#mergeChildren) &mdash; Merges the rows of every child DataTable into a new DataTable and returns it.
- [`addDataTable()`](#addDataTable) &mdash; Adds a DataTable to all the tables in this array NOTE: Will only add $tableToSum if the childTable has some rows
- [`mergeSubtables()`](#mergeSubtables) &mdash; Returns a new DataTable\Map w/ child tables that have had their subtables merged.
- [`getEmptyClone()`](#getEmptyClone) &mdash; Returns a new DataTable\Map w/o any child DataTables, but with the same key name as this instance.
- [`getMetadataIntersectArray()`](#getMetadataIntersectArray) &mdash; Returns the intersection of children&#039;s meta data arrays
- [`getColumns()`](#getColumns)

### `getKeyName()` <a name="getKeyName"></a>

Returns the keyName string @see self::$keyName

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `setKeyName()` <a name="setKeyName"></a>

Set the keyName @see self::$keyName

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- It does not return anything.

### `getRowsCount()` <a name="getRowsCount"></a>

Returns the number of DataTable in this DataTable\Map

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `queueFilter()` <a name="queueFilter"></a>

Queue a filter to the DataTable\Map will queue this filter to every DataTable of the DataTable\Map.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$className`
    - `$parameters`
- It does not return anything.

### `applyQueuedFilters()` <a name="applyQueuedFilters"></a>

Apply the filters previously queued to each of the DataTable of this DataTable\Map.

#### Signature

- It is a **public** method.
- It does not return anything.

### `filter()` <a name="filter"></a>

Apply a filter to all tables in the array

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$className`
    - `$parameters`
- It does not return anything.

### `getDataTables()` <a name="getDataTables"></a>

Returns the array of DataTable

#### Signature

- It is a **public** method.
- It returns a(n) [`DataTable[]`](../../Piwik/DataTable.md) value.

### `getTable()` <a name="getTable"></a>

Returns the table with the specified label.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$label`
- It returns a(n) [`DataTable`](../../Piwik/DataTable.md) value.

### `getFirstRow()` <a name="getFirstRow"></a>

Returns the first row This method can be used to treat DataTable and DataTable\Map in the same way

#### Signature

- It is a **public** method.
- It returns a(n) [`Row`](../../Piwik/DataTable/Row.md) value.

### `addTable()` <a name="addTable"></a>

Adds a new DataTable to the DataTable\Map

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
    - `$label`
- It does not return anything.

### `__toString()` <a name="__toString"></a>

Returns a string output of this DataTable\Map (applying the default renderer to every DataTable of this DataTable\Map).

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `enableRecursiveSort()` <a name="enableRecursiveSort"></a>

#### See Also

- `DataTable::enableRecursiveSort()`

#### Signature

- It is a **public** method.
- It does not return anything.

### `renameColumn()` <a name="renameColumn"></a>

Renames the given column

#### See Also

- `DataTable::renameColumn`

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$oldName`
    - `$newName`
- It does not return anything.

### `deleteColumns()` <a name="deleteColumns"></a>

Deletes the given columns

#### See Also

- `DataTable::deleteColumns`

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$columns`
- It does not return anything.

### `deleteRow()` <a name="deleteRow"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$id`
- It does not return anything.

### `deleteColumn()` <a name="deleteColumn"></a>

Deletes the given column

#### See Also

- `DataTable::deleteColumn`

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$column`
- It does not return anything.

### `getColumn()` <a name="getColumn"></a>

Returns the array containing all rows values in all data tables for the requested column

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- It returns a(n) `array` value.

### `mergeChildren()` <a name="mergeChildren"></a>

Merges the rows of every child DataTable into a new DataTable and returns it.

#### Description

This function will also set the label of the merged rows
to the label of the DataTable they were originally from.

The result of this function is determined by the type of DataTable
this instance holds. If this DataTable\Map instance holds an array
of DataTables, this function will transform it from:
&lt;code&gt;
Label 0:
  DataTable(row1)
Label 1:
  DataTable(row2)
&lt;/code&gt;
to:
&lt;code&gt;
DataTable(row1[label = &#039;Label 0&#039;], row2[label = &#039;Label 1&#039;])
&lt;/code&gt;

If this instance holds an array of DataTable\Maps, this function will
transform it from:
&lt;code&gt;
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
&lt;/code&gt;
to:
&lt;code&gt;
Inner Label 0:
  DataTable(row1[label = &#039;Outer Label 0&#039;], row3[label = &#039;Outer Label 1&#039;])
Inner Label 1:
  DataTable(row2[label = &#039;Outer Label 0&#039;], row4[label = &#039;Outer Label 1&#039;])
&lt;/code&gt;

In addition, if this instance holds an array of DataTable\Maps, the
metadata of the first child is used as the metadata of the result.

This function can be used, for example, to smoosh IndexedBySite archive
query results into one DataTable w/ different rows differentiated by site ID.

#### Signature

- It is a **public** method.
- It can return one of the following values:
    - [`DataTable`](../../Piwik/DataTable.md)
    - [`Map`](../../Piwik/DataTable/Map.md)

### `addDataTable()` <a name="addDataTable"></a>

Adds a DataTable to all the tables in this array NOTE: Will only add $tableToSum if the childTable has some rows

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$tableToSum` ([`DataTable`](../../Piwik/DataTable.md))
- It does not return anything.

### `mergeSubtables()` <a name="mergeSubtables"></a>

Returns a new DataTable\Map w/ child tables that have had their subtables merged.

#### See Also

- `DataTable::mergeSubtables`

#### Signature

- It is a **public** method.
- It returns a(n) [`Map`](../../Piwik/DataTable/Map.md) value.

### `getEmptyClone()` <a name="getEmptyClone"></a>

Returns a new DataTable\Map w/o any child DataTables, but with the same key name as this instance.

#### Signature

- It is a **public** method.
- It returns a(n) [`Map`](../../Piwik/DataTable/Map.md) value.

### `getMetadataIntersectArray()` <a name="getMetadataIntersectArray"></a>

Returns the intersection of children&#039;s meta data arrays

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- It returns a(n) `mixed` value.

### `getColumns()` <a name="getColumns"></a>

#### See Also

- `DataTable::getColumns()`

#### Signature

- It is a **public** method.
- It returns a(n) `array` value.

