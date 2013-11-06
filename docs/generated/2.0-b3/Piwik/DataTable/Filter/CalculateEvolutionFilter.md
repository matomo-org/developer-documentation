<small>Piwik\DataTable\Filter</small>

CalculateEvolutionFilter
========================

A DataTable filter that calculates the evolution of a metric and adds it to each row as a percentage.

Description
-----------

**This filter cannot be used as an argument to [DataTable::filter](#)** since
it requires corresponding data from another datatable. Instead, to use it,
you must manually perform a binary filter (see the MultiSites API for an
example).

The evolution metric is calculated as:

    ((currentValue - pastValue) / pastValue) * 100


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getDividend()`](#getdividend) &mdash; Returns the difference between the column in the specific row and its sister column in the past DataTable.
- [`getDivisor()`](#getdivisor) &mdash; Returns the value of the column in $row's sister row in the past DataTable.
- [`formatValue()`](#formatvalue) &mdash; Calculates and formats a quotient based on a divisor and dividend.
- [`calculate()`](#calculate) &mdash; Calculates the evolution percentage for two arbitrary values.
- [`appendPercentSign()`](#appendpercentsign)
- [`prependPlusSignToNumber()`](#prependplussigntonumber)

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table`
    - `$pastDataTable`
    - `$columnToAdd`
    - `$columnToRead`
    - `$quotientPrecision`
- It does not return anything.

<a name="getdividend" id="getdividend"></a>
### `getDividend()`

Returns the difference between the column in the specific row and its sister column in the past DataTable.

#### Signature

- It accepts the following parameter(s):
    - `$row`
- It can return one of the following values:
    - `int`
    - `float`

<a name="getdivisor" id="getdivisor"></a>
### `getDivisor()`

Returns the value of the column in $row's sister row in the past DataTable.

#### Signature

- It accepts the following parameter(s):
    - `$row`
- It can return one of the following values:
    - `int`
    - `float`

<a name="formatvalue" id="formatvalue"></a>
### `formatValue()`

Calculates and formats a quotient based on a divisor and dividend.

#### Description

Unlike ColumnCallbackAddColumnPercentage's,
version of this method, this method will return 100% if the past
value of a metric is 0, and the current value is not 0. For a
value representative of an evolution, this makes sense.

#### Signature

- It accepts the following parameter(s):
    - `$value`
    - `$divisor`
- It returns a(n) `string` value.

<a name="calculate" id="calculate"></a>
### `calculate()`

Calculates the evolution percentage for two arbitrary values.

#### Signature

- It accepts the following parameter(s):
    - `$currentValue`
    - `$pastValue`
    - `$quotientPrecision`
    - `$appendPercentSign`
- _Returns:_ The evolution percent, eg `'15%'`.
    - `string`

<a name="appendpercentsign" id="appendpercentsign"></a>
### `appendPercentSign()`

#### Signature

- It accepts the following parameter(s):
    - `$number`
- It does not return anything.

<a name="prependplussigntonumber" id="prependplussigntonumber"></a>
### `prependPlusSignToNumber()`

#### Signature

- It accepts the following parameter(s):
    - `$number`
- It does not return anything.

