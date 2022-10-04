<small>Piwik\DataTable\Filter\</small>

Truncate
========

Truncates a DataTable by merging all rows after a certain index into a new summary row.

The [ReplaceSummaryRowLabel](/api-reference/Piwik/DataTable/Filter/ReplaceSummaryRowLabel) filter will be queued after the table is truncated.

### Examples

**Basic usage**

    $dataTable->filter('Truncate', array($truncateAfter = 500));

**Using a custom summary row label**

    $dataTable->filter('Truncate', array($truncateAfter = 500, $summaryRowLabel = Piwik::translate('General_Total')));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; Executes the filter, see [Truncate](/api-reference/Piwik/DataTable/Filter/Truncate).
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
    - `$truncateAfter` (`int`) &mdash;
       The row index to truncate at. All rows passed this index will be removed.
    - `$labelSummaryRow` (`string`) &mdash;
       The label to use for the summary row. Defaults to `Piwik::translate('General_Others')`.
    - `$columnToSortByBeforeTruncating` (`string`) &mdash;
       The column to sort by before truncation, eg, `'nb_visits'`.
    - `$filterRecursive` (`bool`) &mdash;
       If true executes this filter on all subtables descending from `$table`.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

Executes the filter, see [Truncate](/api-reference/Piwik/DataTable/Filter/Truncate).

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

