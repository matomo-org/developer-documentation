<small>Piwik\DataTable\Filter\</small>

ReplaceSummaryRowLabel
======================

Replaces the label of the summary row with a supplied label.

This filter is only used to prettify the summary row label and so it should
always be queued on a DataTable.

This filter always recurses. In other words, this filter will always apply itself to
all subtables in the given DataTable's table hierarchy.

**Basic example**

    $dataTable->queueFilter('ReplaceSummaryRowLabel', array(Piwik::translate('General_Others')));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ReplaceSummaryRowLabel](/api-reference/Piwik/DataTable/Filter/ReplaceSummaryRowLabel).
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
    - `$newLabel` (`string`|`null`) &mdash;
       The new label for summary row. If null, defaults to `Piwik::translate('General_Others')`.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [ReplaceSummaryRowLabel](/api-reference/Piwik/DataTable/Filter/ReplaceSummaryRowLabel).

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

