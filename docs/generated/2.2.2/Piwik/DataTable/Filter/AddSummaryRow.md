<small>Piwik\DataTable\Filter\</small>

AddSummaryRow
=============

Adds a summary row to DataTables that contains the sum of all other table rows.

**Basic usage example**

    $dataTable->filter('AddSummaryRow');

    // use a human readable label for the summary row (instead of '-1')
    $dataTable->filter('AddSummaryRow', array($labelSummaryRow = Piwik::translate('General_Total')));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; Executes the filter.

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

      <div markdown="1" class="param-desc"> The table that will be filtered.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$labelSummaryRow` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The value of the label column for the new row.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

Executes the filter.

See [AddSummaryRow](/api-reference/Piwik/DataTable/Filter/AddSummaryRow).

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

