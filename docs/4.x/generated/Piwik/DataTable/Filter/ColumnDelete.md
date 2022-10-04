<small>Piwik\DataTable\Filter\</small>

ColumnDelete
============

Filter that will remove columns from a DataTable using either a blacklist, allowlist or both.

This filter is used to handle the **hideColumn** and **showColumn** query parameters.

**Basic usage example**

    $columnsToRemove = array('nb_hits', 'nb_pageviews');
    $dataTable->filter('ColumnDelete', array($columnsToRemove));

    $columnsToKeep = array('nb_visits');
    $dataTable->filter('ColumnDelete', array(array(), $columnsToKeep));

Constants
---------

This class defines the following constants:

- [`APPEND_TO_COLUMN_NAME_TO_KEEP`](#append_to_column_name_to_keep) — Hack: when specifying "showColumns", sometimes we'd like to also keep columns that "look" like a given column,
without manually specifying all these columns (which may not be possible if column names are generated dynamically) Inherited from [`ColumnDelete`](../../../Piwik/DataTable/Filter/ColumnDelete.md)
<a name="append_to_column_name_to_keep" id="append_to_column_name_to_keep"></a>
<a name="APPEND_TO_COLUMN_NAME_TO_KEEP" id="APPEND_TO_COLUMN_NAME_TO_KEEP"></a>
### `APPEND_TO_COLUMN_NAME_TO_KEEP`

Column will be kept, if they match any name in the $columnsToKeep, or if they look like anyColumnToKeep__anythingHere

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ColumnDelete](/api-reference/Piwik/DataTable/Filter/ColumnDelete).
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
    - `$columnsToRemove` (`array`|`string`) &mdash;
       An array of column names or a comma-separated list of column names. These columns will be removed.
    - `$columnsToKeep` (`array`|`string`) &mdash;
       An array of column names that should be kept or a comma-separated list of column names. Columns not in this list will be removed.
    - `$deleteIfZeroOnly` (`bool`) &mdash;
       If true, columns will be removed only if their value is 0.
    - `$deleteRecursive` (`bool`) &mdash;
       If true, columns will be removed in nested arrays.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [ColumnDelete](/api-reference/Piwik/DataTable/Filter/ColumnDelete).

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`Piwik\DataTable\DataTable`) &mdash;
      
- It does not return anything or a mixed result.

<a name="enablerecursive" id="enablerecursive"></a>
<a name="enableRecursive" id="enableRecursive"></a>
### `enableRecursive()`

Enables/Disables recursive filtering. Whether this property is actually used
is up to the derived BaseFilter class.

#### Signature

-  It accepts the following parameter(s):
    - `$enable` (`bool`) &mdash;
      
- It does not return anything or a mixed result.

<a name="filtersubtable" id="filtersubtable"></a>
<a name="filterSubTable" id="filterSubTable"></a>
### `filterSubTable()`

Filters a row's subtable, if one exists and is loaded in memory.

#### Signature

-  It accepts the following parameter(s):
    - `$row` ([`Row`](../../../Piwik/DataTable/Row.md)) &mdash;
       The row whose subtable should be filter.
- It does not return anything or a mixed result.

