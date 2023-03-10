<small>Piwik\Plugins\PagePerformance\Columns\Metrics\</small>

AverageTimeDomCompletion
========================

The average amount of time the browser needs to load media any Javascript listening for the DOMContentLoaded event.

Calculated as

    sum_time_dom_completion / nb_hits_with_time_dom_completion

The above metrics are calculated during archiving. This metric is calculated before
serving a report.

Methods
-------

The class defines the following methods:

- [`getName()`](#getname) &mdash; Returns the column name of this metric, eg, `"nb_visits"` or `"avg_time_on_site"`. Inherited from [`Metric`](../../../../../Piwik/Plugin/Metric.md)
- [`getTranslatedName()`](#gettranslatedname) &mdash; Returns the human readable translated name of this metric, eg, `"Visits"` or `"Avg. Inherited from [`Metric`](../../../../../Piwik/Plugin/Metric.md)
- [`getCategoryId()`](#getcategoryid) &mdash; Returns the category that this metric belongs to. Inherited from [`Metric`](../../../../../Piwik/Plugin/Metric.md)
- [`getDocumentation()`](#getdocumentation) &mdash; Returns a string describing what the metric represents. Inherited from [`Metric`](../../../../../Piwik/Plugin/Metric.md)
- [`getSemanticType()`](#getsemantictype) &mdash; Returns this metric's semantic type. Inherited from [`Metric`](../../../../../Piwik/Plugin/Metric.md)
- [`format()`](#format) &mdash; Returns a formatted metric value. Inherited from [`Metric`](../../../../../Piwik/Plugin/Metric.md)
- [`beforeFormat()`](#beforeformat) &mdash; Executed before formatting all metrics for a report. Inherited from [`Metric`](../../../../../Piwik/Plugin/Metric.md)
- [`getMetric()`](#getmetric) &mdash; Helper method that will access a metric in a [Row](/api-reference/Piwik/DataTable/Row) or array either by its name or by its special numerical index value. Inherited from [`Metric`](../../../../../Piwik/Plugin/Metric.md)
- [`getMetricValues()`](#getmetricvalues) &mdash; Helper method that will determine the actual column name for a metric in a [DataTable](/api-reference/Piwik/DataTable) and return every column value for this name. Inherited from [`Metric`](../../../../../Piwik/Plugin/Metric.md)
- [`getActualMetricColumn()`](#getactualmetriccolumn) &mdash; Helper method that determines the actual column for a metric in a [DataTable](/api-reference/Piwik/DataTable). Inherited from [`Metric`](../../../../../Piwik/Plugin/Metric.md)
- [`compute()`](#compute) &mdash; Computes the metric using the values in a [Row](/api-reference/Piwik/DataTable/Row). Inherited from [`ProcessedMetric`](../../../../../Piwik/Plugin/ProcessedMetric.md)
- [`getDependentMetrics()`](#getdependentmetrics) &mdash; Returns the array of metrics that are necessary for computing this metric. Inherited from [`ProcessedMetric`](../../../../../Piwik/Plugin/ProcessedMetric.md)
- [`getTemporaryMetrics()`](#gettemporarymetrics) &mdash; Returns the array of metrics that are necessary for computing this metric, but should not be displayed to the user unless explicitly requested. Inherited from [`ProcessedMetric`](../../../../../Piwik/Plugin/ProcessedMetric.md)
- [`beforeCompute()`](#beforecompute) &mdash; Executed before computing all processed metrics for a report. Inherited from [`ProcessedMetric`](../../../../../Piwik/Plugin/ProcessedMetric.md)

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

Returns the column name of this metric, eg, `"nb_visits"` or `"avg_time_on_site"`.

This string is what appears in API output.

#### Signature

- It returns a `string` value.

<a name="gettranslatedname" id="gettranslatedname"></a>
<a name="getTranslatedName" id="getTranslatedName"></a>
### `getTranslatedName()`

Returns the human readable translated name of this metric, eg, `"Visits"` or `"Avg. time on site"`.

This string is what appears in the UI.

#### Signature

- It returns a `string` value.

<a name="getcategoryid" id="getcategoryid"></a>
<a name="getCategoryId" id="getCategoryId"></a>
### `getCategoryId()`

Returns the category that this metric belongs to.

#### Signature

- It returns a `string` value.

<a name="getdocumentation" id="getdocumentation"></a>
<a name="getDocumentation" id="getDocumentation"></a>
### `getDocumentation()`

Returns a string describing what the metric represents. The result will be included in report metadata
API output, including processed reports.

Implementing this method is optional.

#### Signature

- It returns a `string` value.

<a name="getsemantictype" id="getsemantictype"></a>
<a name="getSemanticType" id="getSemanticType"></a>
### `getSemanticType()`

Returns this metric's semantic type. This can be used to provide the semantic
type for processed metrics.

A metric's semantic type is metadata used primarily in integrations with Matomo
and third party services/applications. It provides information that can be used
to determine how to display or use the information.

It is recommended for your plugin to provide this information so users of third
party services that connect with Matomo can make full use of the data your plugin
tracks.

See Metrics for the list of available semantic types.

#### Signature


- *Returns:*  `string`|`null` &mdash;
    

<a name="format" id="format"></a>
<a name="format" id="format"></a>
### `format()`

Returns a formatted metric value. This value is what appears in API output. From within Piwik,
(core & plugins) the computed value is used. Only when outputting to the API does a metric
get formatted.

By default, just returns the value.

#### Signature

-  It accepts the following parameter(s):
    - `$value` (`mixed`) &mdash;
       The metric value.
    - `$formatter` ([`Formatter`](../../../../../Piwik/Metrics/Formatter.md)) &mdash;
       The formatter to use when formatting a value.

- *Returns:*  `mixed` &mdash;
    $value

<a name="beforeformat" id="beforeformat"></a>
<a name="beforeFormat" id="beforeFormat"></a>
### `beforeFormat()`

Executed before formatting all metrics for a report. Implementers can return `false`
to skip formatting this metric and can use this method to access information needed for
formatting (for example, the site ID).

#### Signature

-  It accepts the following parameter(s):
    - `$report` ([`Report`](../../../../../Piwik/Plugin/Report.md)) &mdash;
      
    - `$table` ([`DataTable`](../../../../../Piwik/DataTable.md)) &mdash;
      

- *Returns:*  `bool` &mdash;
    Return `true` to format the metric for the table, `false` to skip formatting.

<a name="getmetric" id="getmetric"></a>
<a name="getMetric" id="getMetric"></a>
### `getMetric()`

Helper method that will access a metric in a [Row](/api-reference/Piwik/DataTable/Row) or array either by
its name or by its special numerical index value.

#### Signature

-  It accepts the following parameter(s):
    - `$row` ([`Row`](../../../../../Piwik/DataTable/Row.md)|`array`) &mdash;
      
    - `$columnName` (`string`) &mdash;
      
    - `$mappingNameToId` (`int[]`|`null`) &mdash;
       A custom mapping of metric names to special index values. By default Metrics::getMappingFromNameToId() is used.

- *Returns:*  `mixed` &mdash;
    The metric value or false if none exists.

<a name="getmetricvalues" id="getmetricvalues"></a>
<a name="getMetricValues" id="getMetricValues"></a>
### `getMetricValues()`

Helper method that will determine the actual column name for a metric in a
[DataTable](/api-reference/Piwik/DataTable) and return every column value for this name.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../../../Piwik/DataTable.md)) &mdash;
      
    - `$columnName` (`string`) &mdash;
      
    - `$mappingNameToId` (`int[]`|`null`) &mdash;
       A custom mapping of metric names to special index values. By default Metrics::getMappingFromNameToId() is used.
- It returns a `array` value.

<a name="getactualmetriccolumn" id="getactualmetriccolumn"></a>
<a name="getActualMetricColumn" id="getActualMetricColumn"></a>
### `getActualMetricColumn()`

Helper method that determines the actual column for a metric in a [DataTable](/api-reference/Piwik/DataTable).

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../../../Piwik/DataTable.md)) &mdash;
      
    - `$columnName` (`string`) &mdash;
      
    - `$mappingNameToId` (`int[]`|`null`) &mdash;
       A custom mapping of metric names to special index values. By default Metrics::getMappingFromNameToId() is used.
- It returns a `string` value.

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

Returns the array of metrics that are necessary for computing this metric. The elements
of the array are metric names.

#### Signature

- It returns a `string[]` value.

<a name="gettemporarymetrics" id="gettemporarymetrics"></a>
<a name="getTemporaryMetrics" id="getTemporaryMetrics"></a>
### `getTemporaryMetrics()`

Returns the array of metrics that are necessary for computing this metric, but should not
be displayed to the user unless explicitly requested. These metrics are intermediate
metrics that are not really valuable to the user. On a request, if showColumns or hideColumns
is not used, they will be removed automatically.

#### Signature

- It returns a `string[]` value.

<a name="beforecompute" id="beforecompute"></a>
<a name="beforeCompute" id="beforeCompute"></a>
### `beforeCompute()`

Executed before computing all processed metrics for a report. Implementers can return `false`
to skip computing this metric.

#### Signature

-  It accepts the following parameter(s):
    - `$report` ([`Report`](../../../../../Piwik/Plugin/Report.md)) &mdash;
      
    - `$table` ([`DataTable`](../../../../../Piwik/DataTable.md)) &mdash;
      

- *Returns:*  `bool` &mdash;
    Return `true` to compute the metric for the table, `false` to skip computing
             this metric.

