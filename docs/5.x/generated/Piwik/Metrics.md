<small>Piwik\</small>

Metrics
=======

This class contains metadata regarding core metrics and contains several related helper functions.

Of note are the `INDEX_...` constants. In the database, metric column names
in [DataTable](/api-reference/Piwik/DataTable) rows are stored as integers to save space. The integer
values used are determined by these constants.

Properties
----------

This class defines the following properties:

- [`$mappingFromIdToName`](#$mappingfromidtoname)
- [`$mappingFromIdToNameGoal`](#$mappingfromidtonamegoal)

<a name="$mappingfromidtoname" id="$mappingfromidtoname"></a>
<a name="mappingFromIdToName" id="mappingFromIdToName"></a>
### `$mappingFromIdToName`

#### Signature

- Its type is not specified.


<a name="$mappingfromidtonamegoal" id="$mappingfromidtonamegoal"></a>
<a name="mappingFromIdToNameGoal" id="mappingFromIdToNameGoal"></a>
### `$mappingFromIdToNameGoal`

#### Signature

- Its type is not specified.


Methods
-------

The class defines the following methods:

- [`getMappingFromIdToName()`](#getmappingfromidtoname)
- [`getVisitsMetricNames()`](#getvisitsmetricnames)
- [`getMappingFromNameToId()`](#getmappingfromnametoid)
- [`getMappingFromNameToIdGoal()`](#getmappingfromnametoidgoal)
- [`getDefaultMetricSemanticTypes()`](#getdefaultmetricsemantictypes)
- [`getDefaultMetricTranslations()`](#getdefaultmetrictranslations)
- [`getDefaultMetrics()`](#getdefaultmetrics)
- [`getDefaultProcessedMetrics()`](#getdefaultprocessedmetrics)
- [`getReadableColumnName()`](#getreadablecolumnname)
- [`getMetricIdsToProcessReportTotal()`](#getmetricidstoprocessreporttotal)
- [`getDefaultMetricsDocumentation()`](#getdefaultmetricsdocumentation)
- [`getPercentVisitColumn()`](#getpercentvisitcolumn)
- [`makeGoalColumnsRow()`](#makegoalcolumnsrow) &mdash; This is a utility method used when building records through log aggregation.

<a name="getmappingfromidtoname" id="getmappingfromidtoname"></a>
<a name="getMappingFromIdToName" id="getMappingFromIdToName"></a>
### `getMappingFromIdToName()`

#### Signature

- It does not return anything or a mixed result.

<a name="getvisitsmetricnames" id="getvisitsmetricnames"></a>
<a name="getVisitsMetricNames" id="getVisitsMetricNames"></a>
### `getVisitsMetricNames()`

#### Signature

- It does not return anything or a mixed result.

<a name="getmappingfromnametoid" id="getmappingfromnametoid"></a>
<a name="getMappingFromNameToId" id="getMappingFromNameToId"></a>
### `getMappingFromNameToId()`

#### Signature

- It does not return anything or a mixed result.

<a name="getmappingfromnametoidgoal" id="getmappingfromnametoidgoal"></a>
<a name="getMappingFromNameToIdGoal" id="getMappingFromNameToIdGoal"></a>
### `getMappingFromNameToIdGoal()`

#### Signature

- It does not return anything or a mixed result.

<a name="getdefaultmetricsemantictypes" id="getdefaultmetricsemantictypes"></a>
<a name="getDefaultMetricSemanticTypes" id="getDefaultMetricSemanticTypes"></a>
### `getDefaultMetricSemanticTypes()`

#### Signature

- It returns a `array` value.

<a name="getdefaultmetrictranslations" id="getdefaultmetrictranslations"></a>
<a name="getDefaultMetricTranslations" id="getDefaultMetricTranslations"></a>
### `getDefaultMetricTranslations()`

#### Signature

- It does not return anything or a mixed result.

<a name="getdefaultmetrics" id="getdefaultmetrics"></a>
<a name="getDefaultMetrics" id="getDefaultMetrics"></a>
### `getDefaultMetrics()`

#### Signature

- It does not return anything or a mixed result.

<a name="getdefaultprocessedmetrics" id="getdefaultprocessedmetrics"></a>
<a name="getDefaultProcessedMetrics" id="getDefaultProcessedMetrics"></a>
### `getDefaultProcessedMetrics()`

#### Signature

- It does not return anything or a mixed result.

<a name="getreadablecolumnname" id="getreadablecolumnname"></a>
<a name="getReadableColumnName" id="getReadableColumnName"></a>
### `getReadableColumnName()`

#### Signature

-  It accepts the following parameter(s):
    - `$columnIdRaw`
      
- It does not return anything or a mixed result.

<a name="getmetricidstoprocessreporttotal" id="getmetricidstoprocessreporttotal"></a>
<a name="getMetricIdsToProcessReportTotal" id="getMetricIdsToProcessReportTotal"></a>
### `getMetricIdsToProcessReportTotal()`

#### Signature

- It does not return anything or a mixed result.

<a name="getdefaultmetricsdocumentation" id="getdefaultmetricsdocumentation"></a>
<a name="getDefaultMetricsDocumentation" id="getDefaultMetricsDocumentation"></a>
### `getDefaultMetricsDocumentation()`

#### Signature

- It does not return anything or a mixed result.

<a name="getpercentvisitcolumn" id="getpercentvisitcolumn"></a>
<a name="getPercentVisitColumn" id="getPercentVisitColumn"></a>
### `getPercentVisitColumn()`

#### Signature

- It does not return anything or a mixed result.

<a name="makegoalcolumnsrow" id="makegoalcolumnsrow"></a>
<a name="makeGoalColumnsRow" id="makeGoalColumnsRow"></a>
### `makeGoalColumnsRow()`

This is a utility method used when building records through log aggregation.

In records with per-goal conversion metrics the metrics are stored within DataTable Rows
as a column with an array a value. The array is indexed by the goal ID and the column name
is set to `Metrics::INDEX_GOALS`, for example:

```
$columns = [
    Metrics::INDEX_GOALS = [
        $idGoal => [
            // ... conversion metrics ...
        ],
    ],
];
$row = new Row([DataTable::COLUMNS => $columns]);
```

This methods returns an array like `$columns` above based on a goal ID and a row of
metric values for the goal. The result can be added directly to a DataTable record via `sumRowWithLabel()`.

The goal metrics returned will differ based on whether the goal is user defined or an ecommerce goal.

#### Signature

-  It accepts the following parameter(s):
    - `$idGoal` (`int`) &mdash;
      
    - `$goalsMetrics` (`array`) &mdash;
      
- It returns a `array` value.

