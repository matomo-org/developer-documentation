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
- [`calculate()`](#calculate) &mdash; Calculates the evolution percentage for two arbitrary values.
- [`appendPercentSign()`](#appendPercentSign)
- [`prependPlusSignToNumber()`](#prependPlusSignToNumber)

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
    - `$pastDataTable`
    - `$columnToAdd`
    - `$columnToRead`
    - `$quotientPrecision`
- It does not return anything.

### `calculate()` <a name="calculate"></a>

Calculates the evolution percentage for two arbitrary values.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$currentValue`
    - `$pastValue`
    - `$quotientPrecision`
    - `$appendPercentSign`
- _Returns:_ The evolution percent, eg `&#039;15%&#039;`.
    - `string`

### `appendPercentSign()` <a name="appendPercentSign"></a>

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$number`
- It does not return anything.

### `prependPlusSignToNumber()` <a name="prependPlusSignToNumber"></a>

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$number`
- It does not return anything.

