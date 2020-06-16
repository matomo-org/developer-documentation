<small>Piwik\Plugins\MultiSites\Columns\Metrics\</small>

EcommerceOnlyEvolutionMetric
============================

Ecommerce evolution metric adapter.

This is a special processed metric for MultiSites API methods. It will
only be calculated for sites that have ecommerce enabled. The site is determined by the label
of each row.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor. Inherited from [`EvolutionMetric`](../../../../../Piwik/Plugins/CoreHome/Columns/Metrics/EvolutionMetric.md)
- [`getName()`](#getname) Inherited from [`EvolutionMetric`](../../../../../Piwik/Plugins/CoreHome/Columns/Metrics/EvolutionMetric.md)
- [`getTranslatedName()`](#gettranslatedname) Inherited from [`EvolutionMetric`](../../../../../Piwik/Plugins/CoreHome/Columns/Metrics/EvolutionMetric.md)
- [`compute()`](#compute) &mdash; Computes the metric using the values in a [Row](/api-reference/Piwik/DataTable/Row). Inherited from [`EvolutionMetric`](../../../../../Piwik/Plugins/CoreHome/Columns/Metrics/EvolutionMetric.md)
- [`format()`](#format) Inherited from [`EvolutionMetric`](../../../../../Piwik/Plugins/CoreHome/Columns/Metrics/EvolutionMetric.md)
- [`getDependentMetrics()`](#getdependentmetrics) &mdash; Returns the array of metrics that are necessary for computing this metric. Inherited from [`EvolutionMetric`](../../../../../Piwik/Plugins/CoreHome/Columns/Metrics/EvolutionMetric.md)
- [`beforeComputeSubtable()`](#beforecomputesubtable) Inherited from [`EvolutionMetric`](../../../../../Piwik/Plugins/CoreHome/Columns/Metrics/EvolutionMetric.md)
- [`afterComputeSubtable()`](#aftercomputesubtable) Inherited from [`EvolutionMetric`](../../../../../Piwik/Plugins/CoreHome/Columns/Metrics/EvolutionMetric.md)
- [`getPastRowFromCurrent()`](#getpastrowfromcurrent) &mdash; public for Insights use. Inherited from [`EvolutionMetric`](../../../../../Piwik/Plugins/CoreHome/Columns/Metrics/EvolutionMetric.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$wrapped` (`string`|[`Metric`](../../../../../Piwik/Plugin/Metric.md)) &mdash;
       The metric used to calculate the evolution.
    - `$pastData` ([`DataTable`](../../../../../Piwik/DataTable.md)) &mdash;
       The data in the past to use when calculating evolutions.
    - `$evolutionMetricName` (`string`|`Piwik\Plugins\CoreHome\Columns\Metrics\false`) &mdash;
       The name of the evolution processed metric. Defaults to $wrapped's name with `'_evolution'` appended.
    - `$quotientPrecision` (`int`) &mdash;
       The percent's quotient precision.

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

#### Signature

- It does not return anything.

<a name="gettranslatedname" id="gettranslatedname"></a>
<a name="getTranslatedName" id="getTranslatedName"></a>
### `getTranslatedName()`

#### Signature

- It does not return anything.

<a name="compute" id="compute"></a>
<a name="compute" id="compute"></a>
### `compute()`

Computes the metric using the values in a [Row](/api-reference/Piwik/DataTable/Row).

The computed value should be numerical and not formatted in any way. For example, for
a percent value, `0.14` should be returned instead of `"14%"`.

#### Signature

-  It accepts the following parameter(s):
    - `$row` ([`Row`](../../../../../Piwik/DataTable/Row.md)) &mdash;
      
- It returns a `mixed` value.

<a name="format" id="format"></a>
<a name="format" id="format"></a>
### `format()`

#### Signature

-  It accepts the following parameter(s):
    - `$value`
      
    - `$formatter` ([`Formatter`](../../../../../Piwik/Metrics/Formatter.md)) &mdash;
      
- It does not return anything.

<a name="getdependentmetrics" id="getdependentmetrics"></a>
<a name="getDependentMetrics" id="getDependentMetrics"></a>
### `getDependentMetrics()`

Returns the array of metrics that are necessary for computing this metric.

The elements
of the array are metric names.

#### Signature

- It returns a `string[]` value.

<a name="beforecomputesubtable" id="beforecomputesubtable"></a>
<a name="beforeComputeSubtable" id="beforeComputeSubtable"></a>
### `beforeComputeSubtable()`

#### Signature

-  It accepts the following parameter(s):
    - `$row` ([`Row`](../../../../../Piwik/DataTable/Row.md)) &mdash;
      
- It does not return anything.

<a name="aftercomputesubtable" id="aftercomputesubtable"></a>
<a name="afterComputeSubtable" id="afterComputeSubtable"></a>
### `afterComputeSubtable()`

#### Signature

-  It accepts the following parameter(s):
    - `$row` ([`Row`](../../../../../Piwik/DataTable/Row.md)) &mdash;
      
- It does not return anything.

<a name="getpastrowfromcurrent" id="getpastrowfromcurrent"></a>
<a name="getPastRowFromCurrent" id="getPastRowFromCurrent"></a>
### `getPastRowFromCurrent()`

public for Insights use.

#### Signature

-  It accepts the following parameter(s):
    - `$row` ([`Row`](../../../../../Piwik/DataTable/Row.md)) &mdash;
      
- It does not return anything.

