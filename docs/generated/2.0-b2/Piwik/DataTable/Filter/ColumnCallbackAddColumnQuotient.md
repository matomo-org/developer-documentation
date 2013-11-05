<small>Piwik\DataTable\Filter</small>

ColumnCallbackAddColumnQuotient
===============================

Calculates the quotient of two columns and adds the result as a new column for each row of a DataTable.

Description
-----------

This filter is used to calculate rate values (eg, `'bounce_rate'`), averages
(eg, `'avg_time_on_page'`) and other types of values.


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ColumnCallbackAddColumnQuotient](#).

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$columnNameToAdd`
    - `$columnValueToRead`
    - `$divisorValueOrDivisorColumnName`
    - `$quotientPrecision`
    - `$shouldSkipRows`
    - `$getDivisorFromSummaryRow`
- It does not return anything.

<a name="filter" id="filter"></a>
### `filter()`

See [ColumnCallbackAddColumnQuotient](#).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

