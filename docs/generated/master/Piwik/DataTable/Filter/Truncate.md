<small>Piwik\DataTable\Filter</small>

Truncate
========

Truncates a DataTable by merging all rows after a certain index into a new summary row, unless the count of rows is less than the index.

Description
-----------

The [ReplaceSummaryRow](#) filter will be queued after the table is truncated.

### Examples

**Basic usage**

    $dataTable-&gt;filter(&#039;Truncate&#039;, array($truncateAfter = 500));

**Using a custom summary row label**

    $dataTable-&gt;filter(&#039;Truncate&#039;, array($truncateAfter = 500, $summaryRowLabel = Piwik::translate(&#039;General_Total&#039;)));


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; Executes the filter, see [Truncate](#).
- [`addSummaryRow()`](#addSummaryRow)

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$truncateAfter`
    - `$labelSummaryRow`
    - `$columnToSortByBeforeTruncating`
    - `$filterRecursive`
- It does not return anything.

### `filter()` <a name="filter"></a>

Executes the filter, see [Truncate](#).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

### `addSummaryRow()` <a name="addSummaryRow"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

