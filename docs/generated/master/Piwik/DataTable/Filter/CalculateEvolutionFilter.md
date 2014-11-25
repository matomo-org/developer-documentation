<small>Piwik\DataTable\Filter\</small>

CalculateEvolutionFilter
========================

A DataTable filter that calculates the evolution of a metric and adds it to each row as a percentage.

**This filter cannot be used as an argument to [DataTable::filter()](/api-reference/Piwik/DataTable#filter)** since
it requires corresponding data from another DataTable. Instead,
you must manually perform a binary filter (see the **MultiSites** API for an
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

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
       The DataTable being filtered.
    - `$pastDataTable` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
       The DataTable containing data for the period in the past.
    - `$columnToAdd` (`string`) &mdash;
       The column to add evolution data to, eg, `'visits_evolution'`.
    - `$columnToRead` (`string`) &mdash;
       The column to use to calculate evolution data, eg, `'nb_visits'`.
    - `$quotientPrecision` (`int`) &mdash;
       The precision to use when rounding the evolution value.

<a name="calculate" id="calculate"></a>
<a name="calculate" id="calculate"></a>
### `calculate()`

Calculates the evolution percentage for two arbitrary values.

#### Signature

-  It accepts the following parameter(s):
    - `$currentValue` (`float`|`int`) &mdash;
       The current metric value.
    - `$pastValue` (`float`|`int`) &mdash;
       The value of the metric in the past. We measure the % change from this value to $currentValue.
    - `$quotientPrecision` (`float`|`int`) &mdash;
       The quotient precision to round to.
    - `$appendPercentSign` (`bool`) &mdash;
       Whether to append a '%' sign to the end of the number or not.

- *Returns:*  `string` &mdash;
    The evolution percent, eg `'15%'`.

<a name="appendpercentsign" id="appendpercentsign"></a>
<a name="appendPercentSign" id="appendPercentSign"></a>
### `appendPercentSign()`

#### Signature

-  It accepts the following parameter(s):
    - `$number`
      
- It does not return anything.

<a name="prependplussigntonumber" id="prependplussigntonumber"></a>
<a name="prependPlusSignToNumber" id="prependPlusSignToNumber"></a>
### `prependPlusSignToNumber()`

#### Signature

-  It accepts the following parameter(s):
    - `$number`
      
- It does not return anything.

