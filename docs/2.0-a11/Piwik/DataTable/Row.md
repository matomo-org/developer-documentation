<small>Piwik\DataTable</small>

Row
===

A DataTable is composed of rows.

Description
-----------

A row is composed of:
- columns often at least a &#039;label&#039; column containing the description
       of the row, and some numeric values (&#039;nb_visits&#039;, etc.)
- metadata: other information never to be shown as &#039;columns&#039;
- idSubtable: a row can be linked to a SubTable

IMPORTANT: Make sure that the column named &#039;label&#039; contains at least one non-numeric character.
           Otherwise the method addDataTable() or sumRow() would fail because they would consider
           the &#039;label&#039; as being a numeric column to sum.

PERFORMANCE: Do *not* add new fields except if necessary in this object. New fields will be
             serialized and recorded in the DB millions of times. This object size is critical and must be under control.


Constants
---------

This class defines the following constants:

- [`COLUMNS`](#COLUMNS)
- [`METADATA`](#METADATA)
- [`DATATABLE_ASSOCIATED`](#DATATABLE_ASSOCIATED)

Properties
----------

This class defines the following properties:

- [`$c`](#$c) &mdash; This array contains the row information: - array indexed by self::COLUMNS contains the columns, pairs of (column names, value) - (optional) array indexed by self::METADATA contains the metadata,  pairs of (metadata name, value) - (optional) integer indexed by self::DATATABLE_ASSOCIATED contains the ID of the DataTable associated to this row.
- [`$maxVisitsSummed`](#$maxVisitsSummed)

### `$c` <a name="c"></a>

This array contains the row information: - array indexed by self::COLUMNS contains the columns, pairs of (column names, value) - (optional) array indexed by self::METADATA contains the metadata,  pairs of (metadata name, value) - (optional) integer indexed by self::DATATABLE_ASSOCIATED contains the ID of the DataTable associated to this row.

#### Description

This ID can be used to read the DataTable from the DataTable_Manager.

#### Signature

- It is a **public** property.
- It is a(n) `array` value.

### `$maxVisitsSummed` <a name="maxVisitsSummed"></a>

#### Signature

- It is a **public** property.
- Its type is not specified.


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Efficient load of the Row structure from a well structured php array
- [`__sleep()`](#__sleep) &mdash; Because $this-&gt;c[self::DATATABLE_ASSOCIATED] is negative when the table is in memory, we must prior to serialize() call, make sure the ID is saved as positive integer
- [`cleanPostSerialize()`](#cleanPostSerialize) &mdash; Must be called after the row was serialized and __sleep was called
- [`__destruct()`](#__destruct) &mdash; When destroyed, a row destroys its associated subTable if there is one
- [`__toString()`](#__toString) &mdash; Applies a basic rendering to the Row and returns the output
- [`deleteColumn()`](#deleteColumn) &mdash; Deletes the given column
- [`renameColumn()`](#renameColumn) &mdash; Renames the given column
- [`getColumn()`](#getColumn) &mdash; Returns the given column
- [`getMetadata()`](#getMetadata) &mdash; Returns the array of all metadata, or the specified metadata
- [`getColumns()`](#getColumns) &mdash; Returns the array containing all the columns
- [`getIdSubDataTable()`](#getIdSubDataTable) &mdash; Returns the ID of the subDataTable.
- [`getSubtable()`](#getSubtable) &mdash; Returns the associated subtable, if one exists.
- [`sumSubtable()`](#sumSubtable) &mdash; Sums a DataTable to this row subDataTable.
- [`addSubtable()`](#addSubtable) &mdash; Set a DataTable to be associated to this row.
- [`setSubtable()`](#setSubtable) &mdash; Set a DataTable to this row.
- [`isSubtableLoaded()`](#isSubtableLoaded) &mdash; Returns true if the subtable is currently loaded in memory via DataTable_Manager
- [`removeSubtable()`](#removeSubtable) &mdash; Remove the sub table reference
- [`setColumns()`](#setColumns) &mdash; Set all the columns at once.
- [`setColumn()`](#setColumn) &mdash; Set the value $value to the column called $name.
- [`setMetadata()`](#setMetadata) &mdash; Set the value $value to the metadata called $name.
- [`deleteMetadata()`](#deleteMetadata) &mdash; Deletes the given metadata
- [`addColumn()`](#addColumn) &mdash; Add a new column to the row.
- [`addColumns()`](#addColumns) &mdash; Add columns to the row
- [`addMetadata()`](#addMetadata) &mdash; Add a new metadata to the row.
- [`sumRow()`](#sumRow) &mdash; Sums the given $row columns values to the existing row&#039; columns values.
- [`sumRowMetadata()`](#sumRowMetadata)
- [`isSummaryRow()`](#isSummaryRow)
- [`compareElements()`](#compareElements) &mdash; Helper function to compare array elements
- [`isEqual()`](#isEqual) &mdash; Helper function to test if two rows are equal.

### `__construct()` <a name="__construct"></a>

Efficient load of the Row structure from a well structured php array

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$row`
- It does not return anything.

### `__sleep()` <a name="__sleep"></a>

Because $this-&gt;c[self::DATATABLE_ASSOCIATED] is negative when the table is in memory, we must prior to serialize() call, make sure the ID is saved as positive integer

#### Description

Only serialize the &quot;c&quot; member

#### Signature

- It is a **public** method.
- It does not return anything.

### `cleanPostSerialize()` <a name="cleanPostSerialize"></a>

Must be called after the row was serialized and __sleep was called

#### Signature

- It is a **public** method.
- It does not return anything.

### `__destruct()` <a name="__destruct"></a>

When destroyed, a row destroys its associated subTable if there is one

#### Signature

- It is a **public** method.
- It does not return anything.

### `__toString()` <a name="__toString"></a>

Applies a basic rendering to the Row and returns the output

#### Signature

- It is a **public** method.
- _Returns:_ characterizing the row. Example: - 1 [&#039;label&#039; =&gt; &#039;piwik&#039;, &#039;nb_uniq_visitors&#039; =&gt; 1685, &#039;nb_visits&#039; =&gt; 1861, &#039;nb_actions&#039; =&gt; 2271, &#039;max_actions&#039; =&gt; 13, &#039;sum_visit_length&#039; =&gt; 920131, &#039;bounce_count&#039; =&gt; 1599] [] [idsubtable = 1375]
    - `string`

### `deleteColumn()` <a name="deleteColumn"></a>

Deletes the given column

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- _Returns:_ True on success, false if the column didn&#039;t exist
    - `bool`

### `renameColumn()` <a name="renameColumn"></a>

Renames the given column

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$oldName`
    - `$newName`
- It does not return anything.

### `getColumn()` <a name="getColumn"></a>

Returns the given column

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- _Returns:_ The column value or false if it doesn&#039;t exist
    - `mixed`
    - `bool`

### `getMetadata()` <a name="getMetadata"></a>

Returns the array of all metadata, or the specified metadata

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- It returns a(n) `mixed` value.

### `getColumns()` <a name="getColumns"></a>

Returns the array containing all the columns

#### Signature

- It is a **public** method.
- _Returns:_ Example: array( &#039;column1&#039;   =&gt; VALUE, &#039;label&#039;     =&gt; &#039;www.php.net&#039; &#039;nb_visits&#039; =&gt; 15894, )
    - `array`

### `getIdSubDataTable()` <a name="getIdSubDataTable"></a>

Returns the ID of the subDataTable.

#### Description

If there is no such a table, returns null.

#### Signature

- It is a **public** method.
- It can return one of the following values:
    - `int`
    - `null`

### `getSubtable()` <a name="getSubtable"></a>

Returns the associated subtable, if one exists.

#### Signature

- It is a **public** method.
- _Returns:_ false if no subtable loaded
    - [`DataTable`](../../Piwik/DataTable.md)
    - `bool`

### `sumSubtable()` <a name="sumSubtable"></a>

Sums a DataTable to this row subDataTable.

#### Description

If this row doesn&#039;t have a SubDataTable yet, we create a new one.
Then we add the values of the given DataTable to this row&#039;s DataTable.

#### See Also

- `DataTable::addDataTable()` &mdash; for the algorithm used for the sum

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$subTable` ([`DataTable`](../../Piwik/DataTable.md))
- It does not return anything.

### `addSubtable()` <a name="addSubtable"></a>

Set a DataTable to be associated to this row.

#### Description

If the row already has a DataTable associated to it, throws an Exception.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$subTable` ([`DataTable`](../../Piwik/DataTable.md))
- _Returns:_ Returns $subTable.
    - [`DataTable`](../../Piwik/DataTable.md)
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `setSubtable()` <a name="setSubtable"></a>

Set a DataTable to this row.

#### Description

If there is already
a DataTable associated, it is simply overwritten.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$subTable` ([`DataTable`](../../Piwik/DataTable.md))
- _Returns:_ Returns $subTable.
    - [`DataTable`](../../Piwik/DataTable.md)

### `isSubtableLoaded()` <a name="isSubtableLoaded"></a>

Returns true if the subtable is currently loaded in memory via DataTable_Manager

#### Signature

- It is a **public** method.
- It returns a(n) `bool` value.

### `removeSubtable()` <a name="removeSubtable"></a>

Remove the sub table reference

#### Signature

- It is a **public** method.
- It does not return anything.

### `setColumns()` <a name="setColumns"></a>

Set all the columns at once.

#### Description

Overwrites previously set columns.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$columns`
- It does not return anything.

### `setColumn()` <a name="setColumn"></a>

Set the value $value to the column called $name.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$value`
- It does not return anything.

### `setMetadata()` <a name="setMetadata"></a>

Set the value $value to the metadata called $name.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$value`
- It does not return anything.

### `deleteMetadata()` <a name="deleteMetadata"></a>

Deletes the given metadata

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- _Returns:_ True on success, false if the column didn&#039;t exist
    - `bool`

### `addColumn()` <a name="addColumn"></a>

Add a new column to the row.

#### Description

If the column already exists, throws an exception

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$value`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `addColumns()` <a name="addColumns"></a>

Add columns to the row

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$columns`
- It returns a(n) `void` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `addMetadata()` <a name="addMetadata"></a>

Add a new metadata to the row.

#### Description

If the column already exists, throws an exception.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$value`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `sumRow()` <a name="sumRow"></a>

Sums the given $row columns values to the existing row&#039; columns values.

#### Description

It will sum only the int or float values of $row.
It will not sum the column &#039;label&#039; even if it has a numeric value.
If a given column doesn&#039;t exist in $this then it is added with the value of $row.
If the column already exists in $this then we have
        this.columns[idThisCol] += $row.columns[idThisCol]

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$rowToSum` ([`Row`](../../Piwik/DataTable/Row.md))
    - `$enableCopyMetadata`
    - `$aggregationOperations`
- It does not return anything.

### `sumRowMetadata()` <a name="sumRowMetadata"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$rowToSum`
- It does not return anything.

### `isSummaryRow()` <a name="isSummaryRow"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

### `compareElements()` <a name="compareElements"></a>

Helper function to compare array elements

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$elem1`
    - `$elem2`
- It returns a(n) `bool` value.

### `isEqual()` <a name="isEqual"></a>

Helper function to test if two rows are equal.

#### Description

Two rows are equal
- if they have exactly the same columns / metadata
- if they have a subDataTable associated, then we check that both of them are the same.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$row1` ([`Row`](../../Piwik/DataTable/Row.md))
    - `$row2` ([`Row`](../../Piwik/DataTable/Row.md))
- It returns a(n) `bool` value.

