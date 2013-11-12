<small>Piwik\DataTable\Filter</small>

Truncate
========

Truncates a DataTable by merging all rows after a certain index into a new summary row, unless the count of rows is less than the index.

Description
-----------

The [ReplaceSummaryRow](#) filter will be queued after the table is truncated.

### Examples

**Basic usage**

    $dataTable->filter('Truncate', array($truncateAfter = 500));

**Using a custom summary row label**

    $dataTable->filter('Truncate', array($truncateAfter = 500, $summaryRowLabel = Piwik::translate('General_Total')));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; Executes the filter, see [Truncate](#).
- [`addSummaryRow()`](#addsummaryrow)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash; The table that will be filtered eventually.
    - `$truncateAfter` (`int`) &mdash; The row index to truncate at. All rows passed this index will be removed.
    - `$labelSummaryRow` (`string`) &mdash; The label to use for the summary row. Defaults to `Piwik::translate('General_Others')`.
    - `$columnToSortByBeforeTruncating` (`string`) &mdash; The column to sort by before truncation, eg, `'nb_visits'`.
    - `$filterRecursive` (`bool`) &mdash; If true executes this filter on all subtables descending from `$table`.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

Executes the filter, see [Truncate](#).

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
- It does not return anything.

<a name="addsummaryrow" id="addsummaryrow"></a>
<a name="addSummaryRow" id="addSummaryRow"></a>
### `addSummaryRow()`

#### Signature

- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

