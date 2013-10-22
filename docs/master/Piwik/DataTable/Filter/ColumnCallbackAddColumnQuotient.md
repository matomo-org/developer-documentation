<small>Piwik\DataTable\Filter</small>

ColumnCallbackAddColumnQuotient
===============================

Calculates the quotient of two columns and adds the result as a new column for each row of a DataTable.

Description
-----------

This filter is used to calculate rate values (eg, `&#039;bounce_rate&#039;`), averages
(eg, `&#039;avg_time_on_page&#039;`) and other types of values.


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ColumnCallbackAddColumnQuotient](#).

### `__construct()` <a name="__construct"></a>

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

### `filter()` <a name="filter"></a>

See [ColumnCallbackAddColumnQuotient](#).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

