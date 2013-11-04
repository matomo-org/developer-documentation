<small>Piwik\DataTable</small>

Row
===

This is what a [DataTable](#) is composed of.

Description
-----------

DataTable rows contain columns, metadata and a subtable ID. Columns and metadata
are stored as an array of name => value mappings.


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

- [`__construct()`](#__construct) &mdash; Constructor.
- [`__sleep()`](#__sleep) &mdash; Because $this->c[self::DATATABLE_ASSOCIATED] is negative when the table is in memory, we must prior to serialize() call, make sure the ID is saved as positive integer
- [`cleanPostSerialize()`](#cleanPostSerialize) &mdash; Must be called after the row was serialized and __sleep was called.
- [`__destruct()`](#__destruct) &mdash; When destroyed, a row destroys its associated subTable if there is one
- [`__toString()`](#__toString) &mdash; Applies a basic rendering to the Row and returns the output.
- [`deleteColumn()`](#deleteColumn) &mdash; Deletes the given column.
- [`renameColumn()`](#renameColumn) &mdash; Renames a column.
- [`getColumn()`](#getColumn) &mdash; Returns a column by name.
- [`getMetadata()`](#getMetadata) &mdash; Returns the array of all metadata, or one requested metadata value.
- [`getColumns()`](#getColumns) &mdash; Returns the array containing all the columns.
- [`getIdSubDataTable()`](#getIdSubDataTable) &mdash; Returns the ID of the subDataTable.
- [`getSubtable()`](#getSubtable) &mdash; Returns the associated subtable, if one exists.
- [`sumSubtable()`](#sumSubtable) &mdash; Sums a DataTable to this row's subtable.
- [`addSubtable()`](#addSubtable) &mdash; Attaches a subtable to this row.
- [`setSubtable()`](#setSubtable) &mdash; Attaches a subtable to this row, overwriting the existing subtable, if any.
- [`isSubtableLoaded()`](#isSubtableLoaded) &mdash; Returns true if the subtable is currently loaded in memory via [DataTable\Manager](#).
- [`removeSubtable()`](#removeSubtable) &mdash; Removes the subtable reference.
- [`setColumns()`](#setColumns) &mdash; Set all the columns at once.
- [`setColumn()`](#setColumn) &mdash; Set the value `$value` to the column called `$name`.
- [`setMetadata()`](#setMetadata) &mdash; Set the value `$value` to the metadata called `$name`.
- [`deleteMetadata()`](#deleteMetadata) &mdash; Deletes one metadata value or all metadata values.
- [`addColumn()`](#addColumn) &mdash; Add a new column to the row.
- [`addColumns()`](#addColumns) &mdash; Add many columns to this row.
- [`addMetadata()`](#addMetadata) &mdash; Add a new metadata to the row.
- [`sumRow()`](#sumRow) &mdash; Sums the given `$rowToSum` columns values to the existing row column values.
- [`sumRowMetadata()`](#sumRowMetadata) &mdash; Sums the metadata in `$rowToSum` with the metadata in `$this` row.
- [`isSummaryRow()`](#isSummaryRow) &mdash; Returns true if this row is the summary row, false if otherwise.
- [`compareElements()`](#compareElements) &mdash; Helper function to compare array elements
- [`isEqual()`](#isEqual) &mdash; Helper function that tests if two rows are equal.

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$row`
- It does not return anything.

### `__sleep()` <a name="__sleep"></a>

Because $this->c[self::DATATABLE_ASSOCIATED] is negative when the table is in memory, we must prior to serialize() call, make sure the ID is saved as positive integer

#### Description

Only serialize the "c" member

#### Signature

- It is a **public** method.
- It does not return anything.

### `cleanPostSerialize()` <a name="cleanPostSerialize"></a>

Must be called after the row was serialized and __sleep was called.

#### Signature

- It is a **public** method.
- It does not return anything.

### `__destruct()` <a name="__destruct"></a>

When destroyed, a row destroys its associated subTable if there is one

#### Signature

- It is a **public** method.
- It does not return anything.

### `__toString()` <a name="__toString"></a>

Applies a basic rendering to the Row and returns the output.

#### Signature

- It is a **public** method.
- _Returns:_ describing the row. Example: &quot;- 1 [&#039;label&#039; =&gt; &#039;piwik&#039;, &#039;nb_uniq_visitors&#039; =&gt; 1685, &#039;nb_visits&#039; =&gt; 1861] [] [idsubtable = 1375]&quot;
    - `string`

### `deleteColumn()` <a name="deleteColumn"></a>

Deletes the given column.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- _Returns:_ True on success, false if the column does not exist.
    - `bool`

### `renameColumn()` <a name="renameColumn"></a>

Renames a column.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$oldName`
    - `$newName`
- It does not return anything.

### `getColumn()` <a name="getColumn"></a>

Returns a column by name.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- _Returns:_ The column value or false if it doesn&#039;t exist.
    - `mixed`
    - `Piwik\DataTable\false`

### `getMetadata()` <a name="getMetadata"></a>

Returns the array of all metadata, or one requested metadata value.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- It returns a(n) `mixed` value.

### `getColumns()` <a name="getColumns"></a>

Returns the array containing all the columns.

#### Signature

- It is a **public** method.
- _Returns:_ Example: ``` array( &#039;column1&#039;   =&gt; VALUE, &#039;label&#039;     =&gt; &#039;www.php.net&#039; &#039;nb_visits&#039; =&gt; 15894, ) ```
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

#### Description

Returns `false` if none exists.

#### Signature

- It is a **public** method.
- It can return one of the following values:
    - [`DataTable`](../../Piwik/DataTable.md)
    - `bool`

### `sumSubtable()` <a name="sumSubtable"></a>

Sums a DataTable to this row's subtable.

#### Description

If this row has no subtable a new
one is created.

See [DataTable::addDataTable()](#) to learn how DataTables are summed.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$subTable` ([`DataTable`](../../Piwik/DataTable.md))
- It does not return anything.

### `addSubtable()` <a name="addSubtable"></a>

Attaches a subtable to this row.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$subTable` ([`DataTable`](../../Piwik/DataTable.md))
- _Returns:_ Returns `$subTable`.
    - [`DataTable`](../../Piwik/DataTable.md)
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if a subtable already exists for this row.

### `setSubtable()` <a name="setSubtable"></a>

Attaches a subtable to this row, overwriting the existing subtable, if any.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$subTable` ([`DataTable`](../../Piwik/DataTable.md))
- _Returns:_ Returns `$subTable`.
    - [`DataTable`](../../Piwik/DataTable.md)

### `isSubtableLoaded()` <a name="isSubtableLoaded"></a>

Returns true if the subtable is currently loaded in memory via [DataTable\Manager](#).

#### Signature

- It is a **public** method.
- It returns a(n) `bool` value.

### `removeSubtable()` <a name="removeSubtable"></a>

Removes the subtable reference.

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

Set the value `$value` to the column called `$name`.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$value`
- It does not return anything.

### `setMetadata()` <a name="setMetadata"></a>

Set the value `$value` to the metadata called `$name`.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$value`
- It does not return anything.

### `deleteMetadata()` <a name="deleteMetadata"></a>

Deletes one metadata value or all metadata values.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- _Returns:_ true on success, false if the column didn&#039;t exist
    - `bool`

### `addColumn()` <a name="addColumn"></a>

Add a new column to the row.

#### Description

If the column already exists, throws an exception.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$value`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the column already exists.

### `addColumns()` <a name="addColumns"></a>

Add many columns to this row.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$columns`
- It returns a(n) `void` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if any column name does not exist.

### `addMetadata()` <a name="addMetadata"></a>

Add a new metadata to the row.

#### Description

If the metadata already exists, throws an exception.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$value`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the metadata already exists.

### `sumRow()` <a name="sumRow"></a>

Sums the given `$rowToSum` columns values to the existing row column values.

#### Description

Only the int or float values will be summed. Label columns will be ignored
even if they have a numeric value.

Columns in `$rowToSum` that don't exist in `$this` are added to `$this`.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$rowToSum` ([`Row`](../../Piwik/DataTable/Row.md))
    - `$enableCopyMetadata`
    - `$aggregationOperations`
- It does not return anything.

### `sumRowMetadata()` <a name="sumRowMetadata"></a>

Sums the metadata in `$rowToSum` with the metadata in `$this` row.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$rowToSum`
- It does not return anything.

### `isSummaryRow()` <a name="isSummaryRow"></a>

Returns true if this row is the summary row, false if otherwise.

#### Description

This function
depends on the label of the row, and so, is not 100% accurate.

#### Signature

- It is a **public** method.
- It returns a(n) `bool` value.

### `compareElements()` <a name="compareElements"></a>

Helper function to compare array elements

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$elem1`
    - `$elem2`
- It returns a(n) `bool` value.

### `isEqual()` <a name="isEqual"></a>

Helper function that tests if two rows are equal.

#### Description

Two rows are equal if:

- they have exactly the same columns / metadata
- they have a subDataTable associated, then we check that both of them are the same.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$row1` ([`Row`](../../Piwik/DataTable/Row.md))
    - `$row2` ([`Row`](../../Piwik/DataTable/Row.md))
- It returns a(n) `bool` value.

