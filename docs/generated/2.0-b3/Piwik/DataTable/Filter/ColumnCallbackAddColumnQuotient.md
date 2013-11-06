<small>Piwik\DataTable\Filter</small>

ColumnCallbackAddColumnQuotient
===============================

Calculates the quotient of two columns and adds the result as a new column for each row of a DataTable.

Description
-----------

This filter is used to calculate rate values (eg, `'bounce_rate'`), averages
(eg, `'avg_time_on_page'`) and other types of values.


Properties
----------

This class defines the following properties:

- [`$table`](#$table)
- [`$columnValueToRead`](#$columnvaluetoread)
- [`$columnNameToAdd`](#$columnnametoadd)
- [`$columnNameUsedAsDivisor`](#$columnnameusedasdivisor)
- [`$totalValueUsedAsDivisor`](#$totalvalueusedasdivisor)
- [`$quotientPrecision`](#$quotientprecision)
- [`$shouldSkipRows`](#$shouldskiprows)
- [`$getDivisorFromSummaryRow`](#$getdivisorfromsummaryrow)

<a name="table" id="table"></a>
### `$table`

#### Signature

- Its type is not specified.


<a name="columnvaluetoread" id="columnvaluetoread"></a>
### `$columnValueToRead`

#### Signature

- Its type is not specified.


<a name="columnnametoadd" id="columnnametoadd"></a>
### `$columnNameToAdd`

#### Signature

- Its type is not specified.


<a name="columnnameusedasdivisor" id="columnnameusedasdivisor"></a>
### `$columnNameUsedAsDivisor`

#### Signature

- Its type is not specified.


<a name="totalvalueusedasdivisor" id="totalvalueusedasdivisor"></a>
### `$totalValueUsedAsDivisor`

#### Signature

- Its type is not specified.


<a name="quotientprecision" id="quotientprecision"></a>
### `$quotientPrecision`

#### Signature

- Its type is not specified.


<a name="shouldskiprows" id="shouldskiprows"></a>
### `$shouldSkipRows`

#### Signature

- Its type is not specified.


<a name="getdivisorfromsummaryrow" id="getdivisorfromsummaryrow"></a>
### `$getDivisorFromSummaryRow`

#### Signature

- Its type is not specified.


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ColumnCallbackAddColumnQuotient](#).
- [`formatValue()`](#formatvalue) &mdash; Formats the given value
- [`getDividend()`](#getdividend) &mdash; Returns the dividend to use when calculating the new column value.
- [`getDivisor()`](#getdivisor) &mdash; Returns the divisor to use when calculating the new column value.

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

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

- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

<a name="formatvalue" id="formatvalue"></a>
### `formatValue()`

Formats the given value

#### Signature

- It accepts the following parameter(s):
    - `$value`
    - `$divisor`
- It can return one of the following values:
    - `float`
    - `int`

<a name="getdividend" id="getdividend"></a>
### `getDividend()`

Returns the dividend to use when calculating the new column value.

#### Description

Can
be overridden by descendent classes to customize behavior.

#### Signature

- It accepts the following parameter(s):
    - `$row`
- It can return one of the following values:
    - `int`
    - `float`

<a name="getdivisor" id="getdivisor"></a>
### `getDivisor()`

Returns the divisor to use when calculating the new column value.

#### Description

Can
be overridden by descendent classes to customize behavior.

#### Signature

- It accepts the following parameter(s):
    - `$row`
- It can return one of the following values:
    - `int`
    - `float`

