<small>Piwik\DataTable\Filter\</small>

Sort
====

Sorts a DataTable based on the value of a specific column.

It is possible to specify a natural sorting (see [php.net/natsort](http://php.net/natsort) for details).

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See Sort.
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
    - `$columnToSort` (`string`) &mdash;
       The name of the column to sort by.
    - `$order` (`string`) &mdash;
       order `'asc'` or `'desc'`.
    - `$naturalSort` (`bool`) &mdash;
       Whether to use a natural sort or not (see [http://php.net/natsort](http://php.net/natsort)).
    - `$recursiveSort` (`bool`) &mdash;
       Whether to sort all subtables or not.
    - `$doSortBySecondaryColumn` (`bool`|`Stmt_Namespace\callback`) &mdash;
       If true will sort by a secondary column. The column is automatically detected and will be either nb_visits or label, if possible. If callback given it will sort by the column returned by the callback (if any) callback will be called with 2 parameters: primaryColumnToSort and table

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See Sort.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`Stmt_Namespace\DataTable`) &mdash;
      
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

