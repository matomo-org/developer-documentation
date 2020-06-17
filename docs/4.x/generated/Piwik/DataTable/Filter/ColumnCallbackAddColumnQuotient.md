<small>Piwik\DataTable\Filter\</small>

ColumnCallbackAddColumnQuotient
===============================

Calculates the quotient of two columns and adds the result as a new column for each row of a DataTable.

This filter is used to calculate rate values (eg, `'bounce_rate'`), averages
(eg, `'avg_time_on_page'`) and other types of values.

**Basic usage example**

    $dataTable->queueFilter('ColumnCallbackAddColumnQuotient', array('bounce_rate', 'bounce_count', 'nb_visits', $precision = 2));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ColumnCallbackAddColumnQuotient](/api-reference/Piwik/DataTable/Filter/ColumnCallbackAddColumnQuotient).
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
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

<a name="enablerecursive" id="enablerecursive"></a>
<a name="enableRecursive" id="enableRecursive"></a>
### `enableRecursive()`

Enables/Disables recursive filtering. Whether this property is actually used
is up to the derived BaseFilter class.

#### Signature

-  It accepts the following parameter(s):
    - `$enable` (`bool`) &mdash;
      
- It does not return anything.

<a name="filtersubtable" id="filtersubtable"></a>
<a name="filterSubTable" id="filterSubTable"></a>
### `filterSubTable()`

Filters a row's subtable, if one exists and is loaded in memory.

#### Signature

-  It accepts the following parameter(s):
    - `$row` ([`Row`](../../../Piwik/DataTable/Row.md)) &mdash;
       The row whose subtable should be filter.
- It does not return anything.

