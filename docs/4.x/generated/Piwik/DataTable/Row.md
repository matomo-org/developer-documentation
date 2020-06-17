<small>Piwik\DataTable\</small>

Row
===

This is what a [DataTable](/api-reference/Piwik/DataTable) is composed of.

DataTable rows contain columns, metadata and a subtable ID. Columns and metadata
are stored as an array of name => value mappings.

Properties
----------

This class defines the following properties:

- [`$maxVisitsSummed`](#$maxvisitssummed)
- [`$subtableId`](#$subtableid)

<a name="$maxvisitssummed" id="$maxvisitssummed"></a>
<a name="maxVisitsSummed" id="maxVisitsSummed"></a>
### `$maxVisitsSummed`

#### Signature

- Its type is not specified.


<a name="$subtableid" id="$subtableid"></a>
<a name="subtableId" id="subtableId"></a>
### `$subtableId`

#### Signature

- Its type is not specified.


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`__toString()`](#__tostring) &mdash; Applies a basic rendering to the Row and returns the output.
- [`deleteColumn()`](#deletecolumn) &mdash; Deletes the given column.
- [`renameColumn()`](#renamecolumn) &mdash; Renames a column.
- [`getColumn()`](#getcolumn) &mdash; Returns a column by name.
- [`getMetadata()`](#getmetadata) &mdash; Returns the array of all metadata, or one requested metadata value.
- [`hasColumn()`](#hascolumn) &mdash; Returns true if a column having the given name is already registered.
- [`getColumns()`](#getcolumns) &mdash; Returns the array containing all the columns.
- [`getIdSubDataTable()`](#getidsubdatatable) &mdash; Returns the ID of the subDataTable.
- [`getSubtable()`](#getsubtable) &mdash; Returns the associated subtable, if one exists.
- [`sumSubtable()`](#sumsubtable) &mdash; Sums a DataTable to this row's subtable.
- [`setSubtable()`](#setsubtable) &mdash; Attaches a subtable to this row, overwriting the existing subtable, if any.
- [`isSubtableLoaded()`](#issubtableloaded) &mdash; Returns `true` if the subtable is currently loaded in memory via Piwik\DataTable\Manager.
- [`removeSubtable()`](#removesubtable) &mdash; Removes the subtable reference.
- [`setColumns()`](#setcolumns) &mdash; Set all the columns at once.
- [`setColumn()`](#setcolumn) &mdash; Set the value `$value` to the column called `$name`.
- [`setMetadata()`](#setmetadata) &mdash; Set the value `$value` to the metadata called `$name`.
- [`deleteMetadata()`](#deletemetadata) &mdash; Deletes one metadata value or all metadata values.
- [`addColumn()`](#addcolumn) &mdash; Add a new column to the row.
- [`addColumns()`](#addcolumns) &mdash; Add many columns to this row.
- [`addMetadata()`](#addmetadata) &mdash; Add a new metadata to the row.
- [`sumRow()`](#sumrow) &mdash; Sums the given `$rowToSum` columns values to the existing row column values.
- [`sumRowMetadata()`](#sumrowmetadata) &mdash; Sums the metadata in `$rowToSum` with the metadata in `$this` row.
- [`isSummaryRow()`](#issummaryrow) &mdash; Returns `true` if this row is the summary row, `false` if otherwise.
- [`getComparisons()`](#getcomparisons) &mdash; Returns the associated comparisons DataTable, if any.
- [`setComparisons()`](#setcomparisons) &mdash; Associates the supplied table with this row as the comparisons table.
- [`isEqual()`](#isequal) &mdash; Helper function that tests if two rows are equal.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$row` (`array`) &mdash;
       An array with the following structure: array( Row::COLUMNS => array('label' => 'Matomo', 'column1' => 42, 'visits' => 657, 'time_spent' => 155744), Row::METADATA => array('logo' => 'test.png'), Row::DATATABLE_ASSOCIATED => $subtable // DataTable object // (but in the row only the ID will be stored) )

<a name="__tostring" id="__tostring"></a>
<a name="__toString" id="__toString"></a>
### `__toString()`

Applies a basic rendering to the Row and returns the output.

#### Signature


- *Returns:*  `string` &mdash;
    describing the row. Example:
               "- 1 ['label' => 'piwik', 'nb_uniq_visitors' => 1685, 'nb_visits' => 1861] [] [idsubtable = 1375]"

<a name="deletecolumn" id="deletecolumn"></a>
<a name="deleteColumn" id="deleteColumn"></a>
### `deleteColumn()`

Deletes the given column.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       The column name.

- *Returns:*  `bool` &mdash;
    `true` on success, `false` if the column does not exist.

<a name="renamecolumn" id="renamecolumn"></a>
<a name="renameColumn" id="renameColumn"></a>
### `renameColumn()`

Renames a column.

#### Signature

-  It accepts the following parameter(s):
    - `$oldName` (`string`) &mdash;
       The current name of the column.
    - `$newName` (`string`) &mdash;
       The new name of the column.
- It does not return anything.

<a name="getcolumn" id="getcolumn"></a>
<a name="getColumn" id="getColumn"></a>
### `getColumn()`

Returns a column by name.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       The column name.

- *Returns:*  `mixed`|`false` &mdash;
    The column value or false if it doesn't exist.

<a name="getmetadata" id="getmetadata"></a>
<a name="getMetadata" id="getMetadata"></a>
### `getMetadata()`

Returns the array of all metadata, or one requested metadata value.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`|`null`) &mdash;
       The name of the metadata to return or null to return all metadata.
- It returns a `mixed` value.

<a name="hascolumn" id="hascolumn"></a>
<a name="hasColumn" id="hasColumn"></a>
### `hasColumn()`

Returns true if a column having the given name is already registered. The value will not be evaluated, it will
just check whether a column exists independent of its value.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
      
- It returns a `bool` value.

<a name="getcolumns" id="getcolumns"></a>
<a name="getColumns" id="getColumns"></a>
### `getColumns()`

Returns the array containing all the columns.

#### Signature


- *Returns:*  `array` &mdash;
    Example:

                   array(
                       'column1'   => VALUE,
                       'label'     => 'www.php.net'
                       'nb_visits' => 15894,
                   )

<a name="getidsubdatatable" id="getidsubdatatable"></a>
<a name="getIdSubDataTable" id="getIdSubDataTable"></a>
### `getIdSubDataTable()`

Returns the ID of the subDataTable.

If there is no such a table, returns null.

#### Signature


- *Returns:*  `int`|`null` &mdash;
    

<a name="getsubtable" id="getsubtable"></a>
<a name="getSubtable" id="getSubtable"></a>
### `getSubtable()`

Returns the associated subtable, if one exists. Returns `false` if none exists.

#### Signature


- *Returns:*  [`DataTable`](../../Piwik/DataTable.md)|`bool` &mdash;
    

<a name="sumsubtable" id="sumsubtable"></a>
<a name="sumSubtable" id="sumSubtable"></a>
### `sumSubtable()`

Sums a DataTable to this row's subtable. If this row has no subtable a new
one is created.

See [DataTable::addDataTable()](/api-reference/Piwik/DataTable#adddatatable) to learn how DataTables are summed.

#### Signature

-  It accepts the following parameter(s):
    - `$subTable` ([`DataTable`](../../Piwik/DataTable.md)) &mdash;
       Table to sum to this row's subtable.
- It does not return anything.

<a name="setsubtable" id="setsubtable"></a>
<a name="setSubtable" id="setSubtable"></a>
### `setSubtable()`

Attaches a subtable to this row, overwriting the existing subtable,
if any.

#### Signature

-  It accepts the following parameter(s):
    - `$subTable` ([`DataTable`](../../Piwik/DataTable.md)) &mdash;
       DataTable to associate to this row.

- *Returns:*  [`DataTable`](../../Piwik/DataTable.md) &mdash;
    Returns `$subTable`.

<a name="issubtableloaded" id="issubtableloaded"></a>
<a name="isSubtableLoaded" id="isSubtableLoaded"></a>
### `isSubtableLoaded()`

Returns `true` if the subtable is currently loaded in memory via Piwik\DataTable\Manager.

#### Signature

- It returns a `bool` value.

<a name="removesubtable" id="removesubtable"></a>
<a name="removeSubtable" id="removeSubtable"></a>
### `removeSubtable()`

Removes the subtable reference.

#### Signature

- It does not return anything.

<a name="setcolumns" id="setcolumns"></a>
<a name="setColumns" id="setColumns"></a>
### `setColumns()`

Set all the columns at once. Overwrites **all** previously set columns.

#### Signature

-  It accepts the following parameter(s):
    - `$columns` (`array`) &mdash;
       eg, `array('label' => 'www.php.net', 'nb_visits' => 15894)`
- It does not return anything.

<a name="setcolumn" id="setcolumn"></a>
<a name="setColumn" id="setColumn"></a>
### `setColumn()`

Set the value `$value` to the column called `$name`.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       name of the column to set.
    - `$value` (`mixed`) &mdash;
       value of the column to set.
- It does not return anything.

<a name="setmetadata" id="setmetadata"></a>
<a name="setMetadata" id="setMetadata"></a>
### `setMetadata()`

Set the value `$value` to the metadata called `$name`.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       name of the metadata to set.
    - `$value` (`mixed`) &mdash;
       value of the metadata to set.
- It does not return anything.

<a name="deletemetadata" id="deletemetadata"></a>
<a name="deleteMetadata" id="deleteMetadata"></a>
### `deleteMetadata()`

Deletes one metadata value or all metadata values.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`bool`|`string`) &mdash;
       Metadata name (omit to delete entire metadata).

- *Returns:*  `bool` &mdash;
    `true` on success, `false` if the column didn't exist

<a name="addcolumn" id="addcolumn"></a>
<a name="addColumn" id="addColumn"></a>
### `addColumn()`

Add a new column to the row. If the column already exists, throws an exception.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       name of the column to add.
    - `$value` (`mixed`) &mdash;
       value of the column to set or a PHP callable.
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the column already exists.

<a name="addcolumns" id="addcolumns"></a>
<a name="addColumns" id="addColumns"></a>
### `addColumns()`

Add many columns to this row.

#### Signature

-  It accepts the following parameter(s):
    - `$columns` (`array`) &mdash;
       Name/Value pairs, e.g., `array('name' => $value , ...)`
- It returns a `void` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if any column name does not exist.

<a name="addmetadata" id="addmetadata"></a>
<a name="addMetadata" id="addMetadata"></a>
### `addMetadata()`

Add a new metadata to the row. If the metadata already exists, throws an exception.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       name of the metadata to add.
    - `$value` (`mixed`) &mdash;
       value of the metadata to set.
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the metadata already exists.

<a name="sumrow" id="sumrow"></a>
<a name="sumRow" id="sumRow"></a>
### `sumRow()`

Sums the given `$rowToSum` columns values to the existing row column values.

Only the int or float values will be summed. Label columns will be ignored
even if they have a numeric value.

Columns in `$rowToSum` that don't exist in `$this` are added to `$this`.

#### Signature

-  It accepts the following parameter(s):
    - `$rowToSum` ([`Row`](../../Piwik/DataTable/Row.md)) &mdash;
       The row to sum to this row.
    - `$enableCopyMetadata` (`bool`) &mdash;
       Whether metadata should be copied or not.
    - `$aggregationOperations` (`array`|`bool`) &mdash;
       for columns that should not be summed, determine which aggregation should be used (min, max). format: `array('column name' => 'function name')`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="sumrowmetadata" id="sumrowmetadata"></a>
<a name="sumRowMetadata" id="sumRowMetadata"></a>
### `sumRowMetadata()`

Sums the metadata in `$rowToSum` with the metadata in `$this` row.

#### Signature

-  It accepts the following parameter(s):
    - `$rowToSum` ([`Row`](../../Piwik/DataTable/Row.md)) &mdash;
      
    - `$aggregationOperations` (`array`) &mdash;
      
- It does not return anything.

<a name="issummaryrow" id="issummaryrow"></a>
<a name="isSummaryRow" id="isSummaryRow"></a>
### `isSummaryRow()`

Returns `true` if this row is the summary row, `false` if otherwise. This function
depends on the label of the row, and so, is not 100% accurate.

#### Signature

- It returns a `bool` value.

<a name="getcomparisons" id="getcomparisons"></a>
<a name="getComparisons" id="getComparisons"></a>
### `getComparisons()`

Returns the associated comparisons DataTable, if any.

#### Signature


- *Returns:*  [`DataTable`](../../Piwik/DataTable.md)|`null` &mdash;
    

<a name="setcomparisons" id="setcomparisons"></a>
<a name="setComparisons" id="setComparisons"></a>
### `setComparisons()`

Associates the supplied table with this row as the comparisons table.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../Piwik/DataTable.md)) &mdash;
      
- It does not return anything.

<a name="isequal" id="isequal"></a>
<a name="isEqual" id="isEqual"></a>
### `isEqual()`

Helper function that tests if two rows are equal.

Two rows are equal if:

- they have exactly the same columns / metadata
- they have a subDataTable associated, then we check that both of them are the same.

Column order is not important.

#### Signature

-  It accepts the following parameter(s):
    - `$row1` ([`Row`](../../Piwik/DataTable/Row.md)) &mdash;
       first to compare
    - `$row2` ([`Row`](../../Piwik/DataTable/Row.md)) &mdash;
       second to compare
- It returns a `bool` value.

