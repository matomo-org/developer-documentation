<small>Piwik\Columns\</small>

MetricsList
===========

Manages the global list of metrics that can be used in reports.

Metrics are added automatically by dimensions as well as through the [Metric.addMetrics](/api-reference/events#metricaddmetrics) and
[Metric.addComputedMetrics](/api-reference/events#metricaddcomputedmetrics) and filtered through the [Metric.filterMetrics](/api-reference/events#metricfiltermetrics) event.
Observers for this event should call the [addMetric()](/api-reference/Piwik/Columns/MetricsList#addmetric) method to add metrics or use any of the other
methods to remove metrics.

Methods
-------

The class defines the following methods:

- [`addMetric()`](#addmetric)
- [`getMetrics()`](#getmetrics) &mdash; Get all available metrics.
- [`remove()`](#remove) &mdash; Removes one or more metrics from the metrics list.
- [`getMetric()`](#getmetric)

<a name="addmetric" id="addmetric"></a>
<a name="addMetric" id="addMetric"></a>
### `addMetric()`

#### Signature

-  It accepts the following parameter(s):
    - `$metric` ([`Metric`](../../Piwik/Plugin/Metric.md)) &mdash;
      
- It does not return anything.

<a name="getmetrics" id="getmetrics"></a>
<a name="getMetrics" id="getMetrics"></a>
### `getMetrics()`

Get all available metrics.

#### Signature

- It returns a [`Metric[]`](../../Piwik/Plugin/Metric.md) value.

<a name="remove" id="remove"></a>
<a name="remove" id="remove"></a>
### `remove()`

Removes one or more metrics from the metrics list.

#### Signature

-  It accepts the following parameter(s):
    - `$metricCategory` (`string`) &mdash;
       The metric category id. Can be a translation token eg 'General_Visits' see Metric::getCategory().
    - `$metricName` (`string`|`Piwik\Columns\false`) &mdash;
       The name of the metric to remove eg 'nb_visits'. If not supplied, all metrics within that category will be removed.
- It does not return anything.

<a name="getmetric" id="getmetric"></a>
<a name="getMetric" id="getMetric"></a>
### `getMetric()`

#### Signature

-  It accepts the following parameter(s):
    - `$metricName` (`string`) &mdash;
      

- *Returns:*  [`Metric`](../../Piwik/Plugin/Metric.md)|`Piwik\Plugin\ArchivedMetric`|`null` &mdash;
    

