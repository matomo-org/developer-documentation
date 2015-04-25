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
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
       The DataTable that will eventually be filtered.
    - `$columnNameToAdd` (`string`) &mdash;
       The name of the column to add the quotient value to.
    - `$columnValueToRead` (`string`) &mdash;
       The name of the column that holds the dividend.
    - `$divisorValueOrDivisorColumnName` (`Piwik\DataTable\Filter\number`|`string`) &mdash;
       Either numeric value to use as the divisor for every row, or the name of the column whose value should be used as the divisor.
    - `$quotientPrecision` (`int`) &mdash;
       The precision to use when rounding the quotient.
    - `$shouldSkipRows` (`bool`|`Piwik\DataTable\Filter\number`) &mdash;
       Whether rows w/o the column to read should be skipped or not.
    - `$getDivisorFromSummaryRow` (`bool`) &mdash;
       Whether to get the divisor from the summary row or the current row iteration.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [ColumnCallbackAddColumnQuotient](/api-reference/Piwik/DataTable/Filter/ColumnCallbackAddColumnQuotient).

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
- It does not return anything.

