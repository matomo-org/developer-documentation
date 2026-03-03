<small>Piwik\DataTable\Filter\</small>

Limit
=====

Delete all rows from the table that are not in the given [offset, offset+limit) range.

**Basic example usage**

    // delete all rows from 5 -> 15
    $dataTable->filter('Limit', array(5, 10));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [Limit](/api-reference/Piwik/DataTable/Filter/Limit).
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
    - `$offset` (`int`) &mdash;
       The starting row index to keep.
    - `$limit` (`int`) &mdash;
       Number of rows to keep (specify -1 to keep all rows).
    - `$keepSummaryRow` (`bool`) &mdash;
       Whether to keep the summary row or not.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [Limit](/api-reference/Piwik/DataTable/Filter/Limit).

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
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

