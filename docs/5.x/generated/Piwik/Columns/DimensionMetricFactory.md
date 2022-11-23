<small>Piwik\Columns\</small>

DimensionMetricFactory
======================

A factory to create metrics from a dimension.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Generates a new dimension metric factory.
- [`createCustomMetric()`](#createcustommetric)
- [`createComputedMetric()`](#createcomputedmetric)
- [`createMetric()`](#createmetric)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Generates a new dimension metric factory.

#### Signature

-  It accepts the following parameter(s):
    - `$dimension` ([`Dimension`](../../Piwik/Columns/Dimension.md)) &mdash;
       A dimension instance the created metrics should be based on.

<a name="createcustommetric" id="createcustommetric"></a>
<a name="createCustomMetric" id="createCustomMetric"></a>
### `createCustomMetric()`

#### Signature

-  It accepts the following parameter(s):
    - `$metricName`
      
    - `$readableName`
      
    - `$aggregation`
      
    - `$documentation`
      
- It returns a `Piwik\Plugin\ArchivedMetric` value.

<a name="createcomputedmetric" id="createcomputedmetric"></a>
<a name="createComputedMetric" id="createComputedMetric"></a>
### `createComputedMetric()`

#### Signature

-  It accepts the following parameter(s):
    - `$metricName1`
      
    - `$metricName2`
      
    - `$aggregation`
      
- It returns a `Piwik\Plugin\ComputedMetric` value.

<a name="createmetric" id="createmetric"></a>
<a name="createMetric" id="createMetric"></a>
### `createMetric()`

#### Signature

-  It accepts the following parameter(s):
    - `$aggregation`
      
- It returns a `Piwik\Plugin\ArchivedMetric` value.

