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
- [`appendPercentSign()`](#appendpercentsign)
- [`prependPlusSignToNumber()`](#prependplussigntonumber)

<a name="__construct" id="__construct"></a>
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

<a name="calculate" id="calculate"></a>
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
<a name="appendPercentSign" id="appendPercentSign"></a>
### `appendPercentSign()`

#### Signature

- It accepts the following parameter(s):
    - `$number`
- It does not return anything.

<a name="prependplussigntonumber" id="prependplussigntonumber"></a>
<a name="prependPlusSignToNumber" id="prependPlusSignToNumber"></a>
### `prependPlusSignToNumber()`

#### Signature

- It accepts the following parameter(s):
    - `$number`
- It does not return anything.

