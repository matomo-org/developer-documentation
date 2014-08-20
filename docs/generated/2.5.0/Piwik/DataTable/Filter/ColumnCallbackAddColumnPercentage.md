<small>Piwik\DataTable\Filter\</small>

ColumnCallbackAddColumnPercentage
=================================

Calculates a percentage value for each row of a DataTable and adds the result to each row.

See [ColumnCallbackAddColumnQuotient](/api-reference/Piwik/DataTable/Filter/ColumnCallbackAddColumnQuotient) for more information.

**Basic usage example**

    $nbVisits = // ... get the visits for a period ...
    $dataTable->queueFilter('ColumnCallbackAddColumnPercentage', array('nb_visits', 'nb_visits_percentage', $nbVisits, 1));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor. Inherited from [`ColumnCallbackAddColumnQuotient`](../../../Piwik/DataTable/Filter/ColumnCallbackAddColumnQuotient.md)
- [`filter()`](#filter) &mdash; See [ColumnCallbackAddColumnQuotient](/api-reference/Piwik/DataTable/Filter/ColumnCallbackAddColumnQuotient). Inherited from [`ColumnCallbackAddColumnQuotient`](../../../Piwik/DataTable/Filter/ColumnCallbackAddColumnQuotient.md)

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

      <div markdown="1" class="param-desc"> The DataTable that will eventually be filtered.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$columnNameToAdd` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The name of the column to add the quotient value to.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$columnValueToRead` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The name of the column that holds the dividend.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$divisorValueOrDivisorColumnName` (`Piwik\DataTable\Filter\number`|`string`) &mdash;

      <div markdown="1" class="param-desc"> Either numeric value to use as the divisor for every row, or the name of the column whose value should be used as the divisor.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$quotientPrecision` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The precision to use when rounding the quotient.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$shouldSkipRows` (`bool`|`Piwik\DataTable\Filter\number`) &mdash;

      <div markdown="1" class="param-desc"> Whether rows w/o the column to read should be skipped or not.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$getDivisorFromSummaryRow` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether to get the divisor from the summary row or the current row iteration.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [ColumnCallbackAddColumnQuotient](/api-reference/Piwik/DataTable/Filter/ColumnCallbackAddColumnQuotient).

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

