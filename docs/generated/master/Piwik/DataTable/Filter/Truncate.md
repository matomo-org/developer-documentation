<small>Piwik\DataTable\Filter</small>

Truncate
========

Truncates a DataTable by merging all rows after a certain index into a new summary row, unless the count of rows is less than the index.

Description
-----------

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
- [`addSummaryRow()`](#addsummaryrow)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;

      <div markdown="1" class="param-desc"> The table that will be filtered eventually.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$truncateAfter` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The row index to truncate at. All rows passed this index will be removed.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$labelSummaryRow` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The label to use for the summary row. Defaults to `Piwik::translate('General_Others')`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$columnToSortByBeforeTruncating` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The column to sort by before truncation, eg, `'nb_visits'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$filterRecursive` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> If true executes this filter on all subtables descending from `$table`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

Executes the filter, see [Truncate](/api-reference/Piwik/DataTable/Filter/Truncate).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="addsummaryrow" id="addsummaryrow"></a>
<a name="addSummaryRow" id="addSummaryRow"></a>
### `addSummaryRow()`

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$table`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

