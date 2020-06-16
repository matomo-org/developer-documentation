<small>Piwik\Plugins\CoreHome\Columns\Metrics\</small>

AverageTimeOnSite
=================

The average number of seconds spent on the site per visit.

Calculated as:

    sum_visit_length / nb_visits

sum_visit_length & nb_visits are calculated during archiving.

Methods
-------

The class defines the following methods:

- [`compute()`](#compute) &mdash; Computes the metric using the values in a [Row](/api-reference/Piwik/DataTable/Row).
- [`getDependentMetrics()`](#getdependentmetrics) &mdash; Returns the array of metrics that are necessary for computing this metric.
- [`getTemporaryMetrics()`](#gettemporarymetrics) &mdash; Returns the array of metrics that are necessary for computing this metric, but should not be displayed to the user unless explicitly requested. Inherited from [`ProcessedMetric`](../../../../../Piwik/Plugin/ProcessedMetric.md)
- [`beforeCompute()`](#beforecompute) &mdash; Executed before computing all processed metrics for a report. Inherited from [`ProcessedMetric`](../../../../../Piwik/Plugin/ProcessedMetric.md)
- [`getName()`](#getname)
- [`format()`](#format)
- [`getTranslatedName()`](#gettranslatedname)

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

<a name="getdependentmetrics" id="getdependentmetrics"></a>
<a name="getDependentMetrics" id="getDependentMetrics"></a>
### `getDependentMetrics()`

Returns the array of metrics that are necessary for computing this metric.

The elements
of the array are metric names.

#### Signature

- It returns a `string[]` value.

<a name="gettemporarymetrics" id="gettemporarymetrics"></a>
<a name="getTemporaryMetrics" id="getTemporaryMetrics"></a>
### `getTemporaryMetrics()`

Returns the array of metrics that are necessary for computing this metric, but should not be displayed to the user unless explicitly requested.

These metrics are intermediate
metrics that are not really valuable to the user. On a request, if showColumns or hideColumns
is not used, they will be removed automatically.

#### Signature

- It returns a `string[]` value.

<a name="beforecompute" id="beforecompute"></a>
<a name="beforeCompute" id="beforeCompute"></a>
### `beforeCompute()`

Executed before computing all processed metrics for a report.

Implementers can return `false`
to skip computing this metric.

#### Signature

-  It accepts the following parameter(s):
    - `$report` ([`Report`](../../../../../Piwik/Plugin/Report.md)) &mdash;
      
    - `$table` ([`DataTable`](../../../../../Piwik/DataTable.md)) &mdash;
      

- *Returns:*  `bool` &mdash;
    Return `true` to compute the metric for the table, `false` to skip computing this metric.

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

#### Signature

- It does not return anything.

<a name="format" id="format"></a>
<a name="format" id="format"></a>
### `format()`

#### Signature

-  It accepts the following parameter(s):
    - `$value`
      
    - `$formatter` ([`Formatter`](../../../../../Piwik/Metrics/Formatter.md)) &mdash;
      
- It does not return anything.

<a name="gettranslatedname" id="gettranslatedname"></a>
<a name="getTranslatedName" id="getTranslatedName"></a>
### `getTranslatedName()`

#### Signature

- It does not return anything.

